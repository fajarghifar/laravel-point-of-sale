@extends('auth.body.main')

@section('container')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <!-- Section: Forgot Password Form -->
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <h2 class="mb-2">Reset Password</h2>
                                <p>Enter your email address and we'll send you an email with instructions to reset your password.</p>

                                <!-- Alert: Session Status -->
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- Input: Email -->
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control @error('email') is-invalid @enderror" type="email"
                                                    placeholder=" " name="email" value="{{ old('email') }}" required autofocus>
                                                <label>Email</label>
                                            </div>
                                            @error('email')
                                                <div class="mb-4" style="margin-top: -20px">
                                                    <div class="text-danger small">{{ $message }}</div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reset Password</button>
                                    <p class="mt-3">
                                        Wait, I remember my password... <a href="{{ route('login') }}" class="text-primary">Log In</a>
                                    </p>
                                </form>
                            </div>
                        </div>

                        <!-- Section: Right Side Image -->
                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right" alt="Forgot Password Illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
