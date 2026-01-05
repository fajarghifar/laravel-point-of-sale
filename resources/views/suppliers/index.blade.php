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

            {{-- Section: Header and Add Button --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Supplier List</h4>
                    <p class="mb-0">A supplier dashboard lets you easily gather and visualize supplier data from optimizing <br>
                        the supplier experience, ensuring supplier retention. </p>
                </div>
                <div>
                    <a href="{{ route('suppliers.create') }}" class="btn btn-primary add-list">
                        <x-heroicon-o-plus class="w-5 h-5 mr-3" />Add Supplier
                    </a>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-danger add-list">
                        <x-heroicon-o-x-mark class="w-5 h-5 mr-3" />Clear Search
                    </a>
                </div>
            </div>
        </div>

        {{-- Section: Filters and Search --}}
        <div class="col-lg-12">
            <form action="{{ route('suppliers.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row" onchange="this.form.submit()">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" class="form-control" name="search" placeholder="Search supplier" value="{{ request('search') }}">
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

        {{-- Section: Supplier Table --}}
        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th><x-sort-link name="name" label="Name" /></th>
                            <th><x-sort-link name="email" label="Email" /></th>
                            <th><x-sort-link name="phone" label="Phone" /></th>
                            <th><x-sort-link name="city" label="City" /></th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{ (($suppliers->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->phone }}</td>
                            <td>{{ $supplier->city }}</td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center list-action">
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="View" href="{{ route('suppliers.show', $supplier->id) }}">
                                        <x-heroicon-o-eye class="w-5 h-5 mr-0" />
                                    </a>
                                    <a class="btn btn-success mr-2" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route('suppliers.edit', $supplier->id) }}">
                                        <x-heroicon-o-pencil class="w-5 h-5 mr-0" />
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-warning border-0" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="Delete">
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
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection
