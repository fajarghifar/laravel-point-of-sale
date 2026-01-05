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
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pay Salary</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('pay-salary.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $advanceSalary->id }}">

                            <div class="row align-items-center">
                                {{-- Section: Employee Information --}}
                                <div class="form-group col-md-6">
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control" value="{{ $advanceSalary->employee->name }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Month</label>
                                    <input type="text" class="form-control" value="{{ $advanceSalary->date }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Salary</label>
                                    <input type="text" class="form-control" value="{{ $advanceSalary->employee->salary }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Advance Salary</label>
                                    <input type="text" class="form-control" value="{{ $advanceSalary->advance_salary }}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Due Salary</label>
                                    <input type="text" class="form-control"
                                        value="{{ $advanceSalary->employee->salary - $advanceSalary->advance_salary }}" readonly>
                                </div>

                                {{-- Section: Salary Month Selection --}}
                                <div class="form-group col-md-4">
                                    <label for="month">Salary Month <span class="text-danger">*</span></label>
                                    <select class="form-control @error('month') is-invalid @enderror" name="month" required>
                                        <option value="" disabled selected>Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="year">Salary Year <span class="text-danger">*</span></label>
                                    <select class="form-control @error('year') is-invalid @enderror" name="year" required>
                                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                        <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                    </select>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Section: Payment Date --}}
                                <div class="form-group col-md-4">
                                    <label for="datepicker">Payment Date <span class="text-danger">*</span></label>
                                    <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date"
                                        value="{{ old('date', date('Y-m-d')) }}" />
                                    @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Section: Form Actions --}}
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

    {{-- Script: Datepicker Initialization --}}
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });
    </script>
@endsection
