<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


    <title>Login - IMS</title>
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/ruang-admin.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-login bg-dark m-2">
    <!-- Login Content -->
    <div class="container-login">

        <div class="row justify-content-center my-5">
            <div class="col-xl-4 col-lg-4 col-md-4">

                <div class="text">
                    <div class="card border-0 shadow my-5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <img src="{{ asset('ims_logo.png') }}" class="img-fluid m-2" width="20%" height="auto">
                                <h1 class="h4 text-gray-900 mb-4">Login</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">

                                    <label><i class="fa fa-envelope"></i> Email Address</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <br>

                                <div class="form-group">

                                    <label>Password</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>


                                </div>
                                <div class="row">
                                     @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="display: inline-block;">
                                            {{ __('Forgot Your Password? Click to Reset') }}
                                        </a>
                                    @endif
                                </div>
                            </form>

                            <hr>

                            <div class="text-center">
                                <a class="font-weight-bold small" style="text-decoration: none" href="{{ '/register' }}">Not Registered? Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


    </div>
    <!-- Login Content -->
    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('backend/js/ruang-admin.min.js') }}"></script>
</body>

</html>
