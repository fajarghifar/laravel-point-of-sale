<div class="col-lg-4 card-profile mb-5 h-50">
    <div class="card card-block card-stretch card-height mb-5">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <div class="profile-img position-relative">
                    <img src="{{ $user->photo ? asset('storage/profile/'.$user->photo) : asset('assets/images/user/1.png') }}" class="img-fluid rounded avatar-110" alt="profile-image">
                </div>
                <div class="ml-3">
                    <h4 class="mb-1">{{  auth()->user()->name }}</h4>
                    <p class="mb-2">UI/UX Designer</p>
                    <a href="#" class="btn btn-primary font-size-14">Edit Profile</a>
                </div>
            </div>
            <ul class="list-inline p-0 m-0">
                <li>
                    <div class="d-flex align-items-center">
                        <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="mb-0">{{ $user->email }}</p>
                    </div>
                </li>
                <li class="mb-2">
                    <div class="d-flex align-items-center">
                        <svg class="svg-icon mr-3" height="16" width="16" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="mb-0">{{ $user->address ? $user->address : 'Unknown' }}</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
