@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <!-- Alert: Success Message -->
                @if (session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>
                @endif

                <!-- Header: Page Title and Clear Search -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Pending Order List</h4>
                        <p class="mb-0">Orders that are currently pending. You can view details to complete them.</p>
                    </div>
                    <div>
                        <a href="{{ route('order.pendingOrders') }}" class="btn btn-danger add-list d-flex align-items-center">
                            <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Clear Search
                        </a>
                    </div>
                </div>
                </div>

            <div class="col-lg-12">
                <!-- Main Card -->
                <div class="card">
                    <div class="card-body">

                        <!-- Filter Form -->
                        <form action="{{ route('order.pendingOrders') }}" method="get">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
                                <!-- Row Selector -->
                                <div class="form-group row">
                                    <label for="row" class="col-sm-3 align-self-center">Row:</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="row">
                                            <option value="10" @if (request('row') == '10') selected="selected" @endif>10
                                            </option>
                                            <option value="25" @if (request('row') == '25') selected="selected" @endif>25
                                            </option>
                                            <option value="50" @if (request('row') == '50') selected="selected" @endif>50
                                            </option>
                                            <option value="100" @if (request('row') == '100') selected="selected" @endif>100
                                            </option>
                                            </select>
                                            </div>
                                            </div>

                                <!-- Search Input -->
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="search" class="form-control" name="search" placeholder="Search order"
                                                value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text bg-primary">
                                                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                                                </button>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </form>

                        <!-- Orders Table -->
                        <div class="table-responsive rounded mb-3">
                            <table class="table mb-0">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>No.</th>
                                        <th>Invoice No</th>
                                        <th><x-sort-link name="customer.name" label="Name" /></th>
                                        <th><x-sort-link name="order_date" label="Order Date" /></th>
                                        <th>Payment</th>
                                        <th><x-sort-link name="total" label="Total" /></th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ (($orders->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>{{ $order->customer->name }}</td>
                                            <td>{{ $order->order_date->format('Y-m-d') }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span class="badge badge-warning">{{ ucfirst($order->order_status) }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Details"
                                                        href="{{ route('order.orderDetails', $order->id) }}">
                                                        <x-heroicon-o-eye class="w-5 h-5 mr-0" />
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No pending orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{ $orders->links() }}
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
@endsection
