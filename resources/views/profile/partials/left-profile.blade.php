<div class="col-lg-4 mb-5 h-50">
    <div class="card card-block card-stretch card-height mb-5">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div class="profile-img position-relative">
                    <img src="{{ $user->photo ? asset('storage/profile/'.$user->photo) : asset('assets/images/user/1.png') }}" class="img-fluid rounded avatar-110" alt="profile-image">
                </div>
                <div class="ml-3">
                    <h4 class="mb-1">{{  auth()->user()->name }}</h4>
                    <p class="mb-2">UI/UX Designer</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary font-size-14">Edit Profile</a>
                </div>
            </div>
            <ul class="list-inline p-0 m-0">
                <li>
                    <div class="d-flex align-items-center">
                        <x-heroicon-o-envelope class="w-4 h-4 mr-3" />
                        <p class="mb-0">{{ $user->email }}</p>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="d-flex align-items-center">
                        <x-heroicon-o-map-pin class="w-4 h-4 mr-3" />
                        <p class="mb-0">{{ $user->address ? $user->address : 'Unknown' }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
