@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@endsection

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Role in Permission</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('rolePermission.update', $role->id) }}" method="POST">
                    @csrf
                    @method('put')
                        <!-- begin: Input Data -->
                        <div class=" row align-items-center mb-2">
                            <div class="form-group col-md-6">
                                <label for="role_id">Role Name</label>
                                <h4>{{ $role->name }}</h4>
                                {{-- <input type="text" class="form-control" value="{{ $role->name }}" readonly> --}}
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label for="name">Permission Name <span class="text-danger">*</span></label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" class="custom-control-input" id="check-all">
                                    <label class="custom-control-label" for="check-all">Check All</label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        @foreach ($permission_groups as $permission_group)
                        @php
                            $permissions = App\Models\User::getPermissionByGroupName($permission_group->group_name);
                        @endphp

                        <div class="row">
                            <div class="form-group col-md-3">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="permission_group_id[{{ $loop->iteration }}]"
                                        name="permission_group_id[]"
                                        {{ App\Models\User::roleHasPermission($role, $permissions) ? 'checked' : '' }}
                                    >
                                    <label
                                        for="permission_group_id[{{ $loop->iteration }}]"
                                        class="custom-control-label"
                                    >
                                        {{ $permission_group->group_name }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox custom-control-inline my-2">
                                        <input
                                            type="checkbox"
                                            class="custom-control-input"
                                            id="permission_id[{{ $permission->id }}]"
                                            name="permission_id[]"
                                            value="{{ $permission->id }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        >
                                        <label
                                            for="permission_id[{{ $permission->id }}]"
                                            class="custom-control-label"
                                        >
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        @endforeach

                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                            <a class="btn bg-danger" href="{{ route('rolePermission.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>
    $('#check-all').click(function() {
        if($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked', true);
        } else {
            $('input[type = checkbox]').prop('checked', false);
        }
    });
</script>


@endsection
