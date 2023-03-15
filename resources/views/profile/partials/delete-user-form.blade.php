<!--begin::Deactivate Account-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_deactivate" aria-expanded="true" aria-controls="kt_account_deactivate">
		<div class="card-title m-0">
			<h3 class="fw-bold m-0">Delete Account</h3>
		</div>
	</div>
	<!--end::Card header-->
	<!--begin::Content-->
	<div id="kt_account_settings_deactivate" class="collapse show">
		<!--begin::Form-->
		<form id="kt_account_deactivate_form" class="form">
			<!--begin::Card body-->
			<div class="card-body border-top p-9">
				<!--begin::Notice-->
				<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
					<!--begin::Icon-->
					<!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
					<span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
							<rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
							<rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
						</svg>
					</span>
					<!--end::Svg Icon-->
					<!--end::Icon-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-stack flex-grow-1">
						<!--begin::Content-->
						<div class="fw-semibold">
							<h4 class="text-gray-900 fw-bold">You Are Deleting Your Account</h4>
							<div class="fs-6 text-gray-700">
                                Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                            </div>
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Notice-->
			</div>
			<!--end::Card body-->
			<!--begin::Card footer-->
			<div class="card-footer d-flex justify-content-end py-6 px-9">
				<button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold">Delete Account</button>
			</div>
			<!--end::Card footer-->
		</form>
		<!--end::Form-->
	</div>
	<!--end::Content-->
</div>
<!--end::Deactivate Account-->
