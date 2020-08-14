@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h3>@lang('data.gallery') : {{ $gallery->name }}</h3>
      <i class="fa fa-file-image-o"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <div class="row" id="galleries">

        @forelse($gallery->images as $image)
          <div class="col-md-4">
            <div class="single-image">
                <a class="image-gallery" href="../storage/{{ $image->name }}">
                  <img src="../storage/{{ $image->name }}">
                </a>
            </div>
          </div>
        @empty
          <span>No Image Added</span>
        @endforelse

      </div>
    </div>
  </div>
@endsection

@section('frontend-script')
  <script>
    $(document).ready(function() {
      $("#galleries").lightGallery({
        share: false,
        actualSize: false,
        selector: '.image-gallery'
      }); 
    });
  </script>
@endsection
