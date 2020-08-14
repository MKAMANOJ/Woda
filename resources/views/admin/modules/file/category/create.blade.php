@extends('admin.layouts.admin')

@section('title')
  Create File Category
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> File Category
          <small class="font-green sbold">Create</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::open(['route' => 'file.categories.store', 'method' => 'post']) !!}
    @include('admin.modules.file.category.partials.form', ['formAction' => 'Save', 'readAction' => false])
    {!! Form::close() !!}
  </div>
@endsection
