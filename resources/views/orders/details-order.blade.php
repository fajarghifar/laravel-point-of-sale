@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Order Details Information</h4>
                        </div>
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                                <x-heroicon-o-arrow-left class="w-4 h-4 mr-1 inline" /> Back
                            </a>
                        </div>
                        </div>

                    <div class="card-body">
                        <!-- Customer Profile Info -->
                        <div class="d-flex align-items-center mb-4">
                            <div>
                                <h5 class="mb-1">{{ $order->customer->name }}</h5>
                                <p class="mb-0 text-muted">{{ $order->customer->email }}</p>
                                <p class="mb-0 text-muted">{{ $order->customer->address }}</p>
                            </div>
                        </div>

                        <!-- Order Information Form (Read Only) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control bg-white" value="{{ $order->customer->name }}" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Phone</label>
                                    <input type="text" class="form-control bg-white" value="{{ $order->customer->phone }}" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                    <input type="text" class="form-control bg-white" value="{{ $order->order_date->format('Y-m-d') }}" readonly>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order Invoice</label>
                                            <input class="form-control bg-white" value="{{ $order->invoice_no }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Payment Type</label>
                                            <input class="form-control bg-white" value="{{ $order->payment_type }}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Paid Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                        <input type="text" class="form-control bg-white" value="{{ number_format($order->pay_amount, 2) }}" readonly>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Due Amount</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                        <input type="text" class="form-control bg-white" value="{{ number_format($order->due_amount, 2) }}" readonly>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

                        <!-- Actions for Pending Orders -->
                        @if ($order->order_status == 'pending')
                            <div class="row mt-4">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <form action="{{ route('order.updateStatus') }}" method="POST" class="d-inline">
                                        @method('put')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}">

                                        <a class="btn btn-outline-danger mr-2" href="{{ route('order.pendingOrders') }}">
                                            <x-heroicon-o-x-mark class="w-5 h-5 mr-1 inline" /> Cancel
                                        </a>

                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Are you sure you want to complete this order? This reduces stock.')">
                                            <x-heroicon-o-check-circle class="w-5 h-5 mr-1 inline" /> Complete Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="alert alert-success text-center" role="alert">
                                        <x-heroicon-o-check-circle class="w-5 h-5 mr-1 inline" /> This order is completed.
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                        </div>
                        </div>

            <!-- Order Items Table -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Order Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive rounded">
                            <table class="table mb-0">
                                <thead class="bg-light text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>No.</th>
                                        <th>Photo</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    @foreach ($orderDetails as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img class="avatar-50 rounded"
                                                    src="{{ $item->product->image ? asset('storage/products/' . $item->product->image) : asset('assets/images/product/default.webp') }}"
                                                    alt="{{ $item->product->name }}" style="object-fit: cover;">
                                            </td>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->product->code }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ number_format($item->unit_price, 2) }}</td>
                                            <td>{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-light">
                                    <tr>
                                        <td colspan="6" class="text-right font-weight-bold">Subtotal</td>
                                        <td class="font-weight-bold">{{ number_format($order->sub_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right font-weight-bold">VAT</td>
                                        <td class="font-weight-bold">{{ number_format($order->vat, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-right font-weight-bold text-primary" style="font-size: 1.1em;">
                                            Total</td>
                                        <td class="font-weight-bold text-primary" style="font-size: 1.1em;">
                                            {{ number_format($order->total, 2) }}
                                        </td>
                                        </tr>
                                        </tfoot>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
        </div>
        </div>
@endsection
