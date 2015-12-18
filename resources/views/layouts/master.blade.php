<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport"
        content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

  <title>Revitalisasi Pelaporan Sumberdaya | SKK Migas</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
  <style type="text/css">
  body {
    background-color : #fff;
  }
  .ui.menu .item img.logo {
    margin-right: 1.5em;
  }
  .main.container {
    margin-top: 7em;
  }
  .wireframe {
    margin-top: 2em;
  }
  .ui.footer.segment {
    margin: 5em 0em 0em;
    padding: 5em 0em;
  }
  </style>
  @yield('css')
</head>

<body>
  <div class="ui fixed menu">
    <div class="ui container">
      <a href="#" class="header item">
        <img class="logo" src="{{ asset('img/logo-skkmigas.png') }}">
        WKNAME
      </a>
      <div class="ui simple dropdown item">
        Resources <i class="dropdown icon"></i>
        <div class="menu">
          <a class="item" href="#">Play</a>
          <a class="item" href="#">Lead</a>
          <a class="item" href="#">Drillable</a>
          <a class="item" href="#">Postdrill</a>
          <a class="item" href="#">Discovery</a>
          <a class="item" href="#">Well Postdrill</a>
          <a class="item" href="#">Well Discovery</a>
        </div>
        <a href="#" class="item">Summary</a>
        <a href="#" class="item">Upload</a>
      </div>
    </div>
  </div>

  <div class="ui main container">
    <h1 class="ui header">The Page of Administrator</h1>
  </div>

  <div class="ui inverted vertical footer segment">
    <div class="ui center aligned container">
      <img src="{{ asset('img/logo-skkmigas.png') }}" class="ui centered mini image">
      <div class="ui horizontal inverted small divided link list">
        <a class="item" href="#">Contact Us</a>
        <a class="item" href="#">Terms and Conditions</a>
        <a class="item" href="#">Privacy Policy</a>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/semantic.min.js') }}"></script>
  @yield('js')
</body>
</html>