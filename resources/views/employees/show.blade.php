@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Employee Details</h4>
                        </div>
                        <div>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary font-size-14">Edit
                                Profile</a>
                            <a href="{{ route('employees.index') }}" class="btn btn-secondary font-size-14">Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Section: Left Profile (Image & Contact) -->
                            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 pr-lg-4 border-lg-right">
                                <div class="d-flex align-items-center mb-4 justify-content-center justify-content-lg-start">
                                    <div class="profile-img position-relative">
                                        <img src="{{ $employee->photo ? asset('storage/employees/' . $employee->photo) : asset('assets/images/user/1.png') }}"
                                            class="img-fluid rounded avatar-110" alt="profile-image"
                                            style="object-fit: cover;">
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="mb-1">{{ $employee->name }}</h4>
                                        <p class="mb-2 text-muted">Employee ID: #{{ $employee->id }}</p>
                                    </div>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-envelope class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $employee->email }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-phone class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $employee->phone }}</span>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <div class="d-flex align-items-center">
                                            <x-heroicon-o-map-pin class="w-6 h-6 mr-3 text-primary" />
                                            <span class="mb-0">{{ $employee->city ?? 'Unknown' }}</span>
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
                                        <p class="font-weight-bold">{{ $employee->name }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Email</h6>
                                        <p class="font-weight-bold">{{ $employee->email }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Phone</h6>
                                        <p class="font-weight-bold">{{ $employee->phone }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Experience</h6>
                                        <p class="font-weight-bold">{{ $employee->experience ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Salary</h6>
                                        <p class="font-weight-bold text-success">${{ number_format($employee->salary, 2) }}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">Vacation Days</h6>
                                        <p class="font-weight-bold">{{ $employee->vacation ?? '-' }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-muted">City</h6>
                                        <p class="font-weight-bold">{{ $employee->city }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Address</h6>
                                        <p class="font-weight-bold">{{ $employee->address }}</p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6 class="text-muted">Joined At</h6>
                                        <p class="font-weight-bold">{{ $employee->created_at->format('d M Y') }}</p>
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
