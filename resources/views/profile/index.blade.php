@extends('dashboard.body.main')

@section('container')
    <!--begin::Navbar-->
    @include('profile.partials.navbar-profile-information')
    <!--end::Navbar-->

    <!--begin::details View-->
    @include('profile.partials.show-profile-information-form')
    <!--end::details View-->
@endsection
