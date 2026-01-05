@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Supplier</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row align-items-center">
                                {{-- Section: Personal Information --}}
                                <div class="form-group col-md-6">
                                    <label for="name">Supplier Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                        value="{{ old('name', $supplier->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="email">Supplier Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                        value="{{ old('email', $supplier->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone">Supplier Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                        value="{{ old('phone', $supplier->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city">Supplier City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                                        value="{{ old('city', $supplier->city) }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="address">Supplier Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                        required>{{ old('address', $supplier->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Section: Form Actions --}}
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">Update</button>
                                <a class="btn btn-secondary" href="{{ route('suppliers.index') }}">Cancel</a>
                            </div>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
@endsection
