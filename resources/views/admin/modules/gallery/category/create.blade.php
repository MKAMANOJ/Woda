@extends('admin.layouts.admin')

@section('title')
  Create Gallery Category
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Gallery Category
          <small class="font-green sbold">Create</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::open(['route' => 'gallery.categories.store', 'method' => 'post']) !!}
    @include('admin.modules.gallery.category.partials.form', ['formAction' => 'Save', 'readAction' => false])
    {!! Form::close() !!}
  </div>
@endsection
