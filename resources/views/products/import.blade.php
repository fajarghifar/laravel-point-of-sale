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
                            <div class="input-group mb-4 col-lg-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('upload_file') is-invalid @enderror" id="upload_file" name="upload_file" onchange="showFileName();">
                                    <label class="custom-file-label" for="upload_file" id="label_input">Choose file (.xls / .xlsx)</label>
                                </div>
                                @error('upload_file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- end: Input Data -->
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary mr-2">Import</button>
                            <a class="btn bg-danger" href="{{ route('products.index') }}">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
</div>

<script>
function showFileName() {
    const input = document.getElementById('upload_file');
    const label_input = document.getElementById('label_input');

    // the change event gives us the input it occurred in
    const srcFile = input.srcElement;

    // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
    var fileName = input.files[0].name;

    label_input.innerHTML = fileName;
}
</script>

@endsection
