@extends('admin.layouts.admin')
@section('title')
  Welcome to Admin Page
@endsection

@section('breadcrumbs')
  {!! $breadcrumbs !!}
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-mobile font-green"></i> Dashboard
          <small class="font-green sbold">Manage your app.</small>
        </h1>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('admin/metronic/global/plugins/amcharts/amcharts/amcharts.js') }}"
          type="text/javascript"></script>
  <script src="{{ asset('admin/metronic/global/plugins/amcharts/amcharts/serial.js') }}"
          type="text/javascript"></script>
  <script src="{{ asset('admin/metronic/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>

  <script src="{{ asset('admin/metronic/global/plugins/amcharts/amcharts/themes/light.js') }}"
          type="text/javascript"></script>
  <script>
    $('#user-tbl').DataTable();
  </script>
  <script type="text/javascript">
    var revenueChart = AmCharts.makeChart("revenueChartDiv", {
      "type": "serial",
      "theme": "light",
      "dataProvider": <?php echo json_encode($revenueChart) ?>,
      "valueAxes": [{
        "gridColor": "#FFFFFF",
        "gridAlpha": 0.2,
        "dashLength": 0
      }],
      "gridAboveGraphs": true,
      "startDuration": 1,
      "graphs": [{
        "balloonText": "[[category]]: <b>[[value]]</b>",
        "fillAlphas": 0.8,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "data"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "date",
      "categoryAxis": {
        "gridPosition": "start",
        "gridAlpha": 0,
        "tickPosition": "start",
        "tickLength": 20
      },
      "export": {
        "enabled": true
      }

    });
    var capacityChart = AmCharts.makeChart("capacityChartDiv", {
      "type": "pie",
      "theme": "light",
      "dataProvider": <?php echo json_encode($capacityChart) ?>,
      "titleField": "title",
      "valueField": "value",
      "labelRadius": 5,

      "radius": "42%",
      "innerRadius": "45%",
      "labelText": "[[title]]",
      "export": {
        "enabled": true
      }
    });
  </script>
@endsection

