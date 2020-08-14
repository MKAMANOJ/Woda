@extends('admin.layouts.admin')

@section('title')
  Important Website Links
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-4">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i>Important
          <small class="font-green sbold">Website Link List</small>
        </h1>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-8">
        <div class="caption pull-right">
          <a href="{{ route('website-links.create') }}" class="btn btn-sm bold green">
          <i class="fa fa-plus"></i>Website Link
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="portlet-body">
    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer"
           width="100%" id="file-category-table">
      <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Website Link</th>
        <th>Order</th>
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
    var categoryTable = $('#file-category-table').DataTable({
      processing: true,
      serverSide: true,
      autoWidth: false,
      searching: false,
      stateSave: false,
      ajax: {
        url: '{!! route('website-links.getAllWebsiteLinks') !!}'
      },
      order: [[2, 'asc']],
      columns: [
        {data: 'DT_Row_Index', searchable: false, orderable: false, width: '5%'},
        {data: 'name', name: 'name'},
        {data: 'website_link', name: 'website_link'},
        {data: 'order', name: 'order'},
        {data: 'action', 'name': 'action', searchable: false, orderable: false, className: 'dt-body-center', width: 12}
      ],
      fnDrawCallback: function() {
        var actionColumn = $(".dt-body-center");
        var btns = actionColumn.last().find('.btn');
        var btncount = (btns.length);
        actionColumn.first().css('min-width', btncount * 100);
      }
    });
  </script>
@endsection

@section('style')
  <link rel="stylesheet" href="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"/>
@endsection
