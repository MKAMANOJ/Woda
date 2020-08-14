@extends('layouts.frontend')

@section('frontend-css')
  <style>
    table {
      width: 700px !important;
    }
  </style>
@endsection

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.brief_intro')</h2>
      <i class="fa fa-list"></i>
    </div>
    <div class="panel-body custom-panel-body">
      {!! $introduction->content !!}
    </div>
  </div>
@endsection
