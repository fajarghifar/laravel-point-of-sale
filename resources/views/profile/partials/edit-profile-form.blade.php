<!-- begin: Edit Profile -->
<div class="card-header d-flex justify-content-between">
    <div class="iq-header-title">
        <h4 class="card-title">Edit Profile</h4>
    </div>
</div>
<div class="card-body">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
        <!-- begin: Input Image -->
        <div class="form-group row align-items-center">
            <div class="col-md-12">
                <div class="profile-img-edit">
                    <div class="crm-profile-img-edit">
                        <img class="crm-profile-pic rounded-circle avatar-100" id="image-preview" src="{{ $user->photo ? asset('storage/profile/'.$user->photo) : asset('assets/images/user/1.png') }}" alt="profile-pic">
                    </div>
                </div>
            </div>
        </div>
        <div class="input-group mb-4">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="image" name="photo" accept="image/*" onchange="previewImage();">
                <label class="custom-file-label" for="photo">Choose file</label>
            </div>
            @error('photo')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <!-- end: Input Image -->
        <!-- begin: Input Data -->
        <div class=" row align-items-center">
            <div class="form-group col-md-12">
                <label for="name">Full Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="username">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <!-- end: Input Data -->
        <div class="mt-2">
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <a class="btn bg-danger" href="{{ route('profile') }}">Cancel</a>
        </div>
    </form>
</div>
<!-- end: Edit Profile -->
