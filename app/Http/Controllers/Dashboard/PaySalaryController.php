<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\PaySalary;
use Illuminate\Http\Request;
use App\Models\AdvanceSalary;
use App\Http\Controllers\Controller;

class PaySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per_page parameter must be an integer between 1 and 100.');
        }

        if(request('search')){
            Employee::firstWhere('name', request('search'));
        }

        return view('pay-salary.index', [
            'user' => auth()->user(),
            'advance_salaries' => AdvanceSalary::with(['employee'])
                ->orderByDesc('date')
                ->filter(request(['search']))
                ->sortable()
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvanceSalary $advanceSalary)
    {
        dd($advanceSalary);

        return view('pay-salary.show', [
            'user' => auth()->user(),
            'paySalary' => AdvanceSalary::with(['employee'])
                ->where('id', $advanceSalary->id)
        ]);
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
        //
    }
}
