<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>{{__('traki.page_title')}}</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset ('assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset ('assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset ('assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset ('assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset ('assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset ('assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- <script src="{{ asset ('assets/js/config.js') }}"></script> -->


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->

    @include('main.kanban.partials.style-list')

    <script>
    $(window).load(function() {
        console.log('spinner')
        $(".se-pre-con").fadeOut("slow");
    });
    </script>

<script>
      var phoenixIsRTL = window.config.config.phoenixIsRTL;
      if (phoenixIsRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
      } else {
        var linkRTL = document.getElementById('style-rtl');
        var userLinkRTL = document.getElementById('user-style-rtl');
        linkRTL.setAttribute('disabled', true);
        userLinkRTL.setAttribute('disabled', true);
      }
    </script>

</head>

<body>
    <div class="se-pre-con"></div>
    <main class="main" id="top">
        <!-- ===============================================-->
        <!--    Main Content-->
        <!-- ===============================================-->
        @include('main.partials.sidebar')
        @include('main.partials.header')
        @yield('main')
        @include('main.partials.footer')

        <!-- ===============================================-->
        <!--    End of Main Content-->
        <!-- ===============================================-->





        <!-- ===============================================-->
        <!--    JavaScripts-->
        <!-- ===============================================-->
        @include('main.kanban.partials.js-list')
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> -->

        @stack('script')
</body>

</html>
