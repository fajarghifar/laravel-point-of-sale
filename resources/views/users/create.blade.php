@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create User</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <!-- begin: Input Image -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" src="{{ asset('assets/images/user/1.png') }}" alt="profile-pic">
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
                            <div class="form-group col-md-12">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required  autocomplete="off">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="role">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option selected="" disabled>-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('users.index') }}">Cancel</a>
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
