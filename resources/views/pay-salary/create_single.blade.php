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
                {{-- Alert: Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pay Single Employee</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pay-salary.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                {{-- Employee Selection --}}
                                <div class="form-group col-md-12">
                                    <label for="employee_id">Employee <span class="text-danger">*</span></label>
                                    <select class="form-control @error('employee_id') is-invalid @enderror" name="employee_id" required>
                                        <option value="" disabled selected>Select Employee</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                                {{ $employee->name }} (Salary: {{ number_format($employee->salary) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Month Selection --}}
                                <div class="form-group col-md-6">
                                    <label for="month">Salary Month <span class="text-danger">*</span></label>
                                    <select class="form-control @error('month') is-invalid @enderror" name="month" required>
                                        <option value="" disabled selected>Select Month</option>
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ sprintf('%02d', $m) }}" {{ old('month') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Year Selection --}}
                                <div class="form-group col-md-6">
                                    <label for="year">Salary Year <span class="text-danger">*</span></label>
                                    <select class="form-control @error('year') is-invalid @enderror" name="year" required>
                                        <option value="{{ date('Y') }}" {{ old('year') == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                                        <option value="{{ date('Y') - 1 }}" {{ old('year') == date('Y') - 1 ? 'selected' : '' }}>{{ date('Y') - 1 }}</option>
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Date Selection --}}
                                <div class="form-group col-md-6">
                                    <label for="datepicker">Payment Date <span class="text-danger">*</span></label>
                                    <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', date('Y-m-d')) }}" />
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">Pay Salary</button>
                                <a class="btn btn-secondary" href="{{ route('pay-salary.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script: Datepicker -->
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
