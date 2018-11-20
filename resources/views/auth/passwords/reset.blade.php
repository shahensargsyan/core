<!DOCTYPE html>
<html style="background-color:#f5f0ed">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Salon LA | Reset Password </title>
  <meta name="msapplication-tap-highlight" content="no">
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 100%;
    }

    @font-face {
      font-family: "OpenSans-Light";
      src: url("/fonts/OpenSans-Light.eot");
      src: url("/fonts/OpenSans-Light.eot?#iefix") format("embedded-opentype"), url("/fonts/OpenSans-Light.woff") format("woff"), url("/fonts/OpenSans-Light.ttf") format("truetype"), url("/fonts/OpenSans-Light.svg#OpenSans-Light") format("svg");
      font-weight: normal;
      font-style: normal;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    @font-face {
      font-family: "OpenSans-ExtraBold";
      src: url("/fonts/OpenSans-ExtraBold.eot");
      src: url("/fonts/OpenSans-ExtraBold.eot?#iefix") format("embedded-opentype"), url("/fonts/OpenSans-ExtraBold.woff") format("woff"), url("/fonts/OpenSans-ExtraBold.ttf") format("truetype"), url("/fonts/OpenSans-ExtraBold.svg#OpenSans-ExtraBold") format("svg");
      font-weight: normal;
      font-style: normal;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    @font-face {
      font-family: 'open_sans_bold';
      src: url('/fonts/opensans-bold-webfont.woff2') format('woff2'),
      url('/fonts/opensans-bold-webfont.woff') format('woff');
      font-weight: normal;
      font-style: normal;
    }



    .activation-content {
      width: 90%;
      margin: 100px auto;
      line-height: 26px;
    }

    .activation-page {
      width: 100%;
      padding-top: 50px;
      text-align: center;
    }

    a {
      text-decoration: none;
      transition: all 0.3s ease-in-out;
      -webkit-transition: all 0.3s ease-in-out;
      -khtml-transition: all 0.3s ease-in-out;
      -moz-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      -ms-transition: all 0.3s ease-in-out;
      -icab-transition: all 0.3s ease-in-out;
    }

    .activation-page a.logo-link {
      margin: 0 auto;
    }

    .logo-link img {
      width: 280px;
      height: 81px;
      margin-top: 11px;
    }

    .activation-page a.logo-link img {
      width: 280px !important;
    }

    .activation-content h1 {
      font-family: "OpenSans-ExtraBold";
      font-size: 48px;
      color: #4e342e;
      line-height: 48px;
    }

    .activation-content h3 {
      margin-top: 40px;
      font-family: 'open_sans_bold';
      color: #4e342e;
      font-size: 23px;
      line-height: 30px;
      margin-bottom: 24px;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-weight: 400;
    }

    .reset-password-form {
      width: 400px;
      margin: 0 auto;
    }

    .reset-password-form label {
      text-align: left;
      font-size: 14px;
      width: 100%;
      float: left;
    }

    .def-input {
      border-radius: 5px;
      background: transparent;
      background-color: #f5f0ed;
      padding: 8px 13px 8px 19px;
      font-size: 14px;
      line-height: 20px;
      position: relative;
      margin-bottom: 30px;
      width: 100%;
      -moz-appearance: none;
      -webkit-appearance: none;
      -webkit-appearance: none;
      -webkit-appearance: none;
      -webkit-appearance: none;
      border: 1px solid #f5f0ed;
    }
    .reset-password-form  .def-input:focus {
      border-color: #b69584;
      -webkit-transition: border-color 0.3s linear, color 0.3s linear;
      transition: border-color 0.3s linear, color 0.3s linear;
    }
    .reset-password-form .def-input {
      border: 1px solid #4d342f;
      margin-bottom: 5px;
    }

    .main-font,
    .btn,
    .def-input,
    .form-place p,
    .btn-link,
    .btn-submit,
    html,
    body,
    .scroller-section .decor-container p,
    .type-p,
    footer p,
    footer .copyright__2>span,
    .no-employees-warning-block,
    .mobile-menu-switcher-container .selected-menu-item,
    .offerring-item-price,
    .call-us-block,
    .callButton {
      font-family: 'OpenSans-Light', sans-serif;
    }

    .btn {
      border-radius: 25px;
      color: #fff;
      background-color: #4e342e;
      font-size: 30px;
      display: inline-block;
      padding: 7px 30px 8px;
      line-height: 40px;
      border-radius: 5px;
      margin-top: 34px;
      border: 1px solid #4e342e;
      cursor: pointer;
      transition: all 0.3s linear;
    }

    .reset-password-form .btn {
      margin-top: 26px;
      font-size: 18px;
      padding: 3px 25px 3px;
      line-height: 34px;
    }
    
    .help-block{
        color: red;
    }
  </style>
</head>

<body>
  <div class="activation-page">
    <a href="{{ env('SITE_URL') }}" class="logo-link">
        <img src="{{ url('img/salon-logo.svg') }}">
    </a>

    <div class="activation-content">
        <h1>My Salon LA</h1>
        <h3>Reset Password</h3>
        <div class="panel-body reset-password-form">
            <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <label for="email" class="col-md-4 control-label ">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control def-input" name="email" value="{{ $email or old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control def-input" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control def-input" name="password_confirmation" required>
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</body>

</html>
