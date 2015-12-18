<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport"
        content="width=device-width,initial-scale=1.0,maximum-scale=1.0">

  <title>Login Page | Revitalisasi Pelaporan Sumberdaya SKK Migas</title>
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
  <style type="text/css">
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
      margin-bottom: 20px;
    }
    .column {
      max-width: 450px;
    }
  </style>
</head>
<body>
  <div class="ui middle aligned center aligned grid">
    <div class="column">
      <h2 class="ui blue image header">
        <img class="ui centered small image" src="{{ asset('img/logo-skkmigas.png') }}">
        <p>Revitalisasi Pelaporan Sumberdaya</p>
      </h2>
      <form class="ui large form" method="post" action="{{ url('login') }}">
        {!! csrf_field() !!}

        <div class="ui stacked segment">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="User name">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password">
            </div>
          </div>
          <div class="ui fluid large blue submit button">Login</div>
        </div>
        <div class="ui error message"></div>
      </form>
    </div>
  </div>

  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/semantic.min.js') }}"></script>
  <script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            username: {
              identifier: 'username',
              rules: [
                {
                  type: 'empty',
                  prompt: 'Please enter your username'
                },
              ]
            },
            password: {
              identifier: 'password',
              rules: [
                {
                  type: 'empty',
                  prompt: 'Please enter your password'
                }
              ]
            }
          }
        })
      ;
    })
  ;
  </script>
</body>
</html>