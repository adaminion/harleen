<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <title>Revitalisasi Pelaporan Sumberdaya</title>

  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style type="text/css">
    body {
      padding-top: 40px;
      padding-bottom: 40px;
    }
    .form-login {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-login .form-login-heading,
    .form-login .checkbox {
      margin-bottom: 10px;
    }
    .form-login .checkbox {
      font-weight: normal;
    }
    .form-login .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }
    .form-login .form-control:focus {
      z-index: 2;
    }
    .form-login input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-login input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
  </style>
</head>

<body>
  <div class="container">
    <form class="form-login" method="post" action="{{ url('login') }}">
      {!! csrf_field() !!}

      <div class="login-box">
        <img src="{{ asset('img/logo-skkmigas.png') }}" alt="SKK Migas"
             class="img-responsive center-block">
        <p class="text-center"><strong>Revitalisasi Pelaporan Sumberdaya</strong></p>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required autofocus>

        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>

        <div class="checkbox">
          <label><input type="checkbox" value="remember-me" name="remember"> Remember me</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </div>
    </form>
  </div>
</body>
</html>