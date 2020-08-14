@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h3>{{ $file->title }}</h3>
      <i class="fa fa-list"></i>
    </div>
    <div class="panel-body custom-panel-body">
      {!! $file->content !!}
    </div>
  </div>
@endsection
