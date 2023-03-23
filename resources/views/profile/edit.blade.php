@extends('dashboard.body.main')

@section('container')
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
