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
                                        <!-- Icon: arrow-up-tray (Heroicons) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="w-5 h-5 mr-1" style="display:inline-block; vertical-align:middle;">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                        </svg>
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
