@extends('admin.layouts.admin')

@section('title')
  Create Staff
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Staff
          <small class="font-green sbold">Create</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    {!! Form::open(['route' => 'staff.store', 'method' => 'post', 'files' => true]) !!}
    @include('admin.modules.staff.partials.staffForm', ['formAction' => 'Save', 'readAction' => false])
    {!! Form::close() !!}
  </div>
@endsection
