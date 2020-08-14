@extends('admin.layouts.admin')

@section('title')
  Edit Gallery Image
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Gallery Image
          <small class="font-green sbold">Edit</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::model($image, ['route' => ['gallery-image.update',$image->id], 'method' => 'patch', 'files' => true]) !!}
    @include('admin.modules.gallery.image.partials.form', ['formAction' => 'Update', 'readAction' => true])
    {!! Form::close() !!}
  </div>
@endsection
