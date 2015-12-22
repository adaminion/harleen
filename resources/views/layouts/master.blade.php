<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <title>Revitalisasi Pelaporan Sumberdaya</title>

  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
  <style type="text/css">
    html {
      position: relative;
      min-height: 100%;
    }
    body {
      background-color: #ecf0f1;
      margin-top: 60px;
      margin-bottom: 150px;
    }
    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 150px;
      background-color: #fff;
    }
    body > .container {
      padding: 60px 15px 0;
    }
    .container .text-muted {
      margin: 15px 0;
    }
    .footer > .container {
      padding-right: 15px;
      padding-left: 15px;
    }
    .footer > .container > img {
      margin-top: 25px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
  </style>
  @yield('css')
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed"
                data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        @if (request()->user()->role === 'contractor')
          <a class="navbar-brand" href="{{ url('/') }}">Contractor</a>
        @elseif (request()->user()->role === 'administrator')
          <a class="navbar-brand" href="{{ url('/') }}">Administrator</a>
        @elseif (request()->user()->role === 'developer')
          <a class="navbar-brand" href="{{ url('/') }}">Dev.</a>
        @endif
      </div>

      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">

          @if (request()->user()->role === 'contractor')
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                Resources <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('play') }}">Play</a></li>
                <li><a href="{{ url('lead') }}">Lead</a></li>
                <li><a href="{{ url('drillable') }}">Drillable</a></li>
                <li><a href="{{ url('postdrill') }}">Postdrill</a></li>
                <li><a href="{{ url('postdrill') }}">Postdrill Well</a></li>
                <li><a href="{{ url('discovery') }}">Discovery</a></li>
                <li><a href="{{ url('discovery') }}">Discovery Well</a></li>
              </ul>
            </li>
          @elseif (request()->user()->role === 'administrator')
            <li><a href="{{ url('resources') }}">Resources</a></li>
            <li><a href="{{ url('account') }}">Account</a></li>
          @elseif (request()->user()->role === 'developer')
            <li><a href="{{ url('resources') }}">Resources</a></li>
            <li><a href="{{ url('database') }}">Database</a></li>
            <li><a href="{{ url('account') }}">Account</a></li>
          @endif

          <li><a href="{{ url('logout') }}">Logout</a></li>

        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <footer class="footer">
    <div class="container text-center">
      <img src="{{ asset('img/logo-skkmigas.png') }}" class="img-responsive"
           alt="Logo SKK Migas" width="10%">
      <p class="text-muted">
        Copyright &copy; {{ date('Y') }} SKK Migas.
        <a href="#">Site Map</a> &middot;
        <a href="#">Contact Us</a> &middot;
        <a href="#">Terms</a>
      </p>
    </div>
  </footer>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  @yield('js')
</body>
</html>