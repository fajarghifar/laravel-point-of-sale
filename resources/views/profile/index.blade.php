@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        @include('profile.partials.background-profile')

        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="row">
                    @include('profile.partials.left-profile')

                    <div class="col-lg-8 card-profile">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <!-- begin: Navbar Profile -->
                                @include('profile.partials.navbar-profile')
                                <!-- end: Navbar Profile -->

                                <!-- begin: Profile -->
                                @include('profile.partials.show-profile')
                                <!-- end: Profile -->
                                </div>
                                </div>
                                </div>
                                </div>
                                </div>
        </div>
        </div>
@endsection
