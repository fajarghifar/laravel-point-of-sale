<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
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

        return view('suppliers.index', [
            'suppliers' => Supplier::filter(request(['search']))->sortable()->paginate($row)->appends(request()->query()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create', [
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:suppliers,email',
            'phone' => 'required|string|max:15|unique:suppliers,phone',
            'shopname' => 'required|string|max:50',
            'type' => 'required|string|max:25',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'bank_branch' => 'max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/suppliers/';

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Supplier::create($validatedData);

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
    public function update(Request $request, Supplier $supplier)
    {
        $rules = [
            'photo' => 'image|file|max:1024',
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required|string|max:15|unique:suppliers,phone,'.$supplier->id,
            'shopname' => 'required|string|max:50',
            'type' => 'required|string|max:25',
            'account_holder' => 'max:50',
            'account_number' => 'max:25',
            'bank_name' => 'max:25',
            'bank_branch' => 'max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('photo')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/suppliers/';

            /**
             * Delete photo if exists.
             */
            if($supplier->photo){
                Storage::delete($path . $supplier->photo);
            }

            $file->storeAs($path, $fileName);
            $validatedData['photo'] = $fileName;
        }

        Supplier::where('id', $supplier->id)->update($validatedData);

        return Redirect::route('suppliers.index')->with('success', 'Supplier has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        /**
         * Delete photo if exists.
         */
        if($supplier->photo){
            Storage::delete('public/suppliers/' . $supplier->photo);
        }

        Supplier::destroy($supplier->id);

        return Redirect::route('suppliers.index')->with('success', 'Supplier has been deleted!');
    }
}
