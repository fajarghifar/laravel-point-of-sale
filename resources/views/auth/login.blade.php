@extends('auth.body.main')

@section('container')
	<!--begin::Authentication - Sign-in -->
	<div class="d-flex flex-column flex-lg-row flex-column-fluid">
		<!--begin::Logo-->
		<a href="../../demo38/dist/index.html" class="d-block d-lg-none mx-auto py-20">
			<img alt="Logo" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
			<img alt="Logo" src="assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
		</a>
		<!--end::Logo-->
		<!--begin::Aside-->
		<div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
			<!--begin::Wrapper-->
			<div class="d-flex justify-content-center flex-column-fluid flex-column w-100 mw-450px">
				<!--begin::Body-->
				<div class="py-20">
					<!--begin::Form-->
					<form class="form w-100" method="POST" action="{{ route('login') }}">
                        @csrf
						<!--begin::Body-->
						<div class="card-body">
							<!--begin::Heading-->
							<div class="text-start mb-10">
								<!--begin::Title-->
								<h1 class="text-dark mb-3 fs-3x">Log In</h1>
								<!--end::Title-->
								<!--begin::Text-->
								<div class="text-gray-400 fw-semibold fs-6">Get unlimited access & earn money</div>
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group=-->
							<div class="fv-row mb-8">
								<!--begin::Email-->
								<input type="text" placeholder="Username or Email" name="login" autocomplete="off" class="form-control form-control-solid @error('login') is-invalid @enderror" value="{{ old('login') }}" required/>
                                @error('login')
                                <div class="invalid-feedback">
                                    {{ 'Incorrect username or password.' }}
                                </div>
                                @enderror
								<!--end::Email-->
							</div>
							<!--end::Input group=-->
							<div class="fv-row mb-7">
								<!--begin::Password-->
								<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control form-control-solid" required/>
								<!--end::Password-->
							</div>
							<!--end::Input group=-->
							<!--begin::Wrapper-->
							<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-10">

								<div>
                                    <span class="text-gray-400 me-2" data-kt-translate="sign-in-head-desc">Not a Member yet?</span>
                                    <a href="{{ route('register') }}" class="link-primary" data-kt-translate="sign-in-head-link">Register</a>
                                </div>

								<!--begin::Link-->
								<a href="#" class="link-primary">Forgot Password ?</a>
								<!--end::Link-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Actions-->
							<div class="d-flex flex-stack">
								<!--begin::Submit-->
                                <button type="submit" class="btn btn-primary me-2 flex-shrink-0">
									<!--begin::Indicator label-->
									<span class="indicator-label">Log In</span>
									<!--end::Indicator label-->
                                </button>
								<!--end::Submit-->
								<!--begin::Social-->
								<div class="d-flex align-items-center">
									<div class="text-gray-400 fw-semibold fs-6 me-3 me-md-6" data-kt-translate="general-or">Or</div>
									<!--begin::Symbol-->
									<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
										<img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="p-4" />
									</a>
									<!--end::Symbol-->
									<!--begin::Symbol-->
									<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light me-3">
										<img alt="Logo" src="assets/media/svg/brand-logos/facebook-3.svg" class="p-4" />
									</a>
									<!--end::Symbol-->
									<!--begin::Symbol-->
									<a href="#" class="symbol symbol-circle symbol-45px w-45px bg-light">
										<img alt="Logo" src="assets/media/svg/brand-logos/apple-black.svg" class="theme-light-show p-4" />
									</a>
									<!--end::Symbol-->
								</div>
								<!--end::Social-->
							</div>
							<!--end::Actions-->
						</div>
						<!--begin::Body-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Aside-->
		<!--begin::Body-->
		<div class="d-none d-lg-flex flex-lg-row-fluid w-50 bgi-size-cover bgi-position-y-center bgi-position-x-start bgi-no-repeat" style="background-image: url(assets/media/auth/bg11.png)"></div>
		<!--begin::Body-->
	</div>
	<!--end::Authentication - Sign-in-->
@endsection
