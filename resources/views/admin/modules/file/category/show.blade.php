@extends('admin.layouts.admin')

@section('style')
  @parent
  <link rel="stylesheet" href="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"/>
@endsection

@section('title')
  {{  ucwords($categoryName) }}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ ucwords($categoryName) }}
          <small class="font-green sbold">List</small>
        </h1>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="caption pull-right">
          <a href="{{ route(str_slug($categoryName).'.create') }}" class="btn btn-sm bold green">
            <i class="fa fa-plus"></i> Add new {{ ucwords($categoryName) }}
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover dataTable">
      <thead>
      <tr>
        <td>#</td>
        <td>Title</td>
        <td>Actions</td>
      </tr>
      </thead>
      <tbody>
      @forelse($files as $file)
        <tr>
          <td>
            {{ $loop->iteration }}
          </td>
          <td>
            {{ $file->title }}
          </td>
          <td>
            <a href="{{ route(str_slug($categoryName).'.edit', $file->id) }}"
               class="btn btn-sm blue btn-outline filter-submit margin-bottom">
              <i class="fa fa-edit"></i></a>
            {!! Form::open(['route' => [str_slug($categoryName).'.destroy', $file->id], 'method' => 'DELETE', 'class' => 'form-edit-button']) !!}
            <button
                class="btn btn-sm red btn-outline filter-submit margin-bottom mt-sweetalert"
                title="Delete"
            >
              <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
          </td>
        </tr>
      @empty
        <tr>
          <td style="text-align: right;">No data available.</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>
@endsection

@section('script')
  @parent
  <script src="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
          type="text/javascript"></script>
  <script src="{{ asset('admin/js/script.js') }}"
          type="text/javascript"></script>
@endsection

