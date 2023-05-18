<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard.index', [
            'total_paid' => Order::sum('pay'),
            'total_due' => Order::sum('due'),
            'complete_orders' => Order::where('order_status', 'complete')->get(),
            'products' => Product::orderBy('product_store')->take(5)->get(),
            'new_products' => Product::orderBy('buying_date')->take(2)->get(),
        ]);
    }
}
