<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AdvanceSalary\StoreAdvanceSalaryRequest;
use App\Http\Requests\AdvanceSalary\UpdateAdvanceSalaryRequest;
use App\Models\Employee;
use App\Models\AdvanceSalary;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;

class AdvanceSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        // Fetch advance salaries with sorting, searching, and pagination
        $advance_salaries = QueryBuilder::for(AdvanceSalary::class)
            ->allowedSorts([
                'date',
                'advance_salary',
                AllowedSort::callback('employee.name', function ($query, $descending) {
                    $query->join('employees', 'advance_salaries.employee_id', '=', 'employees.id')
                        ->orderBy('employees.name', $descending ? 'desc' : 'asc')
                        ->select('advance_salaries.*');
                })
            ])
            ->with(['employee'])
            ->filter(request(['search']))
            ->orderByDesc('date')
            ->paginate($row)
            ->appends(request()->query());

        return view('advance-salary.index', [
            'advance_salaries' => $advance_salaries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch employees sorted by name for the dropdown
        return view('advance-salary.create', [
            'employees' => Employee::orderBy('name')->get(['id', 'name']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvanceSalaryRequest $request)
    {
        $validatedData = $request->validated();
        $date = $validatedData['date'];
        $employeeId = $validatedData['employee_id'];

        // Check if advance salary for this month already exists to prevent duplicates
        $month = Carbon::createFromFormat('Y-m-d', $date);

        $exists = AdvanceSalary::where('employee_id', $employeeId)
            ->whereYear('date', $month->year)
            ->whereMonth('date', $month->month)
            ->exists();

        if ($exists) {
            return Redirect::route('advance-salary.create')
                ->with('warning', 'Advance Salary for this month already paid!');
        }

        AdvanceSalary::create($validatedData);

        return Redirect::route('advance-salary.create')
            ->with('success', 'Advance Salary Paid Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdvanceSalary $advanceSalary)
    {
        return view('advance-salary.edit', [
            'employees' => Employee::orderBy('name')->get(['id', 'name']),
            'advance_salary' => $advanceSalary,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvanceSalaryRequest $request, AdvanceSalary $advanceSalary)
    {
        $validatedData = $request->validated();

        // Check for conflicts if changing date (prevent moving to a month that already has a record)
        $newMonth = Carbon::createFromFormat('Y-m-d', $validatedData['date']);
        $oldMonth = Carbon::createFromFormat('Y-m-d', $advanceSalary->date);

        if ($newMonth->format('Y-m') !== $oldMonth->format('Y-m')) {
            $exists = AdvanceSalary::where('employee_id', $validatedData['employee_id'])
                ->whereYear('date', $newMonth->year)
                ->whereMonth('date', $newMonth->month)
                ->where('id', '!=', $advanceSalary->id)
                ->exists();

            if ($exists) {
                return Redirect::route('advance-salary.edit', $advanceSalary->id)
                    ->with('warning', 'Advance Salary for the selected month already exists!');
            }
        }

        $advanceSalary->update($validatedData);

        return Redirect::route('advance-salary.index')
            ->with('success', 'Advance Salary Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdvanceSalary $advanceSalary)
    {
        $advanceSalary->delete();

        return Redirect::route('advance-salary.index')
            ->with('success', 'Advance Salary has been deleted!');
    }
}
