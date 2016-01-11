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
      background-color: #f7f7f7;
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
    .page-title {
      margin-bottom: 40px;
    }
    label {
      font-weight: normal !important;
    }
    .form-group .control-label.required {
      font-weight: bold !important;
    }
    .form-group .control-label.required:after {
      content: "*";
      color: red;
    }
    .card-main {
      font-size: 40px;
      text-align: center;
      padding: 2px 1px 2px 1px;
      margin: 2px 1px 2px 1px;
    }
    .card-center {
      text-align: center;
      padding: 5px 10px 5px 10px;
    }
  </style>
  @stack('css')
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
          <strong>
            <a class="navbar-brand" href="{{ url('/') }}">{{ createNavTitle(request()->user()->working_area_id) }}</a>
          </strong>
        @elseif (request()->user()->role === 'administrator')
          <strong>
            <a class="navbar-brand" href="{{ url('/') }}">Administrator</a>
          </strong>
        @elseif (request()->user()->role === 'developer')
          <strong>
            <a class="navbar-brand" href="{{ url('/') }}">Dev.</a>
          </strong>
        @endif
      </div>

      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">

          @if (request()->user()->role === 'contractor')
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                 role="button" aria-haspopup="true" aria-expanded="false">
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
            <li><a href="#">Summary</a></li>
            <li><a href="#">Upload</a></li>
            <li><a href="#">Documentation</a></li>
          @endif

          @if (request()->user()->role === 'administrator' || request()->user()->role === 'developer')
            <li><a href="{{ url('resources') }}">Resources</a></li>
            <li><a href="{{ url('account') }}">Account</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                 role="button" aria-haspopup="true" aria-expanded="false">
                System <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('system/year') }}">RPS Year</a></li>
              </ul>
            </li>
          @endif

          @if (request()->user()->role === 'developer')
            <li><a href="{{ url('database') }}">Database</a></li>
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
      </p>
    </div>
  </footer>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  @stack('js')

  <script>
    $(document).ready(function() {
      @stack('jsready')
    });
  </script>
</body>
</html>