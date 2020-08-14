@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.org_chart')</h2>
      <i class="fa fa-area-chart"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <div id="organizational-chart">
        <a href="storage/{{ $orgChart->name }}">
            <img src="storage/{{ $orgChart->name }}" width="710px" height="440px">
        </a>
      </div>
    </div>
  </div>
@endsection

@section('frontend-script')
  <script>
    $(document).ready(function() {
      $("#organizational-chart").lightGallery({
        share: false,
        actualSize: false
      }); 
    });
  </script>
@endsection
