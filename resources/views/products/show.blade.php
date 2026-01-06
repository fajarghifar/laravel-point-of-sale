@extends('dashboard.body.main')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Barcode</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="form-group col-md-6">
                                <label>Product Code</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->code }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Product Barcode</label>
                                {!! $barcode !!}
                            </div>
                        </div>
                        <!-- end: Show Data -->
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Product Information</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- begin: Show Data -->
                        <div class="form-group row align-items-center">
                            <div class="col-md-12">
                                <div class="profile-img-edit">
                                    <div class="crm-profile-img-edit">
                                        <img class="crm-profile-pic rounded-circle avatar-100"
                                            src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('assets/images/product/default.webp') }}"
                                            alt="profile-pic">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <label>Product Name</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->name }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Category</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->category->name }}"
                                    readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Stock</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->stock }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Buying Date</label>
                                <input class="form-control bg-white" value="{{ $product->buying_date }}" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Expire Date</label>
                                <input class="form-control bg-white" value="{{ $product->expire_date }}" readonly />
                            </div>
                            <div class="form-group col-md-6">
                                <label>Buying Price</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->buying_price }}"
                                    readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Selling Price</label>
                                <input type="text" class="form-control bg-white" value="{{  $product->selling_price }}"
                                    readonly>
                            </div>
                        </div>
                        <!-- end: Show Data -->

                        <div class="mt-2 text-center">
                            <a class="btn btn-warning mr-2" href="{{ route('products.edit', $product->id) }}">
                                <x-heroicon-o-pencil class="w-5 h-5 mr-1"
                                    style="display:inline-block; vertical-align:middle;" /> Edit
                            </a>
                            <a class="btn btn-primary" href="{{ route('products.index') }}">
                                <x-heroicon-o-arrow-left class="w-5 h-5 mr-1"
                                    style="display:inline-block; vertical-align:middle;" /> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
