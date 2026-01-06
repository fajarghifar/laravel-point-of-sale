@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Section: Session Alerts -->
                @if (session()->has('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="iq-alert-text">{{ session('success') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert text-white bg-danger" role="alert">
                        <div class="iq-alert-text">{{ session('error') }}</div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <x-heroicon-o-x-mark class="w-6 h-6" />
                        </button>
                    </div>
                @endif

                <!-- Section: Header -->
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Category List</h4>
                        <p class="mb-0">
                            Manage your product categories effectively to improve organization <br>
                            and customer navigation.
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary add-list d-flex align-items-center mr-3">
                            <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Create Category
                        </a>
                        <a href="{{ route('categories.index') }}" class="btn btn-danger add-list d-flex align-items-center">
                            <x-heroicon-o-trash class="w-5 h-5 mr-1" /> Clear Search
                        </a>
                    </div>
                </div>
            </div>

            <!-- Section: Filters -->
            <div class="col-lg-12">
                <form action="{{ route('categories.index') }}" method="get">
                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                        <!-- Row Per Page Checkbox -->
                        <div class="form-group row">
                            <label for="row" class="col-sm-3 align-self-center">Row:</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="row">
                                    <option value="10" @if (request('row') == '10') selected="selected" @endif>10</option>
                                    <option value="25" @if (request('row') == '25') selected="selected" @endif>25</option>
                                    <option value="50" @if (request('row') == '50') selected="selected" @endif>50</option>
                                    <option value="100" @if (request('row') == '100') selected="selected" @endif>100</option>
                                </select>
                            </div>
                        </div>

                        <!-- Search Box -->
                        <div class="form-group row">
                            <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input type="text" id="search" class="form-control" name="search"
                                        placeholder="Search category" value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-primary">
                                            <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Section: Table -->
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="table mb-0">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>No.</th>
                                <th><x-sort-link name="name" label="Name" /></th>
                                <th><x-sort-link name="slug" label="Slug" /></th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ (($categories->currentPage() * 10) - 10) + $loop->iteration }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ Str::limit($category->description, 50) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <!-- Edit Button -->
                                            <a class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Edit"
                                                href="{{ route('categories.edit', $category->slug) }}">
                                                <x-heroicon-o-pencil class="w-5 h-5 mr-0" />
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('categories.destroy', $category->slug) }}" method="POST"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger border-none"
                                                    onclick="return confirm('Are you sure you want to delete this record?')"
                                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <x-heroicon-o-trash class="w-5 h-5 mr-0" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="text-muted">No categories found. Click "Create Category" to add one.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
