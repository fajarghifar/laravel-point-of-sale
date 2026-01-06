@extends('auth.body.main')

@section('container')
    <div class="container">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
                <div class="card auth-card">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                            <!-- Section: Registration Form -->
                            <div class="col-lg-7 align-self-center">
                                <div class="p-3">
                                    <h2 class="mb-2">Register</h2>
                                    <p>Create your account.</p>

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <!-- Input: Full Name -->
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control @error('name') is-invalid @enderror"
                                                        type="text" placeholder=" " name="name" autocomplete="off"
                                                        value="{{ old('name') }}" required>
                                                    <label>Full Name</label>
                                                </div>
                                                @error('name')
                                                    <div class="mb-4" style="margin-top: -20px">
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Input: Username -->
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control @error('username') is-invalid @enderror"
                                                        type="text" placeholder=" " name="username" autocomplete="off"
                                                        value="{{ old('username') }}" required>
                                                    <label class="mb-1">Username</label>
                                                </div>
                                                @error('username')
                                                    <div class="mb-4" style="margin-top: -20px">
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Input: Email -->
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control @error('email') is-invalid @enderror"
                                                        type="email" placeholder=" " name="email" autocomplete="off"
                                                        value="{{ old('email') }}" required>
                                                    <label>Email</label>
                                                </div>
                                                @error('email')
                                                    <div class="mb-4" style="margin-top: -20px">
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Input: Password -->
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group position-relative">
                                                    <input class="floating-input form-control @error('password') is-invalid @enderror"
                                                        type="password" placeholder=" " name="password" autocomplete="off"
                                                        required id="reg_password">
                                                    <label>Password</label>
                                                    <div class="position-absolute"
                                                        style="right: 15px; top: 15px; cursor: pointer; color: #6c757d;"
                                                        onclick="togglePassword('reg_password')">
                                                        <x-heroicon-o-eye class="w-6 h-6" id="eye-reg_password" />
                                                        <x-heroicon-o-eye-slash class="w-6 h-6 d-none" id="eye-slash-reg_password" />
                                                    </div>
                                                </div>
                                                @error('password')
                                                    <div class="mb-4" style="margin-top: -20px">
                                                        <div class="text-danger small">{{ $message }}</div>
                                                    </div>
                                                @enderror
                                            </div>

                                            <!-- Input: Confirm Password -->
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group position-relative">
                                                    <input class="floating-input form-control" type="password"
                                                        placeholder=" " name="password_confirmation" autocomplete="off"
                                                        required id="reg_confirm_password">
                                                    <label>Confirm Password</label>
                                                    <div class="position-absolute"
                                                        style="right: 15px; top: 15px; cursor: pointer; color: #6c757d;"
                                                        onclick="togglePassword('reg_confirm_password')">
                                                        <x-heroicon-o-eye class="w-6 h-6" id="eye-reg_confirm_password" />
                                                        <x-heroicon-o-eye-slash class="w-6 h-6 d-none"
                                                            id="eye-slash-reg_confirm_password" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                        <p class="mt-3">
                                            Already have an Account? <a href="{{ route('login') }}" class="text-primary">Log In</a>
                                        </p>
                                    </form>
                                </div>
                            </div>

                            <!-- Section: Right Side Image -->
                            <div class="col-lg-5 content-right">
                                <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right"
                                    alt="Registration Illustration">
                            </div>
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
