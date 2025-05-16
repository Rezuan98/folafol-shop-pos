<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Login - eManager</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />

    <style>
        .auth-card {
            max-width: 400px;
            margin: 0 auto;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border-radius: 10px;
            overflow: hidden;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 25px;
        }

        .auth-logo {
            font-size: 24px;
            font-weight: 700;
            color: #0d6efd;
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
        }

        .auth-logo span {
            color: #6c757d;
            font-weight: 400;
        }

        .header-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        .auth-form {
            padding: 25px;
        }

        .auth-form .form-control {
            height: 46px;
            border-radius: 6px;
        }

        .btn-login {
            height: 46px;
            border-radius: 6px;
            font-weight: 500;
            width: 100%;
        }

        .forgot-link {
            font-size: 14px;
            text-align: center;
            display: block;
            margin-top: 15px;
            color: #6c757d;
        }

    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-6 col-xl-4 mx-auto">
                        <div class="card auth-card">
                            <div class="card-header text-center" style="background-color:#0A1122;">
                                <div class="logo-container mb-3">
                                    <img src="{{ asset('backend/images/logo.png') }}" alt="eManager Logo" class="img-fluid" style="max-height: 60px;">
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="auth-form">
                                @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                            <label class="form-check-label" for="remember">Remember me</label>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-primary btn-login">Login</button>
                                    </div>

                                    <a href="#" class="forgot-link mt-3">Forgot Password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <script>
        feather.replace();

    </script>
</body>
</html>
