@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Customer Details</h4>
                        </div>
                        <div>
                            <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary font-size-14">Edit
                                Profile</a>
                            <a href="{{ route('customers.index') }}" class="btn btn-secondary font-size-14">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Section: Left Profile (Contact) -->
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 pr-lg-4 border-lg-right">
                                <div class="d-flex align-items-center mb-4 justify-content-center justify-content-lg-start">
                                    <div class="ml-3">
                                        <h4 class="mb-1">{{ $customer->name }}</h4>
                                        <p class="mb-2 text-muted">Customer ID: #{{ $customer->id }}</p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-envelope class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $customer->email }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-phone class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $customer->phone }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-map-pin class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $customer->city ?? 'Unknown' }}</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Section: Right Detailed Info -->
                            <div class="col-lg-8 col-md-12 pl-lg-4">
                                <h5 class="mb-3">Information</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Full Name</h6>
                                        <p class="font-weight-bold">{{ $customer->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Email</h6>
                                        <p class="font-weight-bold">{{ $customer->email }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Phone</h6>
                                        <p class="font-weight-bold">{{ $customer->phone }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">City</h6>
                                        <p class="font-weight-bold">{{ $customer->city }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Address</h6>
                                        <p class="font-weight-bold">{{ $customer->address }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Joined At</h6>
                                        <p class="font-weight-bold">{{ $customer->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
