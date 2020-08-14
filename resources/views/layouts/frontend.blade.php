<!DOCTYPE html>
  <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>
        <link rel="stylesheet" href="{{ asset('web-template/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/lightgallery.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/lg-transitions.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/toastr.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('web-template/css/custom.css') }}">
        @yield('frontend-css')
    </head>
    <body>
    
    <div class="container">
      <div class="col-md-12">
        <header id="header" class="clearfix">
          <div class="row">
            <div class="col-md-2 col-sm-3">
              <div class="logo"> 
                <a href="https://www.dotm.gov.np/en">
                  <img src="{{ asset('web-template/images/logo.png') }}">
                </a>
              </div>
            </div>
            <div class="col-md-2 col-sm-3 hidden-xs pull-right">
              <div class="flag"> <img src="{{ asset('web-template/images/nepal.gif') }}"> </div>
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12">
              <div class="site-title text-center">
                <h4>@lang('data.org')</h4>
                <h2>@lang('data.org_name')</h2>
                <h4>@lang('data.org_place')</h4>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="date">
              <iframe scrolling="no" border="0" frameborder="0" marginwidth="0" marginheight="0" allowtransparency="true" src="https://www.ashesh.com.np/linknepali-time.php?time_only=no&font_color=ffffff&aj_time=yes&font_size=14&line_brake=1&api=221279i187" width="195" height="45"></iframe>
            </div>
              
            <div class="lang-btn">
              <a class="btn btn-default btn-sm" id="nepali-btn" href="{{ route('np') }}">नेपाली</a>
              <a class="btn btn-default btn-sm" id="english-btn" href="{{ route('en') }}">English</a>
            </div>
          </div>
        </header>

        @include('frontend.partials.navbar')

        @if( Route::currentRouteName() == 'frontend.home')
          <div class="panel headline">
            <div class="panel-body">
              <marquee onmouseover="this.stop()" onmouseout="this.start()" direction="left" behavior="scroll">
                <h4><i class="fa fa-star-o"></i>  Welcome to website of Pokhara Lekhnath Ward 2</h4>
              </marquee>
            </div>
          </div>
        @endif

        <div class="row">
          <div class="col-md-8">
            @yield('content')
          </div>
          <div class="col-md-4 col-xs-12">
            @if( Route::currentRouteName() == 'frontend.home')
              <div class="member-panel">
                @forelse($staffs as $staff)
                  <div class="panel panel-default">
                    <div class="panel-body member">
                      <img src="storage/{{ $staff->image }}" alt=""  class="image""/>
                        @if(session()->get('checkLanguages') == 'en')
                          <h4>{{ $staff->name }}</h4>
                        @else
                          <h4>{{ $staff->nepali_name }}</h4>
                        @endif
                        <h5>{{ $staff->designation }}</h5>
                        <h5>{{ $staff->personal_phone }}</h5>
                        <h5>{{ $staff->email }}</h5>
                    </div>
                  </div>
                @empty 
                  No member added yet
                @endforelse
              </div>
            @endif

            <div class="panel panel-default notice-panel">
              <div class="panel-heading text-center news-panel-heading">
                <h2>@lang('data.notice')</h2>
                <i class="fa fa-bell"></i>
              </div>
              <div class="panel-body news-panel-body">
                @forelse($news as $newsItem)
                  <li>
                    <a href="">{{ $newsItem->title}}</a>
                  </li>
                @empty
                  <span>No Item Added</span>
                @endforelse
                  <hr>
                  <div class="text-center">
                    <a href=""> >> See More</a>
                  </div>
              </div>
            </div>

            @if( Route::currentRouteName() == 'frontend.home')
              <div class="panel panel-default notice-panel">
                <div class="panel-heading text-center vehicle-routine-panel-heading">
                  <h2>@lang('data.bus_routine')</h2>
                  <i class="fa fa-list"></i>
                </div>
                <div class="panel-body vehicle-routine">
                  <li>
                      <span class="day-of-week">Sunday</span> 
                      <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->sunday }} 
                      </span>
                  </li>
                  <hr>

                  <li>
                      <span class="day-of-week">Monday</span> 
                      <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->monday }} 
                      </span>
                  </li>
                  <hr>

                  <li>
                      <span class="day-of-week">Tuesday</span> 
                      <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->tuesday }}  
                      </span>
                  </li>
                  <hr>

                  <li>
                      <span class="day-of-week">Wednesday</span> 
                      <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->wednesday }} 
                      </span>
                  </li>
                  <hr>

                  <li>
                    <span class="day-of-week">Thursday</span> 
                    <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->thursday }} 
                    </span>
                  </li>
                  <hr>

                  <li>
                    <span class="day-of-week">Friday</span> 
                    <span>
                        <i class="fa fa-angle-double-right"></i>
                        {{ $wasteBusRoutine->friday }} 
                    </span>
                  </li>
                  <hr>

                  <li>
                    <span class="day-of-week">Saturday</span> 
                    <span>
                      <i class="fa fa-angle-double-right"></i>
                      {{ $wasteBusRoutine->saturday }} 
                    </span>
                  </li>
                  <hr>
                </div>
              </div>
            @endif

            @if( Route::currentRouteName() == 'frontend.contact-us')
              @isset($contactUs->map_embedded_link)
                <div class="google-map">
                  {!! $contactUs->map_embedded_link !!}
                </div><br>
              @endisset
            @endif
          </div>
        </div>

        @include('frontend.partials.footer')
        
      </div>    
    </div> 

    <script src="{{ asset('web-template/js/jquery.min.js') }}"></script>
    <script src="{{ asset('web-template/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('web-template/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web-template/js/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <script src="{{ asset('web-template/js/lightgallery-all.js') }}"></script>
    <script src="{{ asset('web-template/js/main.js') }}"></script>
    <script src="{{ asset('web-template/js/toastr.js') }}"></script>
    <script >
      $(document).ready(function(){
        @if(session()->has('checkLanguages'))
          @if(session()->get('checkLanguages') == 'en')
            $('#nepali-btn').attr("disabled", false);
            $('#english-btn').attr("disabled", true);
          @else
            $('#nepali-btn').attr("disabled", true);
          @endif
        @else
          $('#nepali-btn').attr("disabled", true);
        @endif
      });
    </script>
    <script>
            $(document).ready(function(){
                @if(Session::has('message'))
                    var type = "{{ Session::get('alert-type', 'info') }}";
                    switch(type){
                        case 'success':
                            toastr.success("{{ Session::get('message') }}");
                            break;
                            
                        case 'info':
                            toastr.info("{{ Session::get('message') }}");
                            break;

                        case 'warning':
                            toastr.warning("{{ Session::get('message') }}");
                            break;

                        case 'error':
                            toastr.error("{{ Session::get('message') }}");
                            break;
                    }
                @endif
            });
    </script>
    @yield('frontend-script')
  </body>
</html>
