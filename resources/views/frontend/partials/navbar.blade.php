<nav class="navbar navbar-inverse custom-navbar">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span> 
    </button>
  </div>
  <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="{{Request::is('/') ? 'active' : ''}}">
        <a href="{{ route('frontend.home') }}">@lang('data.home')</a>
      </li>

      <li class="dropdown custom-dropdown 
        {{Request::is('about') ? 'active' : ''}} | 
        {{Request::is('oraganizational_chart') ? 'active' : ''}} |
        {{Request::is('file/staff') ? 'active' : ''}} |
        {{Request::is('file/tax-fee') ? 'active' : ''}} |
        {{Request::is('file/law-regulation') ? 'active' : ''}}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('data.about_us')
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="{{Request::is('about') ? 'active' : ''}}">
            <a href="{{ route('frontend.about') }}">@lang('data.brief_intro')</a>
          </li>
          <li class="{{Request::is('oraganizational_chart') ? 'active' : ''}}">
            <a href="{{ route('frontend.oraganizational_chart') }}">@lang('data.org_chart')</a>
          </li>
          <li class="{{Request::is('staff') ? 'active' : ''}}">
            <a href="{{ route('frontend.staff') }}">@lang('data.staff')</a>
          </li>
          <li class="{{Request::is('file/tax-fee') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'tax-fee') }}">@lang('data.tax-fee')</a>
          </li>
          <li class="{{Request::is('file/law-regulation') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'law-regulation') }}">@lang('data.law-regulation')</a>
          </li>
        </ul>
      </li>

      <li class="dropdown custom-dropdown
        {{Request::is('file/law-regulation') ? 'active' : ''}} | 
        {{Request::is('file/plan-project') ? 'active' : ''}} |
        {{Request::is('file/report') ? 'active' : ''}} |
        {{Request::is('file/public-procurement') ? 'active' : ''}}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">@lang('data.program-project')
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="{{Request::is('file/law-regulation') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'budget-program') }}">@lang('data.budget-program')</a>
          </li>
          <li class="{{Request::is('file/plan-project') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'plan-project') }}">@lang('data.plan-project')</a>
          </li>
          <li class="{{Request::is('file/report') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'report') }}">@lang('data.report')</a>
          </li>
          <li class="{{Request::is('file/public-procurement') ? 'active' : ''}}">
            <a href="{{ route('frontend.file', 'public-procurement') }}">@lang('data.public-procurement')</a>
          </li>
        </ul>
      </li>

      <li class="{{Request::is('downloads') ? 'active' : ''}}">
        <a href="{{ route('frontend.download') }}">@lang('data.downloads')</a>
      </li>

      <li class="{{Request::is('file/notice-information') ? 'active' : ''}}">
        <a href="{{ route('frontend.file', 'notice-information') }}">@lang('data.notice-information')</a>
      </li> 

      <li class="{{Request::is('gallery*') ? 'active' : ''}}">
        <a href="{{ route('frontend.gallery') }}">@lang('data.gallery')</a>
      </li> 

      <li class="{{Request::is('contact-us') ? 'active' : ''}}">
        <a href="{{ route('frontend.contact-us') }}">@lang('data.contact-us')</a>
      </li> 
    </ul>
  </div>
</nav>