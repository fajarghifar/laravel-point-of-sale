@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Employee List</h4>
                    <p class="mb-0">A employee dashboard lets you easily gather and visualize employee data from optimizing <br>
                        the employee experience, ensuring employee retention. </p>
                </div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Employee</a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
            <table class="data-table table mb-0 tbl-server-info">
                <thead class="bg-white text-uppercase">
                    <tr class="ligth ligth-data">
                        <th>No.</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="ligth-body">
                    <?php $i = 1; ?>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>
                            <img class="avatar-60 rounded" src="{{ $employee->photo ? asset('storage/employees/'.$employee->photo) : asset('assets/images/user/1.png') }}">
                        </td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>${{ $employee->salary }}</td>
                        <td>
                            <div class="d-flex align-items-center list-action">
                                <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                                    href="{{ route('employees.show', $employee->id) }}"><i class="ri-eye-line mr-0"></i>
                                </a>
                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                                    href="{{ route('employees.edit', $employee->id) }}""><i class="ri-pencil-line mr-0"></i>
                                </a>
                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                    href="#"><i class="ri-delete-bin-line mr-0"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>
@endsection
