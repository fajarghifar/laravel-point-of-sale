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
                        <h4 class="mb-3">Pending Due List</h4>
                        <p class="mb-0">List of orders with outstanding due amounts.</p>
                    </div>
                    <div>
                        <a href="{{ route('order.pendingDue') }}" class="btn btn-danger add-list d-flex align-items-center">
                            <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Clear Search
                        </a>
                    </div>
                </div>
                </div>

            <div class="col-lg-12">
                <!-- Main Content Card -->
                <div class="card">
                    <div class="card-body">

                        <!-- Filter Form -->
                        <form action="{{ route('order.pendingDue') }}" method="get">
                            <div class="d-flex flex-wrap align-items-center justify-content-between">
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
                                        <th><x-sort-link name="pay_amount" label="Pay" /></th>
                                        <th><x-sort-link name="due_amount" label="Due" /></th>
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
                                            <td>{{ number_format($order->pay_amount, 2) }}</td>
                                            <td>
                                                <span class="badge badge-warning">{{ number_format($order->due_amount, 2) }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center list-action">
                                                    <!-- Details Button -->
                                                    <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Details"
                                                        href="{{ route('order.orderDetails', $order->id) }}">
                                                        <x-heroicon-o-eye class="w-5 h-5 mr-0" />
                                                    </a>
                                                    <!-- Pay Due Button -->
                                                    <button type="button" class="btn btn-primary bg-primary mr-2 border-0" data-toggle="modal"
                                                        data-target="#pay-due-modal" id="{{ $order->id }}" onclick="payDue(this.id)">
                                                        <x-heroicon-o-banknotes class="w-5 h-5 mr-0" />
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No pending due orders found.</td>
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

    <!-- Modal: Pay Due Amount -->
    <div class="modal fade" id="pay-due-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay Due Amount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('order.updateDue') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="form-group">
                            <label for="due_amount">Pay Amount</label>
                            <input type="number" class="form-control" name="due_amount" id="due_amount" required step="0.01">
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>

    <script>
        function payDue(id) {
            $.ajax({
                type: 'GET',
                url: '/order/due/' + id,
                dataType: 'json',
                success: function (data) {
                    $('#due_amount').val(data.due_amount);
                    $('#order_id').val(data.id);
                }
            });
        }
    </script>
@endsection
