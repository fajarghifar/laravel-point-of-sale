@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Pending Order List</h4>
                </div>
                <div>
                    <a href="{{ route('order.pendingDue') }}" class="btn btn-danger add-list"><i class="fa-solid fa-trash mr-3"></i>Clear Search</a>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('order.pendingDue') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search order" value="{{ request('search') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-primary"><i class="fa-solid fa-magnifying-glass font-size-20"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Invoice No</th>
                            <th>@sortablelink('customer.name', 'name')</th>
                            <th>@sortablelink('order_date', 'order date')</th>
                            <th>Payment</th>
                            <th>@sortablelink('pay')</th>
                            <th>@sortablelink('due')</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ (($orders->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>{{ $order->invoice_no }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ Carbon\Carbon::parse($order->order_date)->format('Y m, d') }}</td>
                            <td>{{ $order->payment_status }}</td>
                            <td>
                                <span class="btn btn-warning text-white">
                                    {{ $order->pay }}
                                </span>
                            </td>
                            <td>
                                <span class="btn btn-danger text-white">
                                    {{ $order->due }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Details" href="{{ route('order.orderDetails', $order->id) }}">
                                        Details
                                    </a>
                                    <button type="button" class="btn btn-primary-dark mr-2" data-toggle="modal" data-target=".bd-example-modal-lg" id="{{ $order->id }}" onclick="payDue(this.id)">Pay Due</button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
    <!-- Page end  -->
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('order.updateDue') }}" method="post">
                @csrf
                <input type="hidden" name="order_id" id="order_id">
                <div class="modal-body">
                    <h3 class="modal-title text-center mx-auto">Pay Due</h3>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="due">Pay Now</label>
                            <input type="text" class="form-control bg-white @error('due') is-invalid @enderror" id="due" name="due">
                            @error('due')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
    function payDue(id){
        $.ajax({
            type: 'GET',
            url : '/order/due/' + id,
            dataType: 'json',
            success: function(data) {
                $('#due').val(data.due);
                $('#order_id').val(data.id);
            }
        });
    }
</script>

@endsection
