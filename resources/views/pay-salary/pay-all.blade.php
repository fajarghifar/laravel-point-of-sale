@extends('dashboard.body.main')

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
                            <h4 class="card-title">Pay All Salaries (Bulk Payment)</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        {{-- Information Alert --}}
                        <div class="alert alert-warning">
                            <i class="ri-alert-line mr-2"></i>
                            <strong>Heads up!</strong> This will check all employees. If they haven't been paid for the selected month, a payment record will be created. Any approved Advance Salaries for that month will be automatically deducted.
                        </div>

                        <form action="{{ route('pay-salary.payAllStore') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                {{-- Month Selection --}}
                                <div class="form-group col-md-6">
                                    <label for="month">Salary Month <span class="text-danger">*</span></label>
                                    <select class="form-control" name="month" required>
                                        <option value="" disabled selected>Select Month</option>
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ sprintf('%02d', $m) }}" {{ old('month') == sprintf('%02d', $m) ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Year Selection --}}
                                <div class="form-group col-md-6">
                                    <label for="year">Salary Year <span class="text-danger">*</span></label>
                                    <select class="form-control" name="year" required>
                                        <option value="{{ date('Y') }}" {{ old('year') == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                                        <option value="{{ date('Y') - 1 }}" {{ old('year') == date('Y') - 1 ? 'selected' : '' }}>{{ date('Y') - 1 }}</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2" onclick="return confirm('Are you sure you want to process payroll for ALL employees for this month?')">
                                    <i class="ri-money-dollar-circle-line mr-1"></i> Process All Payments
                                </button>
                                <a class="btn btn-secondary" href="{{ route('pay-salary.index') }}">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
