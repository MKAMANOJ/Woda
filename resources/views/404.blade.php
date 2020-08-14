<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{{ asset('images/palika-logo.png') }}" type="image/x-icon"/>
  <title>404 Page Not Found</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

  <!-- Styles -->
  <style>
    html, body {
      background-color: #fff;
     g
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
  </style>
</head>
<body>
<div class="flex-center position-ref full-height" style="margin-top: -15% !important;">
  <div class="content">
    <div class="title m-b-md">
      <img src="{{ asset('images/palika.png') }}" alt="" style="height: 100px; width: auto;padding-top: 50%; padding-bottom: 20%;"/>
    </div>
    <div style="margin-top: -20%;">
      The page you are trying to look is either broken or does not exist.
    </div>

    <div class="links" style="margin-top: 10%;">
      <a href="{{ route('admin.index') }}">Go Back to Home</a>
    </div>
  </div>
</div>
</body>
</html>
