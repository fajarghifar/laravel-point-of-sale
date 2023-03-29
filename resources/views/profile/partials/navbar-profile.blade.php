<ul class="d-flex nav nav-pills mb-3 text-center profile-tab">
    <li class="nav-item">
        <a href="{{ route('profile') }}" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('profile.edit') }}" class="nav-link {{ Request::is('profile/edit') ? 'active' : '' }}">Edit Profile</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('profile.change-password') }}" class="nav-link {{ Request::is('profile/change-password') ? 'active' : '' }}">Change Password</a>
    </li>
</ul>
