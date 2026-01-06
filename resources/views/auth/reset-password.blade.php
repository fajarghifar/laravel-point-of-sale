@extends('auth.body.main')

@section('container')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <!-- Section: Reset Password Form -->
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <h2 class="mb-2">New Password</h2>
                                <p>Create your new password.</p>

                                <form action="{{ route('password.store') }}" method="POST">
                                    @csrf
                                    <!-- Password Reset Token -->
                                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                    <div class="row">
                                        <!-- Input: Email -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control @error('email') is-invalid @enderror" type="email"
                                                    placeholder=" " name="email" value="{{ old('email', $request->email) }}" required autofocus>
                                                <label>Email</label>
                                            </div>
                                            @error('email')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Input: Password -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group position-relative">
                                                <input class="floating-input form-control @error('password') is-invalid @enderror"
                                                    type="password" placeholder=" " name="password" required id="password">
                                                <label>New Password</label>
                                                <div class="position-absolute" style="right: 15px; top: 15px; cursor: pointer; color: #6c757d;"
                                                    onclick="togglePassword('password')">
                                                    <x-heroicon-o-eye class="w-6 h-6" id="eye-password" />
                                                    <x-heroicon-o-eye-slash class="w-6 h-6 d-none" id="eye-slash-password" />
                                                </div>
                                            </div>
                                            @error('password')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Input: Confirm Password -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group position-relative">
                                                <input class="floating-input form-control" type="password" placeholder=" "
                                                    name="password_confirmation" required id="password_confirmation">
                                                <label>Confirm Password</label>
                                                <div class="position-absolute" style="right: 15px; top: 15px; cursor: pointer; color: #6c757d;"
                                                    onclick="togglePassword('password_confirmation')">
                                                    <x-heroicon-o-eye class="w-6 h-6" id="eye-password_confirmation" />
                                                    <x-heroicon-o-eye-slash class="w-6 h-6 d-none" id="eye-slash-password_confirmation" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                </form>
                            </div>
                        </div>

                        <!-- Section: Right Side Image -->
                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right"
                                alt="Reset Password Illustration">
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

    <!-- Script: Password Visibility Toggle -->
    <script>
            function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById('eye-' + inputId);
            const eyeSlash = document.getElementById('eye-slash-' + inputId);

            if (input.type === "password") {
                input.type = "text";
                eye.classList.add('d-none');
                eyeSlash.classList.remove('d-none');
            } else {
                input.type = "password";
                eye.classList.remove('d-none');
                eyeSlash.classList.add('d-none');
            }
        }
    </script>
@endsection
