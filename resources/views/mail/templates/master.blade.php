<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="shortcut icon" href="{{ asset('images/palika-logo.png') }}" type="image/x-icon"/>
<title></title>
<style type="text/css">body {
    padding: 0;
    margin: 0;
    font-family: Helvetica, sans-serif;
  }

  table[class="header"] {
    height: 60px;
    background: #323d45;
    padding: 15px 40px;
  }

  td[class="header-title"] {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    text-align: right;
  }

  td[class="content"] {
    background: #fff;
    padding: 20px;
  }

  table[class="content-holder"] {
    background: #f7f7f7;
    margin: 0 auto;
    padding: 10px;
  }

  td[class="icon"] {
    text-align: right;
  }

  td[class="header-name"] {
    padding: 30px 0 0 50px;
  }

  td[class="footer"] {
    background: #f7f7f7;
    height: 60px;
    border-top: 1px solid #dcdcdc;
    padding: 0 20px;
  }
</style>

@yield('mail-css')

@yield('content')