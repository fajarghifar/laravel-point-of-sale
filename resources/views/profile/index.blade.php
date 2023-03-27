@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    @include('profile.partials.background-profile')

    <div class="row px-3">
        @include('profile.partials.left-profile')

        <div class="col-lg-8 card-profile">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <ul class="d-flex nav nav-pills mb-3 text-center profile-tab">
                        <li class="nav-item">
                            <a href="{{ route('profile') }}" class="nav-link active">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link">Edit Profile</a>
                        </li>
                    </ul>

                    <!-- begin: Profile -->
                    <div class="card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Profile</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <img class="crm-profile-pic rounded-circle avatar-100" src="{{ $user->photo ? asset('storage/images/' . $user->photo) : asset('assets/images/user/1.png') }}" alt="profile-pic">
                            </div>
                        </div>
                        <div class=" row align-items-center">
                            <div class="form-group col-md-12">
                                <label for="fname">Full Name:</label>
                                <input type="text" class="form-control" id="fname" value="{{ $user->name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="uname">Username:</label>
                                <input type="text" class="form-control" id="uname" value="{{ $user->username }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- end: Profile -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
