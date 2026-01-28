@extends('dashboard.body.main')

@section('specificpagestyles')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <!-- begin: Input Image -->
                            <div class="form-group row align-items-center">
                                <div class="col-md-12">
                                    <div class="profile-img-edit">
                                        <div class="crm-profile-img-edit">
                                            <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview"
                                                src="{{ $product->image ? asset('storage/products/' . $product->image) : asset('assets/images/product/default.webp') }}"
                                                alt="profile-pic">
                                            </div>
                                            </div>
                                            </div>
                                            </div>

                            <div class="row">
                                <div class="input-group mb-4 col-lg-6">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image"
                                            accept="image/*" onchange="previewImage();">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                    </div>
                                    <!-- end: Input Image -->

                            <!-- begin: Input Data -->
                            <div class="row align-items-center">
                                <div class="form-group col-md-12">
                                    <label for="name">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                        value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                <div class="form-group col-md-6">
                                    <label for="code">Product Code</label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                                        value="{{ old('code', $product->code) }}" maxlength="50">
                                    <small class="form-text text-muted">Edit code or scan new barcode below</small>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="barcode_scanner">Barcode Scanner</label>
                                    <input type="text" class="form-control" id="barcode_scanner" 
                                        placeholder="Scan barcode here (mobile-friendly)" autocomplete="off">
                                    <small class="form-text text-muted">Scan barcode to update Product Code</small>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="category_id">Category <span class="text-danger">*</span></label>
                                    <select class="form-control" name="category_id" required>
                                        <option selected="" disabled>-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="stock">Stock</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                                        value="{{ old('stock', $product->stock) }}">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                <div class="form-group col-md-6">
                                    <label for="buying_price">Buying Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('buying_price') is-invalid @enderror" id="buying_price"
                                        name="buying_price" value="{{ old('buying_price', $product->buying_price) }}" required>
                                    @error('buying_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                <div class="form-group col-md-6">
                                    <label for="selling_price">Selling Price <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price"
                                        name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" required>
                                    @error('selling_price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>

                                <div class="form-group col-md-6">
                                    <label for="buying_date">Buying Date</label>
                                    <input id="buying_date" class="form-control @error('buying_date') is-invalid @enderror" name="buying_date"
                                        value="{{ old('buying_date', $product->buying_date) }}" />
                                    @error('buying_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="expire_date">Expire Date</label>
                                    <input id="expire_date" class="form-control @error('expire_date') is-invalid @enderror" name="expire_date"
                                        value="{{ old('expire_date', $product->expire_date) }}" />
                                    @error('expire_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- end: Input Data -->

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary mr-2">
                                    <x-heroicon-o-check-circle class="w-5 h-5 mr-1 inline" /> Update
                                </button>
                                <a class="btn bg-danger" href="{{ route('products.index') }}">
                                    <x-heroicon-o-x-mark class="w-5 h-5 mr-1 inline" /> Cancel
                                </a>
                            </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                </div>
                                <!-- Page end  -->
                                </div>

    <script>
        $('#buying_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
            // https://gijgo.com/datetimepicker/configuration/format
        });
        $('#expire_date').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd'
            // https://gijgo.com/datetimepicker/configuration/format
        });

        // Barcode Scanner Handling
        (function() {
            const barcodeScanner = document.getElementById('barcode_scanner');
            const codeField = document.getElementById('code');
            
            if (barcodeScanner && codeField) {
                let scannerTimeout;
                
                // Auto-focus scanner field on mobile devices
                function isMobileDevice() {
                    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
                           (window.innerWidth <= 768);
                }
                
                if (isMobileDevice()) {
                    // Auto-focus scanner field on mobile after a short delay
                    setTimeout(function() {
                        barcodeScanner.focus();
                    }, 300);
                }
                
                // Handle scanner input (scanners typically send Enter after barcode)
                barcodeScanner.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.keyCode === 13) {
                        e.preventDefault();
                        
                        const scannedValue = barcodeScanner.value.trim();
                        if (scannedValue) {
                            // Populate code field with scanned value
                            codeField.value = scannedValue;
                            
                            // Visual feedback
                            codeField.classList.add('border-success');
                            setTimeout(function() {
                                codeField.classList.remove('border-success');
                            }, 1000);
                            
                            // Clear scanner field
                            barcodeScanner.value = '';
                            
                            // Re-focus scanner for next scan
                            if (isMobileDevice()) {
                                setTimeout(function() {
                                    barcodeScanner.focus();
                                }, 100);
                            }
                        }
                    }
                });
                
                // Handle paste events (some scanners use paste)
                barcodeScanner.addEventListener('paste', function(e) {
                    setTimeout(function() {
                        const pastedValue = barcodeScanner.value.trim();
                        if (pastedValue) {
                            codeField.value = pastedValue;
                            codeField.classList.add('border-success');
                            setTimeout(function() {
                                codeField.classList.remove('border-success');
                            }, 1000);
                            barcodeScanner.value = '';
                        }
                    }, 10);
                });
            }
        })();
    </script>

    @include('components.preview-img-form')
@endsection
