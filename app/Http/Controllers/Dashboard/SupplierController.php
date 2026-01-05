<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supplier;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Supplier\StoreSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = QueryBuilder::for(Supplier::class)
            ->allowedSorts(['name', 'email', 'phone', 'city'])
            ->allowedFilters(['name', 'email', 'city'])
            ->filter(request(['search']))
            ->paginate(request('row', 10))
            ->appends(request()->query());

        return view('suppliers.index', [
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());

        return Redirect::route('suppliers.index')->with('success', 'Supplier has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', [
            'supplier' => $supplier,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return Redirect::route('suppliers.index')->with('success', 'Supplier has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return Redirect::route('suppliers.index')->with('success', 'Supplier has been deleted!');
    }
}
