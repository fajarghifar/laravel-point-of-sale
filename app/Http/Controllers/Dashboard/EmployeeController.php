<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Spatie\QueryBuilder\QueryBuilder;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EmployeeController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $employees = QueryBuilder::for(Employee::class)
            ->allowedSorts(['name', 'email', 'phone', 'salary', 'city'])
            ->allowedFilters(['name', 'email'])
            ->filter(request(['search']))
            ->paginate(request('row', 10))
            ->appends(request()->query());

        return view('employees.index', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $this->imageService->upload(
                $request->file('photo'),
                'public/employees/'
            );
        }

        Employee::create($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee): View
    {
        return view('employees.show', [
            'employee' => $employee,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee): View
    {
        return view('employees.edit', [
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('photo')) {
            $newPhoto = $this->imageService->update(
                $request->file('photo'),
                $employee->photo,
                'public/employees/'
            );

            if ($newPhoto) {
                $validatedData['photo'] = $newPhoto;
            }
        }

        $employee->update($validatedData);

        return redirect()->route('employees.index')->with('success', 'Employee has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $this->imageService->delete($employee->photo, 'public/employees/');

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee has been deleted!');
    }
}
