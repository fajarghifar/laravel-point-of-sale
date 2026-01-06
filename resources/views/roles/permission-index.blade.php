@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @if (session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <x-heroicon-o-x-mark class="w-5 h-5" />
                        </button>
                        </div>
                @endif
                        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                            <div>
                                <h4 class="mb-3">Permission List</h4>
                            </div>
                            <div>
                                <a href="{{ route('permission.create') }}" class="btn btn-primary add-list"><x-heroicon-o-plus
                                        class="w-5 h-5 mr-3" />Create Permission</a>
                            </div>
                        </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive rounded mb-3">
                                        <table class="table mb-0">
                                            <thead class="bg-white text-uppercase">
                                                <tr class="ligth ligth-data">
                                                    <th>No.</th>
                                                    <th>Permission Name</th>
                                                    <th>Group Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ligth-body">
                                                @forelse ($permissions as $permission)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $permission->name }}</td>
                                                        <td><span class="badge bg-primary">{{ $permission->group_name }}</span></td>
                                                        <td>
                                                            <div class="d-flex align-items-center list-action">
                                                                <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top"
                                                                    title="Edit" href="{{ route('permission.edit', $permission->id) }}">
                                                                    <x-heroicon-o-pencil class="w-5 h-5 mr-0" />
                                                                </a>
                                                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST"
                                                                    style="display:inline;">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-warning border-0"
                                                                        onclick="return confirm('Are you sure you want to delete this permission?')"
                                                                        data-toggle="tooltip" data-placement="top" title="Delete">
                                                                        <x-heroicon-o-trash class="w-5 h-5 mr-0" />
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">
                                                            <div class="alert text-white bg-danger" role="alert">
                                                                <div class="iq-alert-text">Data not Found.</div>
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <x-heroicon-o-x-mark class="w-5 h-5" />
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($permissions->hasPages())
                                        {{ $permissions->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
@endsection
