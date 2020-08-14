@extends('admin.layouts.admin')

@section('title')
  Edit {{ ucwords($categoryName) }}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ $categoryName }}
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::model($file, ['route' => [$route.'.update',$file->id], 'method' => 'patch',  'files' => true]) !!}
    @include('admin.modules.file.file.partials.form', ['formAction' => 'Update', 'readAction' => true])
    {!! Form::close() !!}
  </div>
@endsection
