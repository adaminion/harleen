<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <title>You seems lost</title>

  <style>
    body {
      margin: 40px auto;
      max-width: 650px;
      font-family: -apple-system,".SFNSText-Regular","San Francisco","Roboto","Segoe UI","Helvetica Neue","Lucida Grande",sans-serif;
    }
    .div-center {
      text-align: center;
      padding-top: 10px;
    }
  </style>
</head>
<body>
  <div class="div-center">
    <img src="{{ asset('img/logo-skkmigas.png') }}" alt="SKK Migas"
         class="img-responsive center-block">
    <h3>Revitalisasi Pelaporan Sumberdaya</h3>
    <hr/>
    <h2>ERROR 404: Page not found</h2>
    <br/>
    <h2>You seems lost&#63;</h2>
    <p><a href="{{ url('/') }}">back to home</a></p>
  </div>
</body>
</html>