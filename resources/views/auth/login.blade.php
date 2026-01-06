@extends('auth.body.main')

@section('container')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <!-- Section: Login Form -->
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <h2 class="mb-2">Log In</h2>
                                <p>Login to stay connected.</p>

                                <!-- Alert: Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Input: Username -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control @error('username') is-invalid @enderror" type="text"
                                                    name="username" placeholder=" " value="{{ old('username') }}" autocomplete="off" required
                                                    autofocus>
                                                <label>Username</label>
                                            </div>
                                            @error('username')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Input: Password -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group position-relative">
                                                <input class="floating-input form-control @error('password') is-invalid @enderror"
                                                    type="password" name="password" placeholder=" " required id="password">
                                                <label>Password</label>
                                                <div class="position-absolute" style="right: 15px; top: 15px; cursor: pointer; color: #6c757d;"
                                                    onclick="togglePassword('password')">
                                                    <x-heroicon-o-eye class="w-6 h-6" id="eye-password" />
                                                    <x-heroicon-o-eye-slash class="w-6 h-6 d-none" id="eye-slash-password" />
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Links: Register & Forgot Password -->
                                        <div class="col-lg-6">
                                            <p>
                                                Not a Member yet? <a href="{{ route('register') }}" class="text-primary">Register</a>
                                            </p>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="{{ route('password.request') }}" class="text-primary float-right">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login</button>
                                </form>
                            </div>
                        </div>

                        <!-- Section: Right Side Image -->
                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right" alt="Login Illustration">
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
