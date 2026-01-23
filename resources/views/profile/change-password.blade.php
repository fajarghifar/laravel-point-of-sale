@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">


    <div class="row px-3">
        @include('profile.partials.left-profile')

        <div class="col-lg-8">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <!-- begin: Navbar Profile -->
                    @include('profile.partials.navbar-profile')
                    <!-- end: Navbar Profile -->

                    <!-- begin: Profile -->
                    @include('profile.partials.change-password-form')
                    <!-- end: Profile -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
