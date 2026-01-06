@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Invoice Preview Card -->
            <div class="sc-card shadow-sm border-0 rounded-lg">
                <div class="card-body p-0">

                    <!-- Toolbar: Actions -->
                    <div class="d-flex justify-content-between align-items-center p-4 bg-light border-bottom rounded-top-lg">
                        <div>
                            <h5 class="mb-0 font-weight-bold text-dark">Invoice Preview</h5>
                            <p class="mb-0 text-muted small">Order #{{ $order->invoice_no }}</p>
                        </div>
                        <div>
                            <a href="{{ route('pos.index') }}" class="btn btn-outline-secondary btn-sm mr-2">
                                <x-heroicon-o-arrow-left class="w-4 h-4 mr-1 inline"/> Back to POS
                            </a>
                            <!-- Opens dedicated Thermal Receipt Popup -->
                            <button onclick="openPrintWindow()" class="btn btn-dark btn-sm shadow-sm">
                                <x-heroicon-o-printer class="w-4 h-4 mr-1 inline"/> Print Receipt
                            </button>
                        </div>
                    </div>

                    <!-- Visual Invoice Representation -->
                    <div class="p-5">
                        <!-- Company Header -->
                        <div class="row mb-5">
                            <div class="col-6">
                                <h3 class="font-weight-bold text-dark mb-1">POS SHOP</h3>
                                <p class="text-muted mb-0">123 Commerce Avenue</p>
                                <p class="text-muted">Jakarta, Indonesia</p>
                            </div>
                            <div class="col-6 text-right">
                                <h6 class="text-uppercase text-muted font-weight-bold letter-spacing-2 mb-2">Invoice</h6>
                                <h4 class="font-weight-bold text-dark mb-0">{{ $order->invoice_no }}</h4>
                                <p class="text-muted small mb-0">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                <span class="badge badge-success mt-1 px-3 py-1">PAID</span>
                            </div>
                        </div>

                        <hr class="border-light my-4">

                        <!-- Client & Cashier Info -->
                        <div class="row mb-5">
                            <div class="col-6">
                                <p class="text-uppercase text-muted small font-weight-bold mb-2">Billed To</p>
                                <h6 class="font-weight-bold text-dark mb-1">{{ $order->customer->name }}</h6>
                                <p class="text-muted small mb-0">{{ $order->customer->phone ?? '' }}</p>
                            </div>
                            <div class="col-6 text-right">
                                <p class="text-uppercase text-muted small font-weight-bold mb-2">Cashier</p>
                                <h6 class="font-weight-bold text-dark mb-0">{{ auth()->user()->name ?? 'Staff' }}</h6>
                            </div>
                        </div>

                        <!-- Order Items Table -->
                        <div class="table-responsive mb-4">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 font-weight-bold text-muted small text-uppercase pl-4">Item</th>
                                        <th class="border-0 font-weight-bold text-muted small text-uppercase text-center">Qty</th>
                                        <th class="border-0 font-weight-bold text-muted small text-uppercase text-right">Price</th>
                                        <th class="border-0 font-weight-bold text-muted small text-uppercase text-right pr-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderDetails as $item)
                                        <tr>
                                            <td class="border-bottom-0 pl-4 py-3">
                                                <p class="font-weight-bold text-dark mb-0">{{ $item->product->name }}</p>
                                            </td>
                                            <td class="border-bottom-0 text-center py-3">{{ $item->quantity }}</td>
                                            <td class="border-bottom-0 text-right py-3">{{ number_format($item->unit_price, 2) }}</td>
                                            <td class="border-bottom-0 text-right py-3 pr-4 font-weight-bold">{{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Calculation Totals -->
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <table class="table table-sm table-borderless">
                                    <tr>
                                        <td class="text-muted">Subtotal</td>
                                        <td class="text-right font-weight-bold">{{ number_format($order->sub_total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Tax (VAT)</td>
                                        <td class="text-right font-weight-bold">{{ number_format($order->vat, 2) }}</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="text-dark font-weight-bold pt-3 h5">Total</td>
                                        <td class="text-primary font-weight-bold text-right pt-3 h5">{{ number_format($order->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">Paid</td>
                                        <td class="text-success text-right font-weight-bold">{{ number_format($order->pay_amount, 2) }}</td>
                                    </tr>
                                     <tr>
                                        <td class="text-muted">Change</td>
                                        <td class="text-dark text-right font-weight-bold">{{ number_format($order->due_amount < 0 ? abs($order->due_amount) : 0, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Opens the dedicated Thermal Receipt View in a new small window for printing.
     */
    function openPrintWindow() {
        const url = "{{ route('order.printReceipt', $order->id) }}";
        const width = 400;
        const height = 600;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        window.open(url, 'PrintReceipt', `width=${width},height=${height},top=${top},left=${left},scrollbars=yes`);
    }
</script>
@endsection
