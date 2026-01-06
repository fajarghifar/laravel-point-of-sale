<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\Attendance;
use App\Http\Requests\Attendance\StoreAttendanceRequest;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
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

        return view('attendance.index', [
            // Use distinct to get unique dates.
            // Note: filter() and sort() from QueryBuilder might need careful handling with distinct,
            // but for simple date listing this is robust.
            'attendances' => Attendance::select('date')
                ->distinct()
                ->orderBy('date', 'desc')
                ->paginate($row)
                ->withQueryString(), // standard Laravel replacement for appends(request()->query())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendance.create', [
            // Optimization: Order by name at database level to reduce memory usage
            'employees' => Employee::orderBy('name')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Uses updateOrCreate to safely handle attendance records.
     */
    public function store(StoreAttendanceRequest $request)
    {
        // Use validated data for values, but we can trust the request structure for iteration
        $validatedData = $request->validated();
        $date = $validatedData['date'];

        // Use request->collect or array to iterate.
        // We rely on the index of employee_id matching the index of status keys if we use loop index.
        // But better: use the KEY of the employee_id array, which we set as loop iteration in blade.
        $employeeIds = $request->input('employee_id');

        DB::transaction(function () use ($request, $date, $employeeIds) {
            foreach ($employeeIds as $key => $employeeId) {
                // Get the status using the dynamic key from the form (status1, status2, etc)
                $inputKey = 'status' . $key;
                $status = $request->input($inputKey);

                if ($status) {
                    Attendance::updateOrCreate(
                        [
                            'employee_id' => $employeeId,
                            'date' => $date
                        ],
                        [
                            'status' => $status
                        ]
                    );
                }
            }
        });

        return Redirect::route('attendance.index')->with('success', 'Attendance has been Updated!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $date)
    {
        return view('attendance.edit', [
            // Explicitly load relation since global scope was removed
            'attendances' => Attendance::with(['employee'])->where('date', $date)->get(),
            'date' => $date
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
