@extends('admin.layouts.admin')

@section('title')
  Create Push Notification
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Send Notification
          <small class="font-green sbold">Create</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::open(['route' => 'push-notification.store', 'method' => 'post']) !!}
    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('title') ? 'has-error' :'' }}">
          {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder'=>'Title']) !!}
          @if($errors->first('title'))
            <div class="ui pointing red basic label"> {{$errors->first('title')}}</div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
          {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
          {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder'=>'Description...']) !!}
          @if($errors->first('description'))
            <div class="ui pointing red basic label"> {{$errors->first('description')}}</div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('message') ? 'has-error' :'' }}">
          {!! Form::label('message', 'Write Message', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {{ Form::textarea('message', null, ['class' => 'form-control ckeditor', 'placeholder' => 'Message....']) }}
          @if($errors->first('message'))
            <div class="ui pointing red basic label"> {{$errors->first('message')}}</div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Create
          </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset('admin/metronic/global/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('admin/js/script.js') }}"
          type="text/javascript"></script>
@endsection
