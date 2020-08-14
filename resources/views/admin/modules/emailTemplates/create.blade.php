@extends('admin.layouts.admin')

@section('title')
  Create Email Template
@endsection

@section('breadcrumbs')
  {!! $breadcrumbs !!}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Email Template
          <small class="font-green sbold">Create</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::open(['route' => 'email-template.store', 'method' => 'post']) !!}
    @include('admin.modules.emailTemplates.partials.form', ['formAction' => 'Save', 'readAction' => false])
    {!! Form::close() !!}
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    let name = "<?php echo (old('title')) ? old('title') : '';?>";
  </script>
@endsection
