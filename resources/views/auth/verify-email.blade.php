@extends('auth.body.main')

@section('container')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <!-- Section: Email Verification Form -->
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <h2 class="mb-2">Verify Your Email</h2>
                                <p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>

                                <!-- Alert: Session Status -->
                                @if (session('status') == 'verification-link-sent')
                                    <div class="alert alert-success" role="alert">
                                        A new verification link has been sent to the email address you provided during registration.
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                                    </div>
                                </form>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-primary p-0">Log Out</button>
                                </form>
                            </div>
                        </div>

                        <!-- Section: Right Side Image -->
                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right" alt="Email Verification Illustration">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
