@include('admin.layouts.header')
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
@include('admin.layouts.sidebar')
<!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
      <div class="page-bar">
        @yield('breadcrumbs')
      </div>
      <!-- END PAGE BAR -->
      <!-- BEGIN PAGE TITLE-->
      <div class="row">
        <div class="col-md-12">
          <div class="portlet light">
            @include('flash::message')
            @if($errors->any())
              <div class="alert alert-dismissable alert-danger ">There seems validation error on your submission, Please
                check the form below.
              </div>
            @endif
            @yield('content')
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
  <div class="page-footer-inner">{{ date('Y') }} &copy; {{ config('palika.municipalityName') }}
  </div>
  <div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
  </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN CORE PLUGINS -->
<script src="{{ asset('admin/metronic/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/metronic/global/plugins/bootstrap/js/bootstrap.min.js') }}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script
    src="{{ asset('admin/metronic/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js') }}"
    type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{ asset('admin/metronic/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<script src="{{ asset('admin/metronic/pages/scripts/components-date-time-pickers.min.js') }}"
        type="text/javascript"></script>

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{ asset('admin/metronic/layouts/layout/scripts/layout.min.js') }}" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<!-- DataTables -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.4.2/vue.min.js"></script>
<script src="{{ asset('admin/metronic/global/scripts/datatable.js') }}"></script>
<script src="{{ asset('admin/metronic/global/plugins/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('admin/metronic/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}"
        type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('admin/js/labelError.js') }}"></script>
<!-- end DataTables -->
@yield('script')
<script>
  $(function() {
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')}
    });
  });
</script>
<script type="text/javascript">
  if (typeof (CKEDITOR) !== "undefined") {
    $('.ckeditor').each(function() {
      CKEDITOR.replace(this.id, {
        customConfig: '/admin/js/ckeditor.config.js'
      });
    });
  }
  CKEDITOR.config.extraPlugins = "slideshow";
  $("input,textarea,select").focus(function(){
    $(this).next('div').remove();
    $(this).parent('div').removeClass('has-error')
  });
</script>
</body>
</html>
