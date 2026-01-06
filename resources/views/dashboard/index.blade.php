@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <!-- Success Message -->
        <div class="row">
            <div class="col-lg-12">
                @if(session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <!-- Banner / Welcome Section -->
            <div class="col-lg-12 mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h3 class="font-weight-bold">Dashboard Overview</h3>
                        <p class="mb-0 text-muted">Welcome back, {{ auth()->user()->name }}! Here's what's happening in your
                            store today.</p>
                    </div>
                    <div>
                        <a href="{{ route('pos.index') }}" class="btn btn-primary">
                            <x-heroicon-o-computer-desktop class="w-5 h-5 mr-2" />
                            Go to POS
                        </a>
                    </div>
                </div>
            </div>

            <!-- Metric Cards -->
            <div class="col-lg-3 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-info-light">
                                <x-heroicon-o-banknotes class="w-6 h-6 text-info" />
                            </div>
                            <div>
                                <p class="mb-2">Total Paid</p>
                                <h4>${{ number_format($total_paid, 2) }}</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-info iq-progress progress-1" data-percent="85" style="width: 85%;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-danger-light">
                                <x-heroicon-o-credit-card class="w-6 h-6 text-danger" />
                            </div>
                            <div>
                                <p class="mb-2">Total Due</p>
                                <h4>${{ number_format($total_due, 2) }}</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-danger iq-progress progress-1" data-percent="40" style="width: 40%;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-success-light">
                                <x-heroicon-o-check-circle class="w-6 h-6 text-success" />
                            </div>
                            <div>
                                <p class="mb-2">Complete Orders</p>
                                <h4>{{ $complete_orders }}</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-success iq-progress progress-1" data-percent="75" style="width: 75%;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4 card-total-sale">
                            <div class="icon iq-icon-box-2 bg-warning-light">
                                <x-heroicon-o-clock class="w-6 h-6 text-warning" />
                            </div>
                            <div>
                                <p class="mb-2">Pending Orders</p>
                                <h4>{{ $pending_orders }}</h4>
                            </div>
                        </div>
                        <div class="iq-progress-bar mt-2">
                            <span class="bg-warning iq-progress progress-1" data-percent="25" style="width: 25%;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sales Chart -->
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Monthly Sales Overview ({{ date('Y') }})</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="monthly-sales-chart"></div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section: Recent Orders & Top Products -->
            <div class="col-lg-7 col-md-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Recent Orders</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <a href="{{ route('order.pendingOrders') }}"
                                class="btn btn-outline-primary position-relative text-nowrap">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    @forelse($recent_orders as $order)
                                        <tr>
                                            <td>{{ $order->created_at->format('d M Y') }}</td>
                                            <td>{{ $order->customer->name ?? 'Walk-in Customer' }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $order->order_status == 'complete' ? 'bg-success' : 'bg-warning' }}">
                                                    {{ ucfirst($order->order_status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ route('order.orderDetails', $order->id) }}">
                                                    <x-heroicon-o-eye class="w-4 h-4" />
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No recent orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Top Selling Products</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Product</th>
                                        <th>Code</th>
                                        <th>Sold</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    @forelse($top_products as $product)
                                        <tr>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td><strong>{{ $product->total_sold }}</strong></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No sales data yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
        </div>
    </div>
@endsection

@section('specificpagescripts')
    <!-- ApexCharts -->
    <script>
            document.addEventListener("DOMContentLoaded", function () {
            if (typeof ApexCharts !== 'undefined') {
                var options = {
                    series: [{
                        name: 'Sales',
                        data: {!! $chart_data !!}
                    }],
                    chart: {
                        height: 350,
                        type: 'area',
                        toolbar: {
                            show: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ],
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "$ " + val
                            }
                        }
                    },
                    colors: ['#4788ff'],
                    fill: {
                        type: "gradient",
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            stops: [0, 90, 100]
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#monthly-sales-chart"), options);
                chart.render();
            } else {
                console.warn('ApexCharts library not found. Sales chart cannot be rendered.');
            }
        });
    </script>
@endsection
