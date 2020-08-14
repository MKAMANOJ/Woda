@extends('admin.layouts.admin')

@section('title')
  Edit {{ $introductionType }}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ $introductionType }}
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    @if(isset($introduction))
      {!! Form::model($introduction, ['method' => 'patch', 'route' => 'introduction.update']) !!}
    @else 
      {!! Form::model(null, ['method' => 'patch', 'route' => 'introduction.update']) !!}
    @endif
    <div class="row">
      <div class="col-md-12">
        <div class="form-group {{ $errors->has('content') ? 'has-error' :'' }}">
          {!! Form::label('content', 'Content', ['class' => 'control-label']) !!}
          <span class="required" aria-required="true"> * </span>
          {!! Form::textarea('content', null, ['class' => 'form-control ckeditor']) !!}
          @if($errors->first('content'))
            <div class="ui pointing red basic label"> {{$errors->first('content')}}</div>
          @endif
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group pull-right">
          <button class="btn btn-primary green" type="submit"><i class="fa fa-paper-plane"></i>&nbsp;Update
          </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
@endsection

@section('script')
  @parent
  <script type="text/javascript" src="{{ asset('admin/metronic/global/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('admin/js/script.js') }}"
          type="text/javascript"></script>
@endsection
