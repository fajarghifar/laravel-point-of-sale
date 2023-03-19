@extends('auth.body.main')

@section('container')
<!--begin::Authentication - Sign-up -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Logo-->
        <a href="#" class="d-block d-lg-none mx-auto py-20">
            <img alt="Logo" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
            <!--begin::Wrapper-->
            <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                <!--begin::Header-->
                <div class="d-flex flex-stack py-2">
                    <!--begin::Back link-->
                    <div class="me-2">
                        <a href="{{ route('login') }}" class="btn btn-icon bg-light rounded-circle">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr002.svg-->
                            <span class="svg-icon svg-icon-2 svg-icon-gray-800">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.60001 11H21C21.6 11 22 11.4 22 12C22 12.6 21.6 13 21 13H9.60001V11Z" fill="currentColor" />
                                    <path opacity="0.3" d="M9.6 20V4L2.3 11.3C1.9 11.7 1.9 12.3 2.3 12.7L9.6 20Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </a>
                    </div>
                    <!--end::Back link-->

                    <!--begin::Sign Up link-->
                    <div class="m-0">
                        <span class="text-gray-400 fw-bold fs-5 me-2" data-kt-translate="sign-up-head-desc">Already a member ?</span>
                        <a href="{{ route('login') }}" class="link-primary fw-bold fs-5" data-kt-translate="sign-up-head-link">Log In</a>
                    </div>
                    <!--end::Sign Up link=-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="py-20">
                    <!--begin::Form-->
                    <form class="form w-100" method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="text-start mb-10">
                            <!--begin::Title-->
                            <h1 class="text-dark mb-3 fs-3x" data-kt-translate="sign-up-title">Create an Account</h1>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="text-gray-400 fw-semibold fs-6" data-kt-translate="general-desc">Get unlimited access & earn money</div>
                            <!--end::Link-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror" type="text" placeholder="Full Name" name="name" autocomplete="off" value="{{ old('name') }}" required/>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid @error('username') is-invalid @enderror" type="text" placeholder="Username" name="username" autocomplete="off" value="{{ old('username') }}"  required/>
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="email" placeholder="Email" name="email" autocomplete="off" value="{{ old('email') }}" required/>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="password" placeholder="Password" name="password" autocomplete="off" required/>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <!--end::Input group=-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="Confirm Password" name="password_confirmation" autocomplete="off" required/>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex flex-stack">
                            <!--begin::Submit-->
                            <button type="submit" class="btn btn-primary">
                                <!--begin::Indicator label-->
                                <span class="indicator-label">Submit</span>
                                <!--end::Indicator label-->
                            </button>
                            <!--end::Submit-->
                            <!--begin::Social-->
                            <div class="d-flex align-items-center">
                                <div class="text-gray-400 fw-semibold fs-6 me-6">Or</div>
                                <!--begin::Symbol-->
                                <a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="p-4" />
                                </a>
                                <!--end::Symbol-->
                                <!--begin::Symbol-->
                                <a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/facebook-3.svg" class="p-4" />
                                </a>
                                <!--end::Symbol-->
                                <!--begin::Symbol-->
                                <a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light">
                                    <img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show p-4" />
                                </a>
                                <!--end::Symbol-->
                            </div>
                            <!--end::Social-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Aside-->
        <!--begin::Body-->
        <div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url(assets/media/auth/bg11.png)"></div>
        <!--begin::Body-->
    </div>
<!--end::Authentication - Sign-up-->
@endsection

@section('pagespecificscripts')
    <script src="{{ asset('assets/js/custom/authentication/sign-up/general.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/i18n.js') }}"></script>
@endsection
