@extends('admin.layouts.admin')

@section('title')
  Email Templates
@endsection

@section('breadcrumbs')
  {!! $breadcrumbs !!}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> Email Templates
          <small class="font-green sbold">List</small>
        </h1>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="caption pull-right">
          <button class="btn btn-sm bold red mt-sweetalert hidden multiDeleteBtn"
                  data-form="deleteAllForm"><i class="fa fa-trash-o"></i> Delete
          </button>
          <a href="{{ route('email-template.create') }}" class="btn btn-sm bold green">
            <i class="fa fa-plus"></i> Add New
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
           width="100%" id="email-template-table">
      <thead>
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Created At</th>
        <th style="text-align: center">Actions</th>
      </tr>
      </thead>
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
    var emailTemplateTable = $('#email-template-table').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      searching: false,
      stateSave: false,
      ajax: {
        url: '{!! route('email-template.getEmailTemplateForDataTable') !!}',
        data: function(d) {
          d.title = $('input[title=title]').val();
        }
      },
      order: [[2, 'asc']],
      columns: [
        {data: 'DT_Row_Index', searchable: false, orderable: false, width: '5%'},
        {data: 'title', name: 'title'},
        {data: 'created_at', name: 'created_at'},
        {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center', width: 12}
      ],
      fnDrawCallback: function() {
        var actionColumn = $(".dt-body-center");
        var btns = actionColumn.last().find('.btn');
        var btncount = (btns.length);
        actionColumn.first().css('min-width', btncount * 40);
      }
    });
  </script>
@endsection
