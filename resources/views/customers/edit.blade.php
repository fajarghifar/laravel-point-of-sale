@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Customer</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                        <!-- begin: Input Image -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" src="{{ $customer->photo ? asset('storage/customers/'.$customer->photo) : asset('assets/images/user/1.png') }}" alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="image" name="photo" accept="image/*" onchange="previewImage();">
                                    <label class="custom-file-label" for="photo">Choose file</label>
                                </div>
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Image -->
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $customer->name) }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shopname">Shop Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('shopname') is-invalid @enderror" id="shopname" name="shopname" value="{{ old('shopname', $customer->shopname) }}" required>
                                @error('shopname')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Customer Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $customer->email) }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Customer Phone <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" required>
                                @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="account_holder">Account Holder</label>
                                <input type="text" class="form-control @error('account_holder') is-invalid @enderror" id="account_holder" name="account_holder" value="{{ old('account_holder', $customer->account_holder) }}">
                                @error('account_holder')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_name">Bank Name</label>
                                <select class="form-control @error('bank_name') is-invalid @enderror" name="bank_name">
                                    <option value="">Select Year..</option>
                                    <option value="BRI" @if(old('bank_name', $customer->bank_name) == 'BRI')selected="selected"@endif>BRI</option>
                                    <option value="BNI" @if(old('bank_name', $customer->bank_name) == 'BNI')selected="selected"@endif>BNI</option>
                                    <option value="BCA" @if(old('bank_name', $customer->bank_name) == 'BCA')selected="selected"@endif>BCA</option>
                                    <option value="BSI" @if(old('bank_name', $customer->bank_name) == 'BSI')selected="selected"@endif>BSI</option>
                                    <option value="Mandiri" @if(old('bank_name', $customer->bank_name) == 'Mandiri')selected="selected"@endif>Mandiri</option>
                                </select>
                                @error('bank_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="account_number">Account Number</label>
                                <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number', $customer->account_number) }}">
                                @error('account_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bank_branch">Bank Branch</label>
                                <input type="text" class="form-control @error('bank_branch') is-invalid @enderror" id="bank_branch" name="bank_branch" value="{{ old('bank_branch', $customer->bank_branch) }}">
                                @error('bank_branch')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="city">Customer City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $customer->city) }}" required>
                                @error('city')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="address">Customer Address <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" required>{{ old('address', $customer->address) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                            <a class="btn bg-danger" href="{{ route('customers.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

@include('components.preview-img-form')
@endsection
