<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ProductController extends Controller
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

        return view('products.index', [
            'user' => auth()->user(),
            'products' => Product::with(['category', 'supplier'])
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
        return view('products.create', [
            'user' => auth()->user(),
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product_code = IdGenerator::generate([
            'table' => 'products',
            'field' => 'product_code',
            'length' => 4,
            'prefix' => 'PC'
        ]);

        $rules = [
            'product_image' => 'image|file|max:1024',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'product_garage' => 'string|nullable',
            'product_store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|max:10|nullable',
            'expire_date' => 'date_format:Y-m-d|max:10|nullable',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);

        // save product code value
        $validatedData['product_code'] = $product_code;

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            /**
             * Rezise and Compress the photo.
             */
            Image::make($file)
                ->resize(360, 360, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $file->storeAs($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }

        Product::create($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Barcode Generator
        $generator = new BarcodeGeneratorHTML();

        $barcode = $generator->getBarcode($product->product_code, $generator::TYPE_CODE_128);

        return view('products.show', [
            'user' => auth()->user(),
            'product' => $product,
            'barcode' => $barcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', [
            'user' => auth()->user(),
            'categories' => Category::all(),
            'suppliers' => Supplier::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'product_image' => 'image|file|max:1024',
            'product_name' => 'required|string',
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'product_garage' => 'string|nullable',
            'product_store' => 'string|nullable',
            'buying_date' => 'date_format:Y-m-d|max:10|nullable',
            'expire_date' => 'date_format:Y-m-d|max:10|nullable',
            'buying_price' => 'required|integer',
            'selling_price' => 'required|integer',
        ];

        $validatedData = $request->validate($rules);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('product_image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            /**
             * Delete photo if exists.
             */
            if($product->product_image){
                Storage::delete($path . $product->product_image);
            }

            /**
             * Rezise and Compress the photo.
             */
            Image::make($file)
                ->resize(360, 360, function ($constraint) {
                    $constraint->aspectRatio();
                });

            $file->storeAs($path, $fileName);
            $validatedData['product_image'] = $fileName;
        }

        Product::where('id', $product->id)->update($validatedData);

        return Redirect::route('products.index')->with('success', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        /**
         * Delete photo if exists.
         */
        if($product->product_image){
            Storage::delete('public/products/' . $product->product_image);
        }

        Product::destroy($product->id);

        return Redirect::route('products.index')->with('success', 'Product has been deleted!');
    }
}
