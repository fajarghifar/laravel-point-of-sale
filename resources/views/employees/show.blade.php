@extends('dashboard.body.main')

@section('container')
<div class="container-fluid mb-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card car-transparent">
                <div class="card-body p-0">
                    <div class="profile-image position-relative">
                        <img src="{{ asset('assets/images/page-img/profile.png') }}" class="img-fluid rounded h-30 w-100" alt="profile-image">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <!-- begin: Left Detail Employee -->
        <div class="col-lg-4 card-profile mb-5 h-50">
            <div class="card card-block card-stretch card-height mb-5">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="profile-img position-relative">
                            <img src="{{ $employee->photo ? asset('storage/employees/' . $employee->photo) : asset('assets/images/user/1.png') }}" class="img-fluid rounded avatar-110" alt="profile-image">
                        </div>
                        <div class="ml-3">
                            <h4 class="mb-1">{{ $employee->name }}</h4>
                            <p class="mb-2">UI/UX Designer</p>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary font-size-14">Edit</a>
                            <a href="{{ route('employees.index') }}" class="btn btn-danger font-size-14">Back</a>
                        </div>
                    </div>
                    <ul class="list-inline p-0 m-0">
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="mb-0">{{ $employee->email }}</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <p class="mb-0">{{ $employee->phone }}</p>
                            </div>
                        </li>
                        <li class="mb-2">
                            <div class="d-flex align-items-center">
                                <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="mb-0">{{ $employee->city ? $employee->city : 'Unknown' }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: Left Detail Employee -->

        <!-- begin: Right Detail Employee -->
        <div class="col-lg-8 card-profile">
            <div class="card card-block card-stretch mb-0">
                <div class="card-header px-3">
                    <div class="header-title">
                        <h4 class="card-title">Employee Information</h4>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-inline p-0 mb-0">
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Name</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->name }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Email</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->email }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Phone</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->phone }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Experience</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->experience }}" readonly>
                                </div>
                            </div>
                        </li>
                        {{-- Experience --}}
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Salary</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="${{ $employee->salary }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Vacation</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->vacation }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">City</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <input type="text" class="form-control bg-white" value="{{ $employee->city }}" readonly>
                                </div>
                            </div>
                        </li>
                        <li class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-4">
                                    <label class="col-form-label">Address</label>
                                </div>
                                <div class="col-sm-9 col-8">
                                    <textarea class="form-control bg-white" readonly>{{ $employee->address }}</textarea>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: Right Detail Employee -->
    </div>
</div>
@endsection
