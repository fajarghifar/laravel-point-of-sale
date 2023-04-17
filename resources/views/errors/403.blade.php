<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS Dash | ERROR 403</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row no-gutters height-self-center">
                <div class="col-sm-12 text-center align-self-center">
                    <div class="iq-error position-relative">
                        <h2 class="mb-0 mt-4">403</h2>
                        <p>Oops! User does not have the right permissions.</p>
                        <a class="btn btn-primary d-inline-flex align-items-center mt-3" href="{{ route('dashboard') }}"><i class="ri-home-4-line"></i>Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
