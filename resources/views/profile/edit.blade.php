@extends('dashboard.body.main')

@section('container')
    @if (session('status') === 'password-updated')
    <!--begin::Alert-->
    <div class="alert alert-dismissible bg-success d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->
            <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
            <span class="svg-icon svg-icon-2hx svg-icon-light me-4 mb-5 mb-sm-0">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path></svg>
            </span>
            <!--end::Svg Icon-->
        <!--end::Icon-->

        <!--begin::Content-->
        <div class="d-flex flex-column text-light pe-0 pe-sm-10">
            <h4 class="mb-2 text-light">Success!</h4>
            <span>Password has been updated.</span>
        </div>
        <!--end::Content-->

        <!--begin::Close-->
        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-2x svg-icon-light">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                </svg>
            </span>
            <!--end::Svg Icon-->
        </button>
    <!--end::Close-->
    </div>
    <!--end::Alert-->
    @endif

    <!--begin::Navbar-->
    @include('profile.partials.navbar-profile-information')
    <!--end::Navbar-->

    <!--begin::details View-->
    @include('profile.partials.update-profile-information-form')
    <!--end::details View-->

    <!--begin::Signin Method -->
    @include('profile.partials.update-password-form')
    <!--end::Signin Method -->

    <!--begin::Deactivate Account-->
    @include('profile.partials.delete-user-form')
    <!--end::Deactivate Account-->
@endsection

@section('pagespecificscripts')
    <script src="{{ asset('assets/js/custom/account/settings/signin-methods.js') }}"></script>
    <script src="{{ asset('assets/js/custom/account/settings/profile-details.js') }}"></script>
    <script src="{{ asset('assets/js/custom/account/settings/deactivate-account.js') }}"></script>
@endsection
