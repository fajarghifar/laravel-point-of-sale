<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Picqer\Barcode\BarcodeGeneratorHTML;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
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

        $products = QueryBuilder::for(Product::class)
            ->allowedSorts([
                'name',
                'selling_price',
                AllowedSort::callback('category.name', function ($query, $descending) {
                    $query->join('categories', 'products.category_id', '=', 'categories.id')
                        ->orderBy('categories.name', $descending ? 'DESC' : 'ASC')
                        ->select('products.*');
                })
            ])
            ->allowedFilters(['name'])
            ->filter(request(['search']))
            ->with(['category'])
            ->paginate($row)
            ->appends(request()->query());

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $code = IdGenerator::generate([
            'table' => 'products',
            'field' => 'code',
            'length' => 4,
            'prefix' => 'PC'
        ]);

        $validatedData = $request->validated();

        // save product code value
        $validatedData['code'] = $code;
        $validatedData['slug'] = Str::slug($validatedData['name']);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            $file->storeAs($path, $fileName);
            $validatedData['image'] = $fileName;
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

        $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

        return view('products.show', [
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
            'categories' => Category::all(),
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::slug($validatedData['name']);

        /**
         * Handle upload image with Storage.
         */
        if ($file = $request->file('image')) {
            $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
            $path = 'public/products/';

            /**
             * Delete photo if exists.
             */
            if ($product->image) {
                Storage::delete($path . $product->image);
            }

            $file->storeAs($path, $fileName);
            $validatedData['image'] = $fileName;
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
        if ($product->image) {
            Storage::delete('public/products/' . $product->image);
        }

        Product::destroy($product->id);

        return Redirect::route('products.index')->with('success', 'Product has been deleted!');
    }

    /**
     * Show the form for importing a new resource.
     */
    public function importView()
    {
        return view('products.import');
    }

    public function importStore(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('upload_file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $column_limit = $sheet->getHighestDataColumn();
            $row_range = range(2, $row_limit);
            $column_range = range('J', $column_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $name = $sheet->getCell('A' . $row)->getValue();
                $data[] = [
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'category_id' => $sheet->getCell('B' . $row)->getValue(),
                    'code' => $sheet->getCell('C' . $row)->getValue(),
                    'image' => $sheet->getCell('D' . $row)->getValue(),
                    'stock' => $sheet->getCell('E' . $row)->getValue(),
                    'buying_date' => $sheet->getCell('F' . $row)->getValue(),
                    'expire_date' => $sheet->getCell('G' . $row)->getValue(),
                    'buying_price' => $sheet->getCell('H' . $row)->getValue(),
                    'selling_price' => $sheet->getCell('I' . $row)->getValue(),
                ];
                $startcount++;
            }

            Product::insert($data);

        } catch (Exception $e) {
            // $error_code = $e->errorInfo[1];
            return Redirect::route('products.index')->with('error', 'There was a problem uploading the data!');
        }
        return Redirect::route('products.index')->with('success', 'Data has been successfully imported!');
    }

    public function exportExcel($products)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');

        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->fromArray($products);
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Products_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }

    /**
     * This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    function exportData()
    {
        $products = Product::all()->sortByDesc('id');

        $product_array[] = array(
            'Product Name',
            'Category Id',
            'Product Code',
            'Product Image',
            'Stock',
            'Buying Date',
            'Expire Date',
            'Buying Price',
            'Selling Price',
        );

        foreach ($products as $product) {
            $product_array[] = array(
                'Product Name' => $product->name,
                'Category Id' => $product->category_id,
                'Product Code' => $product->code,
                'Product Image' => $product->image,
                'Stock' => $product->stock,
                'Buying Date' => $product->buying_date,
                'Expire Date' => $product->expire_date,
                'Buying Price' => $product->buying_price,
                'Selling Price' => $product->selling_price,
            );
        }

        $this->ExportExcel($product_array);
    }
}
