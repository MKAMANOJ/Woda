@extends('layouts.frontend')

@section('content')
  <div class="panel panel-default notice-panel">
    <div class="panel-heading text-center">
      <h2>@lang('data.gallery')</h2>
      <i class="fa fa-file-image-o"></i>
    </div>
    <div class="panel-body custom-panel-body">
      <div class="row">
        @forelse($galleries as $gallery )
          <div class="col-md-4">
            <div class="single-gallery">
              <div class="panel panel-default panel-front"> 
                <a href="{{ route('frontend.images', $gallery->id) }}">
                  <div class="panel-heading">
                    <img src="storage/{{ $gallery->images->first()->name }}">
                  </div>
                  <div class="panel-body">
                    <span>{{ $gallery->name }}</span>
                  </div>
                </a>
              </div>    
            </div>
          </div>
        @empty
          <span>No gallery added</span>
        @endforelse               
      </div>
    </div>
  </div>
@endsection
