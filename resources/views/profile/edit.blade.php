@extends('dashboard.body.main')

@section('container')
<div class="container-fluid">
    @include('profile.partials.background-profile')

    <div class="row px-3">
        @include('profile.partials.left-profile')

        <div class="col-lg-8 card-profile">
            <div class="card card-block card-stretch card-height">
                <div class="card-body">
                    <!-- begin: Navbar Profile -->
                    @include('profile.partials.navbar-profile')
                    <!-- end: Navbar Profile -->

                    <!-- begin: Edit Profile -->
                    @include('profile.partials.edit-profile-form')
                    <!-- end: Edit Profile -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(){
        const image = document.querySelector('#image');
        const imagePreview = document.querySelector('#image-preview');

        imagePreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imagePreview.src = oFREvent.target.result;
        }
    }
</script>
@endsection
