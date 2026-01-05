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
                        <h4 class="mb-3">Pay Salary History</h4>
                    </div>
                    <div>
                        <a href="{{ route('pay-salary.index') }}" class="btn btn-primary add-list">
                            Pay Salary
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
                                <th><x-sort-link name="paid_amount" label="Paid Amount" /></th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($paySalaries as $history)
                                <tr>
                                    <td>{{ (($paySalaries->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                    <td>{{ $history->employee->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($history->date)->format('Y-m-d') }}</td>
                                    <td>{{ number_format($history->paid_amount, 2) }}</td>
                                    <td><span class="badge badge-success">Full Paid</span></td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center list-action">
                                            <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="Details"
                                                href="{{ route('pay-salary.payHistoryDetail', $history->id) }}">
                                                <x-heroicon-o-eye class="w-5 h-5 mr-0" />
                                            </a>
                                            <form action="{{ route('pay-salary.destroy', $history->id) }}" method="POST"
                                                style="display:inline;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-warning border-0"
                                                    onclick="return confirm('Are you sure you want to delete this record?')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <x-heroicon-o-trash class="w-5 h-5 mr-0" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $paySalaries->links() }}
            </div>
        </div>
    </div>
@endsection
