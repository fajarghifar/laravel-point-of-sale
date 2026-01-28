@extends('dashboard.body.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Import Product</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('products.importStore') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- begin: Input File -->
                                    <div class="form-group mb-4">
                                        <label for="upload_file">Upload File (.xls, .xlsx)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('upload_file') is-invalid @enderror" id="upload_file" name="upload_file" onchange="showFileName();">
                                            <label class="custom-file-label" for="upload_file" id="label_input">Choose file</label>
                                        </div>
                                        @error('upload_file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <!-- end: Input File -->
                                </div>
                                </div>

                                <div class="mt-2 text-center">
                                    <button type="submit" class="btn btn-primary mr-2">
                                        <x-heroicon-o-arrow-up-tray class="w-5 h-5 mr-1 inline" />
                                        Import
                                    </button>
                                    <a class="btn btn-danger" href="{{ route('products.index') }}">Cancel</a>
                                </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                </div>
                                <!-- Page end  -->
                                </div>

                                <script>
                                    /**
                                     * Show the selected file name in the custom file input label.
                                     */
                                    function showFileName() {
                                        const input = document.getElementById('upload_file');
                                        const label_input = document.getElementById('label_input');

            if (input.files && input.files.length > 0) {
                label_input.innerHTML = input.files[0].name;
            }
        }
    </script>
@endsection
