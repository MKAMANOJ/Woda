@extends('admin.layouts.admin')

@section('title')
  Edit Email Template
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
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::model($emailTemplate, ['route' => ['email-template.update',$emailTemplate->id], 'method' => 'patch']) !!}
    @include('admin.modules.emailTemplates.partials.form', ['formAction' => 'Update', 'readAction' => true])
    {!! Form::close() !!}
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    let name = "<?php echo (old('title')) ? old('title') : $emailTemplate->title;?>";
  </script>
@endsection
