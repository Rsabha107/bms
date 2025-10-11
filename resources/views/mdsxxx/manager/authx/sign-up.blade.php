<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="en-US" dir="ltr">

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
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="{{asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel='stylesheet' href="{{ asset ('assets/vendors/bootstrap-5.2.3-dist/css/bootstrap.min.css')}}">
    <link href="{{asset('assets/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{asset('assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <link href="{{ asset ('assets/css/toastr.min.css') }}" rel="stylesheet">

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
        <div class="container-fluid bg-body-tertiary dark__bg-gray-1200">
            <div class="bg-holder bg-auth-card-overlay" style="background-image:url(../../../assets/img/bg/37.png);">
            </div>
            <!--/.bg-holder-->

            <div class="row flex-center position-relative min-vh-100 g-0 py-5">
                <div class="col-11 col-sm-10 col-xl-8">
                    <div class="card border border-translucent auth-card">
                        <div class="card-body pe-md-0">
                            <div class="row align-items-center gx-0 gy-7">
                                <div
                                    class="col-auto bg-body-highlight dark__bg-gray-1100 rounded-3 position-relative overflow-hidden auth-title-box">
                                    <div class="bg-holder"
                                        style="background-image:url({{asset('assets/img/bg/38.png')}});">
                                    </div>
                                    <!--/.bg-holder-->

                                    <div
                                        class="position-relative px-4 px-lg-7 pt-7 pb-7 pb-sm-5 text-center text-md-start pb-lg-7 card-sign-up">
                                        <h3 class="mb-3 text-body-emphasis fs-7">Authentication</h3>
                                        <p class="text-body-tertiary">Give yourself some hassle-free development process
                                            with the uniqueness of Tracki!</p>
                                        <ul class="list-unstyled mb-0 w-max-content w-md-auto">
                                            <li class="d-flex align-items-center"><span
                                                    class="uil uil-check-circle text-success me-2"></span><span
                                                    class="text-body-tertiary fw-semibold">Fast</span></li>
                                            <li class="d-flex align-items-center"><span
                                                    class="uil uil-check-circle text-success me-2"></span><span
                                                    class="text-body-tertiary fw-semibold">Simple</span></li>
                                            <li class="d-flex align-items-center"><span
                                                    class="uil uil-check-circle text-success me-2"></span><span
                                                    class="text-body-tertiary fw-semibold">Responsive</span></li>
                                        </ul>
                                    </div>
                                    <div class="position-relative z-n1 mb-6 d-none d-md-block text-center mt-md-15"><img
                                            class="auth-title-box-img d-dark-none"
                                            src="../../../assets/img/spot-illustrations/auth.png" alt="" /><img
                                            class="auth-title-box-img d-light-none"
                                            src="../../../assets/img/spot-illustrations/auth-dark.png" alt="" /></div>
                                </div>
                                <div class="col mx-auto">
                                    <div class="auth-form-box">
                                        <div class="text-center mb-5"><a
                                                class="d-flex flex-center text-decoration-none mb-4"
                                                href="{{route('main.dashboard')}}">
                                                <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block">
                                                    <img src="../../../assets/img/icons/LogoPrintemps_2022_vert.png"
                                                        alt="phoenix" width="58" />
                                                </div>
                                            </a>
                                            <h3 class="text-body-highlight">Sign Up</h3>
                                            <p class="text-body-tertiary">Create your account today</p>
                                        </div>
                                        @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <form method="POST" action="{{ route('admin.signup.create') }}"
                                            class="needs-validation validatedForm" novalidate>
                                            @csrf
                                            <div class="mb-3 text-start">
                                                <label class="form-label" for="name">User Name</label>
                                                <input class="form-control" name="username" id="user_name" type="text"
                                                    placeholder="User Name" value="{{ old('user_name') }}" required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label class="form-label" for="name">Name</label>
                                                <input class="form-control" id="name" name="name" type="text"
                                                    placeholder="Name" value="{{ old('name') }}" required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label class="form-label" for="email">Email address</label>
                                                <input class="form-control" id="email" name="email" type="email"
                                                    placeholder="name@example.com" value="{{ old('email') }}" required>
                                            </div>
                                            <div class="mb-3 text-start">
                                                <label class="form-label" for="phone">Phone</label>
                                                <input class="form-control" id="phone" name="phone" type="phone"
                                                    placeholder="phone number" value="{{ old('phone') }}" required>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="faUser" type="radio"
                                                        name="usertype" value="" checked="checked" />
                                                    <label class="form-check-label" for="inlineRadio1">Functional
                                                        Area</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="departmentUser" type="radio"
                                                        name="usertype" value="" />
                                                    <label class="form-check-label"
                                                        for="inlineRadio2">Department</label>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-start" id="FASelect">
                                                <label class="form-label" for="email">Functional Area</label>
                                                <select name="functional_area_id" class="form-select"
                                                    id="floatingSelectFA">
                                                    <option selected="selected" value=""> Select funcitonal Area
                                                    </option>
                                                    @foreach ($fa as $key => $item )
                                                    @if (Request::old('id') == $item->id )
                                                    <option value="{{ $item->id  }}" selected>
                                                        {{ $item->name }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id  }}">
                                                        {{ $item->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3 text-start" id="DepartmentSelect" style="display:none">
                                                <label class="form-label" for="email">Department</label>
                                                <select name="department_id" class="form-select"
                                                    id="floatingSelectDepartment">
                                                    <option selected="selected" value=""> Select department </option>
                                                    @foreach ($departments as $key => $item )
                                                    @if (Request::old('id') == $item->id )
                                                    <option value="{{ $item->id}}" selected>
                                                        {{ $item->name }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $item->id}}">
                                                        {{ $item->name }}
                                                    </option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-xl-6">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input class="form-control form-icon-input" name="password"
                                                        id="password" type="password" placeholder="Password" required>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label class="form-label" for="password_confirmation">Confirm
                                                        Password</label>
                                                    <input class="form-control form-icon-input" type="password"
                                                        id="password_confirmation" name="password_confirmation"
                                                        placeholder="Confirm Password" required>
                                                </div>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="termsService" type="checkbox"
                                                    required>
                                                <label class="form-label fs-9 text-transform-none" for="termsService">I
                                                    accept the <a href="#!">terms </a>and <a href="#!">privacy
                                                        policy</a></label>
                                            </div>
                                            <button class="btn btn-primary w-100 mb-3" type="submit">Sign up</button>
                                            <!-- <div class="text-center"><a class="fs-9 fw-bold" href="{{route('main.auth.login')}}">Sign in to an existing account</a></div> -->
                                            <div class="text-center"><a class="fs-9 fw-bold"
                                                    href="{{route('main.dashboard')}}">Go back to dashboard</a></div>
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
            navbarTop.setAttribute('data-navbar-appearance', 'darker');
        }

        var navbarVerticalStyle = window.config.config.phoenixNavbarVerticalStyle;
        var navbarVertical = document.querySelector('.navbar-vertical');
        if (navbarVertical && navbarVerticalStyle === 'darker') {
            navbarVertical.setAttribute('data-navbar-appearance', 'darker');
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
    <script src="{{ asset ('assets/vendors/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="{{ asset ('assets/vendors/list.js/list.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset ('assets/vendors/dayjs/dayjs.min.js') }}"></script>
    <script src="{{ asset ('assets/js/phoenix.js') }}"></script>
    <script src="{{ asset ('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/code/sweetalert2.js') }}"></script>
    <script src="{{ asset ('assets/js/toastr.min.js') }}"></script>

    <script>
    // jQuery('.validatedForm').validate({
    //     rules: {
    //         password: {
    //             minlength: 5,
    //         },
    //         password_confirm: {
    //             minlength: 5,
    //             equalTo: "#password"
    //         }
    //     }
    // });

    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif

    $(document).ready(function() {
        console.log('fauser checked ')
        $("#FASelect").show();
        $("#DepartmentSelect").hide();
        $("#floatingSelectDepartment").prop('required', false);
        $("#floatingSelectFA").prop('required', true);
        $("input[name=usertype]").change(function() {
            console.log('usertype changing')
            if ($("#faUser").is(':checked')) {
                $("#FASelect").show();
                $("#DepartmentSelect").hide();
                $("#floatingSelectDepartment").prop('required', false);
                $("#floatingSelectFA").prop('required', true);

            } else {
                $("#DepartmentSelect").show();
                $("#FASelect").hide();
                $("#floatingSelectFA").prop('required', false);
                $("#floatingSelectDepartment").prop('required', true);

            }
        });
    });
    </script>

</body>

</html>
