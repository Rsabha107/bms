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
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicons/apple-touch-icon.jpg')}}">
  <link rel="icon" type="image/jpg" sizes="32x32" href="{{asset('assets/img/favicons/sparkle_hrms.jpg')}}">
  <link rel="icon" type="image/jpg" sizes="16x16" href="{{asset('assets/img/favicons/sparkle_hrms.jpg')}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicons/sparkle_hrms.jpg')}}">
  <link rel="manifest" href="{{asset('assets/img/favicons/manifest.json')}}">
  <meta name="msapplication-TileImage" content="{{asset('assets/img/favicons/mstile-150x150.png')}}">
  <meta name="theme-color" content="#ffffff">
  <script src="{{asset('assets/vendors/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendors/simplebar/simplebar.min.js')}}"></script>
  <script src="{{asset('assets/tracki/js/config.js')}}"></script>


  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">
  <link href="{{asset('assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <link href="{{asset('assets/tracki/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
  <link href="{{asset('assets/tracki/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
  <link href="{{asset('assets/tracki/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
  <link href="{{asset('assets/tracki/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
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
    <div class="container">
      <div class="row flex-center min-vh-100 py-5">
        <div class="col-sm-10 col-md-8 col-lg-5 col-xxl-4"><a class="d-flex flex-center text-decoration-none mb-4" href="../../../index.html">
            <div class="d-flex align-items-center fw-bolder fs-3 d-inline-block"><img src="../../../assets/img/icons/sparkle_hrms.jpg" alt="phoenix" width="58" />
            </div>
          </a>
          <div class="px-xxl-5">
            <div class="text-center mb-6">
              <h4 class="text-body-highlight">Enter the verification code</h4>
              <p class="text-body-tertiary mb-0">An email containing a 6-digit verification code has been sent to the email address - exa*********.com </p>
              <!-- <P class="fs-10 mb-5">Don’t have access? <a href="#!">Use another method</a></P> -->
              <!-- @if (Session::has('message'))
              <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
              </div>
              @endif -->
              <!-- @if (isset($message))
              <div class="alert alert-success" role="alert">
                {{ $message }}
              </div>
              @endif -->
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
              <form class="verification-form" data-2fa-form="tracki-2fa-form" method="POST" action="{{ route('auth.otp.post') }}">
                @csrf

                <div class="d-flex align-items-center gap-2 mb-3">
                  <!-- <input class="form-control px-2 text-center" type="number" /> -->
                  <input class="form-control pe-6 text-center" name="otp" id="otp" type="text" placeholder="OTP" />

                </div>
                <!-- <div class="form-check text-start mb-4">
                    <input class="form-check-input" id="2fa-checkbox" type="checkbox" />
                    <label for="2fa-checkbox">Don’t ask again on this device</label>
                  </div> -->
                <button class="btn btn-primary w-100 mb-5" type="submit">Verify</button>
                <a class="fs-9" href="{{ route('otp.resend.get') }}">Didn’t receive the code? </a>
                <br>
                <a class="fs-9" href="{{ route('mds.auth.login') }}">Back to login page </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


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
  <script src="{{ asset ('assets/vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset ('assets/vendors/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset ('assets/vendors/dayjs/dayjs.min.js') }}"></script>
  <script src="{{ asset ('assets/js/toastr.min.js') }}"></script>
  <script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
  <!-- <script src="{{ asset ('assets/vendors/select2/select2.min.js') }}"></script> -->

  <script>
    @if(Session::has('message'))
    // console.log('in toaster')
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-center",
      // "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "600",
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
  </script>

</body>

</html>