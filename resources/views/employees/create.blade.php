@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Employee</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Section: Image Upload -->
                            <div class="form-group row align-items-center">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <div class="profile-img-edit position-relative">
                                            <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview"
                                                src="{{ asset('assets/images/user/1.png') }}" alt="profile-pic"
                                                style="object-fit: cover;">
                                            <div class="crm-p-image bg-primary position-absolute rounded-circle d-flex align-items-center justify-content-center"
                                                style="width: 32px; height: 32px; bottom: 0; right: 0;">
                                                <label for="image"
                                                    class="d-flex align-items-center justify-content-center m-0 w-100 h-100"
                                                    style="cursor: pointer;">
                                                    <x-heroicon-o-pencil class="w-4 h-4 text-white" />
                                                </label>
                                                <input class="file-upload" type="file" id="image" name="photo"
                                                    accept="image/*" onchange="previewImage();" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="img-extension mt-3">
                                            <span class="text-muted small">Only .jpg, .png, .jpeg allowed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Section: Personal Information -->
                            <div class="row align-items-center">
                                <div class="form-group col-md-6">
                                    <label for="name">Employee Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                        name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Employee Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Employee Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city">Employee City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city"
                                        name="city" value="{{ old('city') }}" placeholder="Enter city" required>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="salary">Employee Salary ($) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('salary') is-invalid @enderror" id="salary" name="salary"
                                        value="{{ old('salary') }}" placeholder="Enter salary amount" required>
                                    @error('salary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="experience">Experience</label>
                                    <select class="form-control @error('experience') is-invalid @enderror" name="experience"
                                        id="experience">
                                        <option value="" disabled selected>Select Experience Year...</option>
                                        <option value="1 Year" {{ old('experience') == '1 Year' ? 'selected' : '' }}>1 Year
                                        </option>
                                        <option value="2 Year" {{ old('experience') == '2 Year' ? 'selected' : '' }}>2 Year
                                        </option>
                                        <option value="3 Year" {{ old('experience') == '3 Year' ? 'selected' : '' }}>3 Year
                                        </option>
                                        <option value="4 Year" {{ old('experience') == '4 Year' ? 'selected' : '' }}>4 Year
                                        </option>
                                        <option value="5 Year" {{ old('experience') == '5 Year' ? 'selected' : '' }}>5 Year
                                        </option>
                                        <option value="5+ Year" {{ old('experience') == '5+ Year' ? 'selected' : '' }}>5+
                                            Year</option>
                                    </select>
                                    @error('experience')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="vacation">Vacation Days</label>
                                    <input type="text" class="form-control @error('vacation') is-invalid @enderror"
                                        id="vacation" name="vacation" value="{{ old('vacation') }}"
                                        placeholder="Enter vacation days">
                                    @error('vacation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                        placeholder="Enter full address" required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Section: Form Actions -->
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">Save Employee</button>
                                <a class="btn btn-secondary" href="{{ route('employees.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.preview-img-form')
@endsection
