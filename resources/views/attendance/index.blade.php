@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Session Status Alerts -->
                @if (session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>
                @endif

                <!-- Header: Title and Actions -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Attendance List</h4>
                    </div>
                    <div>
                        <a href="{{ route('attendance.create') }}" class="btn btn-primary add-list d-flex align-items-center">
                            <x-heroicon-o-plus class="w-5 h-5 mr-2" />
                            Create Attendance
                        </a>
                    </div>
                </div>
                </div>

            <!-- Main Table -->
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th><x-sort-link name="date" label="Date" /></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @forelse ($attendances as $attendance)
                                <tr>
                                    <td>{{ (($attendances->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                    <td>
                                        <span
                                            class="badge badge-primary">{{ \Carbon\Carbon::parse($attendance->date)->format('l, d F Y') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center list-action">
                                            <a class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Edit"
                                                href="{{ route('attendance.edit', $attendance->date) }}">
                                                <x-heroicon-o-pencil class="w-4 h-4 mr-0" />
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No attendance records found. Click "Create" to add
                                        new.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $attendances->links() }}
            </div>
            </div>
            </div>
@endsection
