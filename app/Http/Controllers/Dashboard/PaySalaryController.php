<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\PaySalary;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class PaySalaryController extends Controller
{
    /**
     * Display a listing of advance salaries (Advance Salary List for Payment).
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The row parameter must be an integer between 1 and 100.');
        }

        return view('pay-salary.index', [
            'advanceSalaries' => QueryBuilder::for(AdvanceSalary::class)
                ->available()
                ->allowedSorts([
                    'date',
                    'advance_salary',
                    AllowedSort::callback('employee.name', function ($query, $descending) {
                        $query->join('employees', 'advance_salaries.employee_id', '=', 'employees.id')
                            ->orderBy('employees.name', $descending ? 'DESC' : 'ASC')
                            ->select('advance_salaries.*');
                    }),
                    AllowedSort::callback('employee.salary', function ($query, $descending) {
                        $query->join('employees', 'advance_salaries.employee_id', '=', 'employees.id')
                            ->orderBy('employees.salary', $descending ? 'DESC' : 'ASC')
                            ->select('advance_salaries.*');
                    })
                ])
                ->with(['employee'])
                ->orderByDesc('date')
                ->filter(request(['search']))
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for paying salary (Create PaySalary).
     */
    public function paySalary(String $id)
    {
        return view('pay-salary.create', [
            'advanceSalary' => AdvanceSalary::with(['employee'])
                ->where('id', $id)
                ->firstOrFail(), // Use findOrFail for safety
        ]);
    }

    /**
     * Display the history of paid salaries.
     */
    public function payHistory()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The row parameter must be an integer between 1 and 100.');
        }

        return view('pay-salary.history', [
            'paySalaries' => QueryBuilder::for(PaySalary::class)
                ->allowedSorts([
                    'date',
                    'paid_amount',
                    AllowedSort::callback('employee.name', function ($query, $descending) {
                        $query->join('employees', 'pay_salaries.employee_id', '=', 'employees.id')
                            ->orderBy('employees.name', $descending ? 'DESC' : 'ASC')
                            ->select('pay_salaries.*');
                    }),
                ])
                ->with(['employee']) // Explicitly load employee after removing global scope
                ->orderByDesc('date')
                ->filter(request(['search']))
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Display details of a specific paid salary record.
     */
    public function payHistoryDetail(String $id)
    {
        return view('pay-salary.history-details', [
            'paySalary' => PaySalary::with(['employee'])
                ->findOrFail($id), // Use findOrFail
        ]);
    }

    /**
     * Show the form for creating a new resource (Pay Single Employee).
     */
    public function create()
    {
        return view('pay-salary.create_single', [
            'employees' => Employee::orderBy('name')->get()
        ]);
    }

    /**
     * View for Bulk Payment (Pay All).
     */
    public function payAllView()
    {
        return view('pay-salary.pay-all');
    }

    /**
     * Process Bulk Payment (Pay All).
     */
    public function payAllStore(Request $request)
    {
        $request->validate([
            'month' => 'required',
            'year' => 'required',
        ]);

        $salaryMonth = $request->month . '-' . $request->year;

        $employees = Employee::all();
        $count = 0;

        DB::transaction(function () use ($employees, $request, $salaryMonth, &$count) {
            foreach ($employees as $employee) {
                // Check if already paid
                $exists = PaySalary::where('employee_id', $employee->id)
                    ->where('salary_month', $salaryMonth)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // Check for Advance Salary
                // We sum up ALL advances for this month that are NOT deducted yet
                // Logic change: Advances are typically monthly based.
                // We find the advance specifically for this month/year.
                $advance = AdvanceSalary::where('employee_id', $employee->id)
                    ->whereMonth('date', $request->month)
                    ->whereYear('date', $request->year)
                    ->where('is_deducted', false)
                    ->first();

                $advanceAmount = $advance ? $advance->advance_salary : 0;
                $dueSalary = $employee->salary - $advanceAmount;

                PaySalary::create([
                    'employee_id' => $employee->id,
                    'date' => date('Y-m-d'),
                    'paid_amount' => $employee->salary,
                    'advance_salary' => $advanceAmount,
                    'due_salary' => $dueSalary,
                    'salary_month' => $salaryMonth,
                ]);

                if ($advance) {
                    $advance->update(['is_deducted' => true]);
                }

                $count++;
            }
        });

        return Redirect::route('pay-salary.payHistory')
            ->with('success', $count . ' Employees Paid Successfully for ' . $salaryMonth . '!');
    }

    /**
     * Store a newly created resource in storage (Single Payment).
     */
    public function store(Request $request)
    {
        // Custom Manual Validation for flexible logic (Advance vs No Advance)
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required',
            'year' => 'required',
            'date' => 'required|date',
        ]);

        $employee = Employee::findOrFail($request->employee_id);
        $salaryMonth = $request->month . '-' . $request->year;

        // Check duplicate
        $exists = PaySalary::where('employee_id', $employee->id)
            ->where('salary_month', $salaryMonth)
            ->exists();

        if ($exists) {
            return Redirect::back()->withErrors(['month' => 'Salary for this month has already been paid!']);
        }

        // Find Advance
        $advance = AdvanceSalary::where('employee_id', $employee->id)
            ->whereMonth('date', $request->month)
            ->whereYear('date', $request->year)
            ->first();

        $advanceAmount = $advance ? $advance->advance_salary : 0;

        DB::transaction(function () use ($request, $employee, $advanceAmount, $salaryMonth, $advance) {
            PaySalary::create([
                'employee_id' => $employee->id,
                'date' => $request->date,
                'paid_amount' => $employee->salary,
                'advance_salary' => $advanceAmount,
                'due_salary' => $employee->salary - $advanceAmount,
                'salary_month' => $salaryMonth,
            ]);

            if ($advance) {
                $advance->update(['is_deducted' => true]);
            }
        });

        return Redirect::route('pay-salary.payHistory')
            ->with('success', 'Employee Salary Paid Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaySalary $paySalary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaySalary $paySalary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaySalary $paySalary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaySalary $paySalary)
    {
        PaySalary::destroy($paySalary->id);

        return Redirect::route('pay-salary.payHistory')->with('success', 'Employee History Pay Salary has been deleted!');
    }
}
