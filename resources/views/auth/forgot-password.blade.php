<!DOCTYPE html>
<!--
    * CoreUI PRO Bootstrap Admin Template
    * @version v5.4.0
    * @link https://coreui.io/product/bootstrap-dashboard-template/
    * Copyright (c) 2025 creativeLabs Łukasz Holeczek
    * License (https://coreui.io/pro/license/)
    -->
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,SCSS,HTML,RWD,Dashboard">
    <title>HaloSurat - Forgot Password</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('template') }}/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('template') }}/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('template') }}/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template') }}/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('template') }}/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('template') }}/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('template') }}/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('template') }}/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('template') }}/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('template') }}/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('template') }}/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('template') }}/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('template') }}/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="{{ asset('template') }}/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('template') }}/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
    <!-- Main styles for this application-->
    <link href="{{ asset('template') }}/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="{{ asset('template') }}/css/examples.css" rel="stylesheet">
    <script src="{{ asset('template') }}/js/config.js"></script>
    <script src="{{ asset('template') }}/js/color-modes.js"></script>
  </head>
  <body>
    <div class="min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-12 p-4 mb-0">
                <div class="card-body">
                  <h1>Forgot Password</h1>
                  <p class="text-body-secondary">Enter your email to reset your password</p>
                  
                  @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
                  @endif
                  
                  <!-- Form Forgot Password -->
                  <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="input-group mb-3">
                      <span class="input-group-text">
                        <svg class="icon">
                          <use xlink:href="{{ asset('template') }}/vendors/@coreui/icons/svg/free.svg#cil-envelope-closed"></use>
                        </svg>
                      </span>
                      <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    
                    <!-- Submit -->
                    <div class="row">
                      <div class="col-6">
                        <button class="btn btn-primary px-4" type="submit">Send Password Reset Link</button>
                      </div>
                      <div class="col-6 text-end">
                        <a class="btn btn-link px-0" href="{{ route('login') }}">Back to Login</a>
                      </div>
                    </div>
                  </form>
                  <!-- End Form Forgot Password -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>