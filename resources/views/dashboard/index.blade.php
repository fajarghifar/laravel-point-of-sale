@extends('dashboard.body.main')

@section('toolbar')
<!--begin::Toolbar-->
<div class="app-toolbar pt-7 pt-lg-10">
	<!--begin::Toolbar container-->
	<div class="app-container container-fluid d-flex align-items-stretch">
		<!--begin::Toolbar wrapper-->
		<div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
			<!--begin::Page title-->
			<div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
				<!--begin::Title-->
				<h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Point Of Sale</h1>
				<!--end::Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
					<!--begin::Item-->
					<li class="breadcrumb-item text-muted">
						<a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboards</a>
					</li>
					<!--end::Item-->
				</ul>
				<!--end::Breadcrumb-->
			</div>
			<!--end::Page title-->
		</div>
		<!--end::Toolbar wrapper-->
	</div>
	<!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
@endsection
