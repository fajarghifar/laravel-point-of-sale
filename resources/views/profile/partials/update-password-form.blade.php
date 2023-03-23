<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Change Password</h3>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Password-->
        <div class="d-flex flex-wrap align-items-center mb-10">
            <!--begin::Edit-->
            <div class="flex-row-fluid">
                <!--begin::Form-->
                <form action="{{ route('password.update') }}" method="POST" class="form">
                    @csrf
                    @method('put')

                    <div class="row mb-1">
                        <div class="col-lg-4">
                            <div class="fv-row mb-0">
                                <label for="current_password" class="form-label fs-6 fw-bold mb-3">Current Password</label>
                                <input type="password" class="form-control form-control-lg form-control-solid @error('current_password') is-invalid @enderror" name="current_password" id="current_password" required>
                                <div class="invalid-feedback">
                                    @error('current_password')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="fv-row mb-0">
                                <label for="password" class="form-label fs-6 fw-bold mb-3">New Password</label>
                                <input type="password" class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" name="password" id="password" required>
                                <div class="invalid-feedback">
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="fv-row mb-0">
                                <label for="password_confirmation" class="form-label fs-6 fw-bold mb-3">Confirm New Password</label>
                                <input type="password" class="form-control form-control-lg form-control-solid @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" required>
                                <div class="invalid-feedback">
                                    @error('password_confirmation')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary me-2 px-6">Update Password</button>
                        <a href="{{ route('profile') }}" class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</a>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Edit-->
        </div>
        <!--end::Password-->
    </div>
    <!--end::Card body-->
</div>
