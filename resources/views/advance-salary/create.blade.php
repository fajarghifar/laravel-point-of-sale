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
                <!-- Session Status Alerts -->
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
                            <h4 class="card-title">Create Advance Salary</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('advance-salary.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <!-- Employee Selection -->
                                <div class="form-group col-md-12">
                                    <label for="employee_id">Employee Name <span class="text-danger">*</span></label>
                                    <select class="form-control mb-3" id="employee_id" name="employee_id" required>
                                        <option selected="" disabled>-- Select Employee --</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Date Selection -->
                                <div class="form-group col-md-6">
                                    <label for="datepicker">Date <span class="text-danger">*</span></label>
                                    <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date"
                                        value="{{ old('date') }}" />
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Salary Amount -->
                                <div class="form-group col-md-6">
                                    <label for="advance_salary">Advance Salary <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control @error('advance_salary') is-invalid @enderror"
                                        id="advance_salary" name="advance_salary" value="{{ old('advance_salary') }}" placeholder="0.00" required>
                                    @error('advance_salary')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <a class="btn bg-danger" href="{{ route('advance-salary.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script: Datepicker Initialization -->
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
