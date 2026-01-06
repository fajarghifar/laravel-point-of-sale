@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Session Status Alert -->
                @if (session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                        </button>
                    </div>
                @endif

                <!-- Header: Title and Actions -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Advance Salary List</h4>
                    </div>
                    <div>
                        <a href="{{ route('advance-salary.create') }}" class="btn btn-primary add-list">
                            <x-heroicon-o-plus class="w-5 h-5 mr-3" />Add Advance Salary
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filter and Search Controls -->
            <div class="col-lg-12">
                <form action="{{ route('advance-salary.index') }}" method="GET">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <input type="search" class="form-control" name="search" id="search" placeholder="Search..."
                                    value="{{ request()->query('search') }}">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Main Table -->
            <div class="col-lg-12 mt-4">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th><x-sort-link name="employee.name" label="Name" /></th>
                                <th><x-sort-link name="date" label="Date" /></th>
                                <th><x-sort-link name="advance_salary" label="Advance Salary" /></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @forelse ($advance_salaries as $advance)
                                <tr>
                                    <td>{{ (($advance_salaries->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($advance->employee->photo)
                                                <img src="{{ asset('storage/employees/' . $advance->employee->photo) }}"
                                                    class="rounded-circle avatar-40 mr-2" alt="profile">
                                            @else
                                                <img src="{{ asset('assets/images/user/1.png') }}" class="rounded-circle avatar-40 mr-2" alt="profile">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $advance->employee->name }}</h6>
                                                <small class="text-muted">{{ $advance->employee->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($advance->date)->format('d F Y') }}</td>
                                    <td>{{ number_format($advance->advance_salary, 2) }}</td>
                                    <td>
                                        @if ($advance->is_deducted)
                                            <span class="badge badge-success">Deducted</span>
                                        @else
                                            <span class="badge badge-warning">Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Edit"
                                                href="{{ route('advance-salary.edit', $advance->id) }}">
                                                <x-heroicon-o-pencil class="w-5 h-5" />
                                            </a>
                                            <form action="{{ route('advance-salary.destroy', $advance->id) }}" method="POST" style="display:inline;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-warning border-none"
                                                    onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip"
                                                    data-placement="top" title="Delete">
                                                    <x-heroicon-o-trash class="w-5 h-5" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No advance salary records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                        </div>
                        {{ $advance_salaries->links() }}
                        </div>
                        </div>
    </div>
@endsection
