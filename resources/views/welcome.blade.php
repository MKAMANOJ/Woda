<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{{ asset('images/palika-logo.png') }}" type="image/x-icon"/>

  <title>{{ config('palika.municipalityName') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <style>
    html, body {
      background-color: #fff;
      color: #000;
      font-family: 'Courier New', sans-serif;
      font-weight: 100;
      height: 100vh;
      margin: 0;
    }

    .full-height {
      height: 100vh;
    }

    .flex-center {
      align-items: center;
      display: flex;
      justify-content: center;
    }

    .position-ref {
      position: relative;
    }

    .top-right {
      position: absolute;
      right: 10px;
      top: 18px;
    }

    .content {
      text-align: center;
    }

    .title {
      font-size: 84px;
    }

    .links > a {
      color: #636b6f;
      padding: 0 25px;
      font-size: 12px;
      font-weight: 600;
      letter-spacing: .1rem;
      text-decoration: none;
      text-transform: uppercase;
    }

    .m-b-md {
      margin-bottom: 30px;
    }

    @media only screen and (max-width: 700px) {
      .title {
        font-size: 50px;
      }
    }

    @media only screen and (max-width: 500px) {
      .title {
        width: 100%;
      }
    }
  </style>
</head>
<body>
<div class="flex-center position-ref full-height">
  @if (Route::has('login'))
    <div class="top-right links">
      @if (Auth::check())
        <a href="{{ url('/administrator') }}">Dashboard</a>
      @else
        <a href="{{ url('administrator/login') }}">Login</a>
      @endif
    </div>
  @endif

  <div class="content">
    <img src="{{ asset('images/palika.png') }}" alt=""/>
    <div class="title m-b-md">
      {{ config('palika.municipalityName') }}
    </div>

    <div class="links">
      Admin Panel of {{ config('palika.municipalityName') }} app.
    </div>
  </div>
</div>
</body>
</html>
