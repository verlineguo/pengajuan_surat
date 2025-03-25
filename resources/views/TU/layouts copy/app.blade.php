<!DOCTYPE html><!--
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
    <title>CoreUI Bootstrap Admin Template</title>
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
    <link rel="stylesheet" href="{{ asset('template') }}/vendors/simplebar/css/simplebar.css">
    <!-- Main styles for this application-->
    <link href="{{ asset('template') }}/css/style.css" rel="stylesheet">
    <!-- We use those styles to show code examples, you should remove them in your application.-->
    <link href="{{ asset('template') }}/css/examples.css" rel="stylesheet">
    <script src="{{ asset('template') }}/js/config.js"></script>
    <script src="{{ asset('template') }}/js/color-modes.js"></script>
    <link href="{{ asset('template') }}/vendors/@coreui/chartjs/css/coreui-chartjs.css" rel="stylesheet">
  </head>
  <body>
    @include('admin.layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100">
      @include('admin.layouts.header')
      <div class="body flex-grow-1">
        @yield('content')
      </div>
      @include('admin.layouts.footer')
    </div>
    @yield('scripts')

    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('template') }}/vendors/@coreui/coreui-pro/js/coreui.bundle.min.js"></script>
    <script src="{{ asset('template') }}/vendors/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('template') }}/vendors/i18next/js/i18next.min.js"></script>
    <script src="{{ asset('template') }}/vendors/i18next-http-backend/js/i18nextHttpBackend.js"></script>
    <script src="{{ asset('template') }}/vendors/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.js"></script>
    <script src="js/i18next.js"></script>
    <script>
      const header = document.querySelector('header.header');

      document.addEventListener('scroll', () => {
        if (header) {
          header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
      });
    </script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('template') }}/vendors/chart.js/js/chart.umd.js"></script>
    <script src="{{ asset('template') }}/vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
    <script src="{{ asset(path: 'template') }}/vendors/@coreui/utils/js/index.js"></script>
    <script src="js/main.js"></script>
    <script>
    </script>

  </body>
</html>