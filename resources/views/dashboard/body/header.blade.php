
<div id="kt_app_header" class="app-header">
	<!--begin::Header container-->
	<div class="app-container container-fluid d-flex align-items-stretch flex-stack" id="kt_app_header_container">
		<!--begin::Sidebar toggle-->
		<div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
			<div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
				<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
				<span class="svg-icon svg-icon-2">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
						<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
					</svg>
				</span>
				<!--end::Svg Icon-->
			</div>
			<!--begin::Logo image-->
			<a href="{{ route('dashboard') }}">
				<img alt="Logo" src="{{ asset('assets/media/logos/demo38-small.svg') }}" class="h-30px" />
			</a>
			<!--end::Logo image-->
		</div>
		<!--end::Sidebar toggle-->
		<!--begin::Navbar-->
		<div class="app-navbar flex-lg-grow-1" id="kt_app_header_navbar">
			<div class="app-navbar-item d-flex align-items-stretch flex-lg-grow-1">
			</div>
			<!--begin::User menu-->
			<div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
				<!--begin::Menu wrapper-->
				<div class="cursor-pointer symbol symbol-circle symbol-35px symbol-md-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
					<img src="{{ asset('assets/media/avatars/300-2.jpg') }}" alt="user" />
				</div>
				<!--begin::User account menu-->
				<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
					<!--begin::Menu item-->
					<div class="menu-item px-3">
						<div class="menu-content d-flex align-items-center px-3">
							<!--begin::Avatar-->
							<div class="symbol symbol-50px me-5">
								<img alt="Logo" src="{{ asset('assets/media/avatars/300-2.jpg') }}" />
							</div>
							<!--end::Avatar-->
							<!--begin::Username-->
							<div class="d-flex flex-column">
								<div class="fw-bold d-flex align-items-center fs-5">{{ auth()->user()->name }}
								<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
								<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
							</div>
							<!--end::Username-->
						</div>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu separator-->
					<div class="separator my-2"></div>
					<!--end::Menu separator-->
					<!--begin::Menu item-->
					<div class="menu-item px-5">
						<a href="{{ route('profile') }}" class="menu-link px-5">My Profile</a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu item-->
					<div class="menu-item px-5 my-1">
						<a href="{{ route('profile.edit') }}" class="menu-link px-5">Account Settings</a>
					</div>
					<!--end::Menu item-->
					<!--begin::Menu separator-->
					<div class="separator my-2"></div>
					<!--end::Menu separator-->
					<!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <form action="{{ route('logout') }}" method="POST" class="menu-link p-0">
                            @csrf
                            <button type="submit" class="menu-link px-5 py-2 btn border-0">Sign Out</button>
                        </form>
                    </div>
					<!--end::Menu item-->
				</div>
				<!--end::User account menu-->
				<!--end::Menu wrapper-->
			</div>
			<!--end::User menu-->
		</div>
		<!--end::Navbar-->
		<!--begin::Separator-->
		<div class="app-navbar-separator separator d-none d-lg-flex"></div>
		<!--end::Separator-->
	</div>
	<!--end::Header container-->
</div>
