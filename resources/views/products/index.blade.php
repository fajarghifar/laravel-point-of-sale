@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @if (session()->has('success'))
                <div class="alert text-white bg-success" role="alert">
                    <div class="iq-alert-text">{{ session('success') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <x-heroicon-o-x-mark class="w-6 h-6"/>
                    </button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert text-white bg-danger" role="alert">
                    <div class="iq-alert-text">{{ session('error') }}</div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <x-heroicon-o-x-mark class="w-6 h-6"/>
                    </button>
                </div>
            @endif

            <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Product List</h4>
                    <p class="mb-0">A product dashboard lets you easily gather and visualize product data from optimizing <br>
                        the product experience, ensuring product retention. </p>
                </div>
                <!-- begin: Action Buttons -->
                <div class="d-flex align-items-center">
                    <a href="{{ route('products.importView') }}" class="btn btn-success add-list mr-2 d-flex align-items-center">
                        <x-heroicon-o-arrow-up-tray class="w-5 h-5 mr-1" /> Import
                    </a>
                    <a href="{{ route('products.exportData') }}" class="btn btn-warning add-list mr-2 d-flex align-items-center">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5 mr-1" /> Export
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-primary add-list d-flex align-items-center">
                        <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Add Product
                    </a>
                </div>
                <!-- end: Action Buttons -->
            </div>
        </div>

        <div class="col-lg-12">
            <form action="{{ route('products.index') }}" method="get">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="form-group row">
                        <label for="row" class="col-sm-3 align-self-center">Row:</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="row">
                                <option value="10" @if(request('row') == '10')selected="selected"@endif>10</option>
                                <option value="25" @if(request('row') == '25')selected="selected"@endif>25</option>
                                <option value="50" @if(request('row') == '50')selected="selected"@endif>50</option>
                                <option value="100" @if(request('row') == '100')selected="selected"@endif>100</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 align-self-center" for="search">Search:</label>
                        <div class="input-group col-sm-8">
                            <input type="text" id="search" class="form-control" name="search" placeholder="Search product" value="{{ request('search') }}">
                            <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary">
                                    <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                                </button>
                                <a href="{{ route('products.index') }}" class="input-group-text bg-danger">
                                    <x-heroicon-o-x-mark class="w-5 h-5" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-12">
            <div class="table-responsive rounded mb-3">
                <table class="table mb-0">
                    <thead class="bg-white text-uppercase">
                        <tr class="ligth ligth-data">
                            <th>No.</th>
                            <th>Photo</th>
                            <th><x-sort-link name="name" label="Name" /></th>
                            <th><x-sort-link name="category.name" label="Category" /></th>
                            <th><x-sort-link name="selling_price" label="Price" /></th>
                            <th><x-sort-link name="stock" label="Stock" /></th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="ligth-body">
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ (($products->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                            <td>
                                <img class="avatar-60 rounded" src="{{ $product->image ? asset('storage/products/'.$product->image) : asset('assets/images/product/default.webp') }}">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->selling_price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                @if ($product->expire_date > Carbon\Carbon::now()->format('Y-m-d'))
                                    <span class="badge rounded-pill bg-success">Valid</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Invalid</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center list-action">
                                    <a class="btn btn-info mr-2" data-toggle="tooltip" data-placement="top" title="View"
                                        href="{{ route('products.show', $product->id) }}">
                                        <x-heroicon-o-eye class="w-5 h-5 mr-0" />
                                    </a>
                                    <a class="btn btn-warning mr-2" data-toggle="tooltip" data-placement="top" title="Edit"
                                        href="{{ route('products.edit', $product->id) }}">
                                        <x-heroicon-o-pencil class="w-5 h-5 mr-0" />
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger border-0" onclick="return confirm('Are you sure you want to delete this record?')" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <x-heroicon-o-trash class="w-5 h-5 mr-0" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">
                                <span class="text-muted">No products found.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
