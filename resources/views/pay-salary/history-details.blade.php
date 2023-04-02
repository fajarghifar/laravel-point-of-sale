@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif
            @if (session()->has('warning'))
                <div class="alert text-white bg-warning" role="alert">
                    <div class="iq-alert-text">{{ session('warning') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ri-close-line"></i>
                    </button>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">History Pay Salary</h4>
                    </div>
                </div>

                <div class="card-body">
                    <!-- begin: Input Data -->
                    <div class=" row align-items-center">
                        <div class="form-group col-md-6">
                            <label>Employee Name</label>
                            <input class="form-control bg-white" value="{{ $paySalary->employee->name }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input class="form-control bg-white" value="{{ $paySalary->date }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Salary</label>
                            <input class="form-control bg-white" value="{{ $paySalary->paid_amount }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Advance Salary</label>
                            <input class="form-control bg-white" value="{{ $paySalary->advance_salary ? $paySalary->advance_salary : 'No Advance' }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Due Salary</label>
                            <input class="form-control bg-white" value="{{ $paySalary->due_salary }}" readonly>
                        </div>
                    </div>
                    <!-- end: Input Data -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
