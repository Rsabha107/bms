<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>{{ config('settings.site_title') }}</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fnx/assets/img/favicons/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32"
    href="{{ asset('fnx/assets/img/favicons/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16"
    href="{{ asset('fnx/assets/img/favicons/favicon-16x16.png') }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('fnx/assets/img/favicons/favicon.ico') }}">
  <link rel="manifest" href="{{ asset('fnx/assets/img/favicons/manifest.json') }}">
  <meta name="msapplication-TileImage" content="{{ asset('fnx/assets/img/favicons/mstile-150x150.png') }}">
  <meta name="theme-color" content="#ffffff">
  <meta name="csrf-token" content="{{ csrf_token() }}">



  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
    rel="stylesheet">

    <!-- // surf -->
    <link rel="stylesheet" href="{{ asset('surf/assets/css/plugins/swiper.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('surf/assets/css/style.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('surf/assets/css/custom.css') }}" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer">


  <!-- // end surf -->
</head>


<body class="gradient-bg">

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  {{-- <main class="main" id="top"> --}}

    {{-- @include('bbs.template.customer.header_section')
    @include('bbs.template.customer.top_nav_section') --}}
    @yield('main')
    {{-- @include('bbs.template.customer.about_section')
    @include('bbs.template.customer.footer_section') --}}
  {{-- </main> --}}

  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->


  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->

  

  <!-- // surf -->

  <script src="{{ asset('surf/assets/js/plugins/jquery.min.js') }}"></script>
  <script src="{{ asset('surf/assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('surf/assets/js/plugins/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('surf/assets/js/plugins/swiper.min.js') }}"></script>
  <script src="{{ asset('surf/assets/js/plugins/countdown.js') }}"></script>
  <script src="{{ asset('surf/assets/js/theme.js') }}"></script>
<!-- // surf -->

  @stack('script')

</body>

</html>