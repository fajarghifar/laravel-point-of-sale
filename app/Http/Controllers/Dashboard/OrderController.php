<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedSort;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Http\Requests\Order\StoreOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of pending orders.
     */
    public function pendingOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = QueryBuilder::for(Order::class)
            ->where('order_status', 'pending')
            ->allowedSorts([
                'order_date',
                'total',
                AllowedSort::callback('customer.name', function ($query, $descending) {
                    $query->join('customers', 'orders.customer_id', '=', 'customers.id')
                        ->orderBy('customers.name', $descending ? 'DESC' : 'ASC')
                        ->select('orders.*');
                })
            ])
            ->with('customer')
            ->paginate($row);

        return view('orders.pending-orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Display a listing of complete orders.
     */
    public function completeOrders()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = QueryBuilder::for(Order::class)
            ->where('order_status', 'complete')
            ->allowedSorts([
                'order_date',
                'total',
                AllowedSort::callback('customer.name', function ($query, $descending) {
                    $query->join('customers', 'orders.customer_id', '=', 'customers.id')
                        ->orderBy('customers.name', $descending ? 'DESC' : 'ASC')
                        ->select('orders.*');
                })
            ])
            ->with('customer')
            ->paginate($row);

        return view('orders.complete-orders', [
            'orders' => $orders
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function storeOrder(StoreOrderRequest $request)
    {
        // Validation handled by StoreOrderRequest

        return DB::transaction(function () use ($request) {
            $invoice_no = IdGenerator::generate([
                'table' => 'orders',
                'field' => 'invoice_no',
                'length' => 10,
                'prefix' => 'INV-'
            ]);

            $total = (float) Cart::total(null, null, ''); // Get float value
            $pay_amount = $request->pay_amount;
            $due_amount = $total - $pay_amount;

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'invoice_no' => $invoice_no,
                'order_date' => Carbon::now(),
                'order_status' => 'pending',
                'total_products' => Cart::count(),
                'sub_total' => (float) Cart::subtotal(null, null, ''),
                'vat' => (float) Cart::tax(null, null, ''),
                'total' => $total,
                'payment_type' => $request->payment_type,
                'pay_amount' => $pay_amount,
                'due_amount' => $due_amount,
            ]);

            // Create Order Details
            $contents = Cart::content();
            foreach ($contents as $content) {
                OrderDetails::create([
                    'order_id' => $order->id,
                    'product_id' => $content->id,
                    'quantity' => $content->qty,
                    'unit_price' => $content->price,
                    'total' => $content->total,
                ]);
            }

            // Clear Cart
            Cart::destroy();

            if ($request->wantsJson()) {
                // Return success with Invoice URL and Cleared Cart HTML
                return response()->json([
                    'success' => true,
                    'message' => 'Order created successfully!',
                    'invoice_url' => route('order.invoiceDownload', $order->id),
                    'cart_html' => view('pos.cart-sidebar', ['productItem' => Cart::content()])->render(),
                ]);
            }

            return Redirect::route('order.invoiceDownload', $order->id)->with('success', 'Order has been created!');
        });
    }

    /**
     * Display the specified resource.
     */
    public function orderDetails(int $order_id)
    {
        $order = Order::with('customer')->findOrFail($order_id);
        $orderDetails = OrderDetails::with('product')
                        ->where('order_id', $order_id)
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('orders.details-order', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request)
    {
        $order_id = $request->id;

        DB::transaction(function () use ($order_id) {
            $products = OrderDetails::where('order_id', $order_id)->get();

            foreach ($products as $detail) {
                Product::where('id', $detail->product_id)
                    ->decrement('stock', $detail->quantity);
            }

            Order::findOrFail($order_id)->update(['order_status' => 'complete']);
        });

        return Redirect::route('order.pendingOrders')->with('success', 'Order has been completed!');
    }

    public function invoiceDownload(int $order_id)
    {
        $order = Order::with('customer')->findOrFail($order_id);
        $orderDetails = OrderDetails::with('product')
            ->where('order_id', $order_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('pos.print-invoice', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    public function printReceipt(int $order_id)
    {
        $order = Order::with('customer')->findOrFail($order_id);
        $orderDetails = OrderDetails::with('product')
                        ->where('order_id', $order_id)
                        ->orderBy('id', 'DESC')
                        ->get();

        return view('pos.print-receipt', [
            'order' => $order,
            'orderDetails' => $orderDetails,
        ]);
    }

    public function pendingDue()
    {
        $row = (int) request('row', 10);

        if ($row < 1 || $row > 100) {
            abort(400, 'The per-page parameter must be an integer between 1 and 100.');
        }

        $orders = QueryBuilder::for(Order::class)
            ->where('due_amount', '>', 0)
            ->allowedSorts([
                'order_date',
                'due_amount',
                'pay_amount',
                AllowedSort::callback('customer.name', function ($query, $descending) {
                    $query->join('customers', 'orders.customer_id', '=', 'customers.id')->orderBy('customers.name', $descending ? 'DESC' : 'ASC')->select('orders.*');
                })
            ])
            ->with('customer')
            ->paginate($row);

        return view('orders.pending-due', [
            'orders' => $orders
        ]);
    }

    public function orderDueAjax(int $id)
    {
        $order = Order::findOrFail($id);

        return response()->json($order);
    }

    public function updateDue(Request $request)
    {
        $request->validate([
            'order_id' => 'required|numeric',
            'due_amount' => 'required|numeric',
        ]);

        $order = Order::findOrFail($request->order_id);
        $mainPay = $order->pay_amount;
        $mainDue = $order->due_amount;

        $paid_due = $mainDue - $request->due_amount;
        $paid_pay = $mainPay + $request->due_amount;

        $order->update([
            'due_amount' => $paid_due,
            'pay_amount' => $paid_pay,
        ]);

        return Redirect::route('order.pendingDue')->with('success', 'Due Amount Updated Successfully!');
    }
}
