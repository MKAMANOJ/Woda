<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <title>@yield('title') | {{ config('palika.municipalityName') }}</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link rel="shortcut icon" href="{{ asset('images/palika-logo.png') }}" type="image/x-icon"/>
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/metronic/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/metronic/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <link href="{{ asset('admin/metronic/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin/metronic/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL PLUGINS -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{ asset('admin/metronic/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
  <link href="{{ asset('admin/metronic/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="{{ asset('admin/metronic/global/css/login.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <!-- END THEME LAYOUT STYLES -->
  <!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
  <a href="{{ route('admin.index') }}">
    <img src="" alt="" /> </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
  @yield('content')
</div>
<div class="copyright"> {{ date('Y') }} &copy;  {{ config('palika.municipalityName') }}  </div>
</body>
</html>