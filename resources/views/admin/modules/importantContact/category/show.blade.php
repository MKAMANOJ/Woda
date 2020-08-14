@extends('admin.layouts.admin')

@section('title')
  Important Contacts | {{ $category->name }}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ ucwords($category->name) }}
          <small class="font-green sbold">Contacts List</small>
        </h1>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="caption pull-right">
          <a href="{{ route('important-contact.create', ['category' => $category->id]) }}" class="btn btn-sm bold green">
            <i class="fa fa-plus"></i> Add New Contact
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
           width="100%" id="important-contact-table">
      <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th style="text-align: center">Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($category->importantContacts as $contact)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ ucwords($contact->name) }}</td>
          <td>
            <a
                href="{{ route('important-contact.edit', $contact->id)  }}"
                class="btn btn-sm blue btn-outline filter-submit margin-bottom"
                style="width: 35px;" title="Edit"
            >
              <i class="fa fa-edit"></i>
            </a>
            {!! Form::open(['route' => ['important-contact.destroy', $contact->id], 'method' => 'DELETE', 'class' => 'form-edit-button']) !!}
            <button
                class="btn btn-sm red btn-outline filter-submit margin-bottom mt-sweetalert"
                style="width: 35px; margin-left: 1px;" title="Delete"
            >
              <i class="fa fa-trash-o"></i>
            </button>
            {!! Form::close() !!}
          </td>
        </tr>
      @endforeach
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
  <script type="application/javascript">
    var contactTable = $('#important-contact-table').DataTable({
      processing: true,
      serverSide: false,
      autoWidth: false,
      searching: true,
      stateSave: false,
    });
  </script>
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"/>
@endsection
