@extends('dashboard.body.main')

@section('container')
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    {{-- Alert: Session Status --}}
                    @if (session()->has('success'))
                        <div class="alert text-white bg-success" role="alert">
                            <div class="iq-alert-text">{{ session('success') }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="ri-close-line"></i>
                            </button>
                        </div>
                    @endif
    {{-- Header: Title and Actions --}}
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-3">Pay Salary</h4>
        </div>
        <div>
            <a href="{{ route('pay-salary.create') }}" class="btn btn-info add-list mr-1">
                <i class="fas fa-plus mr-1"></i> Pay Custom
            </a>
            <a href="{{ route('pay-salary.payAllView') }}" class="btn btn-success add-list mr-1">
                <i class="fas fa-money-bill-wave mr-1"></i> Pay All
            </a>
            <a href="{{ route('pay-salary.payHistory') }}" class="btn btn-warning add-list">
                Pay History
            </a>
        </div>
    </div>
    </div>

    {{-- Main Table --}}
    <div class="col-lg-12">
        <div class="table-responsive rounded mb-3">
            <table class="table mb-0">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>No.</th>
                        <th><x-sort-link name="employee.name" label="Name" /></th>
                        <th><x-sort-link name="date" label="Date" /></th>
                        <th><x-sort-link name="employee.salary" label="Salary" /></th>
                        <th><x-sort-link name="advance_salary" label="Advance" /></th>
                        <th>Due</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    @forelse ($advanceSalaries as $advance)
                        <tr>
                            <td>{{ (($advanceSalaries->currentPage() * 10) - 10) + $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if ($advance->employee->photo)
                                        <img src="{{ asset('storage/employees/' . $advance->employee->photo) }}"
                                            class="rounded-circle avatar-40 mr-2" alt="profile">
                                    @else
                                        <img src="{{ asset('assets/images/user/1.png') }}" class="rounded-circle avatar-40 mr-2"
                                            alt="profile">
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $advance->employee->name }}</h6>
                                        <small class="text-muted">{{ $advance->employee->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($advance->date)->format('M d, Y') }}</td>
                            <td>{{ number_format($advance->employee->salary, 2) }}</td>
                            <td>
                                <span class="badge badge-warning">{{ number_format($advance->advance_salary, 2) }}</span>
                            </td>
                            <td>
                                <span class="text-success font-weight-bold">
                                    {{ number_format($advance->employee->salary - $advance->advance_salary, 2) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center list-action">
                                    <a class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Pay Salary" href="{{ route('pay-salary.paySalary', $advance->id) }}">
                                        Pay Now
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No pending advance salaries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $advanceSalaries->links() }}
    </div>
    </div>
        </div>
@endsection
