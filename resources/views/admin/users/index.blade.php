@extends('admin.layouts.admin')
@section('title')
  Users
@endsection

@section('breadcrumbs')
  {!! $breadcrumbs !!}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Users
          <small class="font-green sbold">List</small>
        </h1>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="caption pull-right">
          <a href="{{ route('users.create') }}" class="btn btn-sm bold green">
            <i class="fa fa-plus"></i> Add New
          </a>
        </div>
      </div>
    </div>
  </div>
  <table
      class="table table-striped table-bordered table-hover table-checkable order-column dataTable data-table no-footer"
      width="100%">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email Address</th>
      <th width="8%">Status</th>
      <th>Role</th>
      <th style=" min-width: 80px; text-align: center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $user)
      <tr class="odd gradeX">
        <td>{{ $key + 1 }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{!! getStatus($user->active) !!}</td>
        <td>{{ $user->roles->first()->display_name }}</td>
        <td class="dt-body-center">
          <a
              href="{{ route('users.edit', $user->id) }}"
              class="btn btn-sm blue btn-outline filter-submit margin-bottom" title="Edit " style="width: 35px;"
          >
            <i class="fa fa-edit"></i></a>
          {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE' ,'class' => 'form-edit-button']) !!}
          <button
              class="btn btn-sm red btn-outline filter-submit margin-bottom mt-sweetalert" title="Delete"
              style="width:35px;">
            <i class="fa fa-trash-o"></i>
          </button>
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection

@section('script')
  @parent
  <script src="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
          type="text/javascript"></script>
  <script src="{{ asset('admin/js/ui-sweetalert.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('admin/js/script.js') }}" type="text/javascript"></script>
  <script type="application/javascript">
    $(document).on('click', 'button.mt-sweetalert', function(e) {
      e.preventDefault();
      swalDeletePopup('user', $(this));
    });
  </script>
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"/>
@endsection
