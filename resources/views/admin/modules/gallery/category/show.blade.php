@extends('admin.layouts.admin')

@section('style')
  @parent
  <link rel="stylesheet" href="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.css') }}"/>
  <style>
    div.gallery {
      border: 1px solid #ccc;
      height: 100%;
    }

    div.gallery:hover {
      border: 1px solid #777;
    }

    div.gallery img {
      width: 100%;
      height: auto;
    }

    div.gallery-image{
      height: 78%;
    }

    div.desc {
      height: 22%;
      padding: 15px;
      text-align: left;
    }

    .btn {
      border-radius: 3px !important;
      margin-left: 2px;
      padding: 3px 8px;
    }

    * {
      box-sizing: border-box;
    }

    .responsive {
      padding: 0 6px;
      float: left;
      width: 24.99999%;
    }

    @media only screen and (max-width: 700px) {
      .responsive {
        width: 49.99999%;
        margin: 6px 0;
      }
    }

    @media only screen and (max-width: 500px) {
      .responsive {
        width: 100%;
      }
    }

    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
@endsection

@section('title')
  Gallery | Images
@endsection

@section('content')
  <div class="portlet-title">
    <div class="row">
      <div class="col-xs-6 col-sm-6 col-md-6">
        <h1 class="page-title font-green sbold">
          <i class="fa fa-television font-green"></i> {{ ucwords($category->name) }}
          <small class="font-green sbold">Images Gallery</small>
        </h1>
      </div>
    </div>
  </div>
  <div class="portlet-body">
    @forelse($category->images as $image)
      <div class="responsive">
        <div class="gallery">
         <div class="gallery-image">
           <a target="_blank" href="{{  asset('storage/'.$image->name) }}">
             <img src='{{  asset('storage/'.getThumbnailPath($image->name)) }}' alt="{{ $image->title }}">
           </a>
         </div>
          <div class="desc">
            {{ $image->title ? str_limit($image->title, 20) : 'No title.' }}
            <div class="pull-right">

              {!! Form::open(['route' => ['gallery-image.destroy', $image->id], 'method' => 'DELETE', 'class' => 'form-edit-button']) !!}
              <button
                  class="pull-right btn btn-sm red filter-submit margin-bottom mt-sweetalert" title="Delete"
              >
                <i class="fa fa-trash-o"></i>
              </button>
              {!! Form::close() !!}

              <a href="{{ route('gallery-image.edit', $image->id) }}" type="button" title="Edit"
                 class="pull-right btn btn-info btn-sm">
                <i class="fa fa-edit" style="color: #fff"></i>
              </a>

            </div>
          </div>

        </div>
      </div>
    @empty
      <div class="text-center">
        <h2>No Images Available.</h2>
      </div>
    @endforelse
    <div class="clearfix"></div>
  </div>
@endsection

@section('script')
  @parent
  <script src="{{ asset('admin/metronic/global/plugins/bootstrap-sweetalert/sweetalert.min.js') }}"
          type="text/javascript"></script>
  <script src="{{ asset('admin/js/script.js') }}"
          type="text/javascript"></script>
@endsection

