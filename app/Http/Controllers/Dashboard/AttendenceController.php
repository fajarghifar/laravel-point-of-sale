<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use App\Models\Attendence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AttendenceController extends Controller
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

        return view('attendence.index', [
            'attendences' => Attendence::sortable()
                ->select('date')
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->paginate($row)
                ->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('attendence.create', [
            'employees' => Employee::all()->sortBy('name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $countEmployee = count($request->employee_id);
        $rules = [
            'date' => 'required|date_format:Y-m-d|max:10',
        ];

        $validatedData = $request->validate($rules);

        // Delete if the date is already created (it is just for updating new attendance). If not it will create new attendance
        Attendence::where('date', $validatedData['date'])->delete();

        for ($i=1; $i <= $countEmployee; $i++) {
            $status = 'status' . $i;
            $attend = new Attendence();

            $attend->date = $validatedData['date'];
            $attend->employee_id = $request->employee_id[$i];
            $attend->status = $request->$status;

            $attend->save();
        }

        return Redirect::route('attendence.index')->with('success', 'Attendence has been Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendence $attendence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendence $attendence)
    {
        return view('attendence.edit', [
            'attendences' => Attendence::with(['employee'])->where('date', $attendence->date)->get(),
            'date' => $attendence->date
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendence $attendence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendence $attendence)
    {
        //
    }
}
