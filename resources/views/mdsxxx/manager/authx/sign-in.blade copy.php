<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Tracki</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/img/favicons/favicon-16x16.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicons/favicon.ico')}}">
    <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}">
    <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/mstile-150x150.png')}}">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('assets/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link href="{{asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{asset('assets/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{asset('assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
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

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid bg-300 dark__bg-1200">
            <div class="bg-holder bg-auth-card-overlay" style="background-image:url({{asset('assets/img/bg/37.png')}});">
            </div>
            <!--/.bg-holder-->

            <div class="row flex-center position-relative min-vh-100 g-0 py-5">
                <div class="col-11 col-sm-10 col-xl-8">
                    <div class="card border border-200 auth-card">
                        <div class="card-body pe-md-0">
                            <div class="row align-items-center gx-0 gy-7">
                                <div class="col-auto bg-100 dark__bg-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                                    <div class="bg-holder" style="background-image:url({{asset('assets/img/bg/38.png')}});">
                                    </div>
                                    <!--/.bg-holder-->

                                    <div class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 pb-md-7">
                                        <h3 class="mb-3 text-body-emphasis fs-7"> Authentication</h3>
                                        <p class="text-700">Give yourself some hassle-free process with the
                                            uniqueness of Tracki!</p>
                                        <ul class="list-unstyled mb-0 w-max-content w-md-auto mx-auto">
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Fast</span></li>
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Simple</span></li>
                                            <li class="d-flex align-items-center"><span class="uil uil-check-circle text-success me-2"></span><span class="text-700 fw-semi-bold">Responsive</span></li>
                                        </ul>
                                    </div>
                                    <div class="position-relative z-index--1 mb-6 d-none d-md-block text-center mt-md-15">
                                        <img class="auth-title-box-img d-dark-none" src="{{asset('assets/img/spot-illustrations/logo_printemps.jpg')}}" alt="" />
                                        <img class="auth-title-box-img d-light-none" src="{{asset('assets/img/spot-illustrations/logo_printemps.jpg')}}" alt="" />
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="forms-sample">
                                        @csrf
                                </div>
                                <div class="col mx-auto">
                                    <div class="auth-form-box">
                                        <div class="text-center mb-7"><a class="d-flex flex-center text-decoration-none mb-4" href="{{ route('login') }}">
                                                <div class="d-flex align-items-center fw-bolder fs-5 d-inline-block">
                                                    <img src="{{asset('assets/img/icons/logo.png')}}" alt="Tajheez" width="58" />
                                                </div>
                                            </a>
                                            <h3 class="text-1000">Sign In</h3>
                                            <p class="text-700">Get access to your account</p>
                                        </div>
                                        <!-- <button class="btn btn-phoenix-secondary w-100 mb-3"><span
                                                class="fab fa-google text-danger me-2 fs--1"></span>Sign in with
                                            google</button>
                                        <button class="btn btn-phoenix-secondary w-100"><span
                                                class="fab fa-facebook text-primary me-2 fs--1"></span>Sign in with
                                            facebook</button>
                                        <div class="position-relative">
                                            <hr class="bg-200 mt-5 mb-4" />
                                            <div class="divider-content-center bg-white">or use email</div>
                                        </div> -->
                                        <div class="mb-3 text-start">
                                            <label class="form-label" for="email">Email/Name/Phone</label>
                                            <div class="form-icon-container">
                                                <input class="form-control form-icon-input" name="login" id="login" type="login"><span class="fas fa-user text-900 fs--1 form-icon"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 text-start">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="form-icon-container">
                                                <input class="form-control form-icon-input" name="password" id="password" type="password" placeholder="Password" /><span class="fas fa-key text-900 fs--1 form-icon"></span>
                                            </div>
                                        </div>
                                        <div class="row flex-between-center mb-7">
                                            <div class="col-auto">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" id="basic-checkbox" type="checkbox" checked="checked" />
                                                    <label class="form-check-label mb-0" for="basic-checkbox">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <div class="col-auto"><a class="fs--1 fw-semi-bold" href="{{route('main.auth.forgot')}}">Forgot
                                                    Password?</a></div>
                                        </div>
                                        <button class="btn btn-primary w-100 mb-3">Sign In</button>
                                        <!-- <div class="text-center"><a class="fs--1 fw-bold"
                                                href="{{route('main.auth.signup')}}">Create an
                                                account</a></div> -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var navbarTopStyle = window.config.config.phoenixNavbarTopStyle;
            var navbarTop = document.querySelector('.navbar-top');
            if (navbarTopStyle === 'darker') {
                navbarTop.classList.add('navbar-darker');
            }

            var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
            var navbarVertical = document.querySelector('.navbar-vertical');
            if (navbarVertical && navbarVerticalStyle === 'darker') {
                navbarVertical.classList.add('navbar-darker');
            }
        </script>

    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->





    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->

    <script src="{{ asset ('assets/jquery/dist/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset ('assets/vendors/popper/popper.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/anchorjs/anchor.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/lodash/lodash.min.js') }}"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset ('assets/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset ('assets/js/phoenix.js') }}"></script>
    <script src="{{ asset ('assets/vendors/select2/select2.min.js') }}"></script>


</body>

</html>
