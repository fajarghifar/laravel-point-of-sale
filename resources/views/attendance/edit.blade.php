@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Employee Attendance</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('attendance.store') }}" method="POST">
                            @csrf
                            <div class="row align-items-center">
                                <!-- Section: Date Selection -->
                                <div class="form-group col-md-6">
                                    <label for="datepicker">Date <span class="text-danger">*</span></label>
                                    <input id="datepicker" class="form-control @error('date') is-invalid @enderror" name="date"
                                        value="{{ old('date', $date) }}" autocomplete="off" />
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>

                                <!-- Section: Employee Attendance Table -->
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end mb-2">
                                        <button type="button" class="btn btn-sm btn-outline-success mr-2" id="btn-all-present">Mark All Present</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="btn-all-leave">Mark All Leave</button>
                                    </div>
                                    <div class="table-responsive rounded mb-3" style="max-height: 500px; overflow-y: auto;">
                                        <table class="table mb-0 table-striped">
                                            <thead class="bg-white text-uppercase sticky-top" style="z-index: 10;">
                                                <tr class="ligth ligth-data">
                                                    <th>No.</th>
                                                    <th>Employee</th>
                                                    <th class="text-center">Attendance Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ligth-body">
                                                @foreach ($attendances as $attendence)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $attendence->employee->name }}</td>
                                                        <td>
                                                            <input type="hidden" name="employee_id[{{ $loop->iteration }}]" value="{{ $attendence->employee_id }}">
                                                            <div class="input-group">
                                                                <div class="input-group justify-content-center">
                                                                    <!-- Status: Present -->
                                                                    <div class="input-group-text bg-transparent border-0">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="present{{ $loop->iteration }}" name="status{{ $loop->iteration }}"
                                                                                class="custom-control-input set-present" value="present"
                                                                                {{ $attendence->status == 'present' ? 'checked' : '' }}>
                                                                            <label class="custom-control-label text-success" for="present{{ $loop->iteration }}">Present</label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Status: Leave -->
                                                                    <div class="input-group-text bg-transparent border-0">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="leave{{ $loop->iteration }}" name="status{{ $loop->iteration }}"
                                                                                class="custom-control-input set-leave" value="leave" {{ $attendence->status == 'leave' ? 'checked' : '' }}>
                                                                            <label class="custom-control-label text-warning" for="leave{{ $loop->iteration }}">Leave</label>
                                                                            </div>
                                                                            </div>
                                                                    <!-- Status: Absent -->
                                                                    <div class="input-group-text bg-transparent border-0">
                                                                        <div class="custom-control custom-radio custom-control-inline">
                                                                            <input type="radio" id="absent{{ $loop->iteration }}" name="status{{ $loop->iteration }}"
                                                                                class="custom-control-input set-absent" value="absent" {{ $attendence->status == 'absent' ? 'checked' : '' }}>
                                                                            <label class="custom-control-label text-danger" for="absent{{ $loop->iteration }}">Absent</label>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                            </div>
                                                                            </td>
                                                                            </tr>
                                                @endforeach
                                                                            </tbody>
                                                                            </table>
                                                                            </div>
                                                                            </div>
                                                                            </div>

                            <!-- Section: Form Actions -->
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('attendance.index') }}" class="btn btn-danger">Cancel</a>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>

    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
        });

            $(document).ready(function () {
                $('#btn-all-present').click(function () {
                    $('.set-present').prop('checked', true);
                });

            $('#btn-all-leave').click(function () {
                $('.set-leave').prop('checked', true);
            });
        });
            </script>
@endsection
