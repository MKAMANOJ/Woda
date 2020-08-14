@extends('layouts.frontend')

@section('content')         
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    	@foreach ($slides as $slide)
        	<li data-target="#myCarousel" data-slide-to="{{ $loop->iteration }}" class="{{ $loop->first ? 'active' : '' }}"></li>
        @endforeach
    </ol>

		<div class="carousel-inner carousel-img">
			@foreach ($slides as $key => $slide)
				<div class="item {{ $loop->first ? 'active' : '' }}">
				  <img src="storage/{{ $slide->name }}" alt="Los Angeles" class="img-responsive" style="width:100%;">
				  <div class="carousel-caption">
			        <h3>{{ $slide->title }}</h3>
			        <p>{{ $slide->description }}</p>
			      </div>
				</div>
			@endforeach
		</div>

		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
  </div><br>

	<div class="panel panel-default notice-panel">
		<div class="panel-heading text-center">
			<h2>@lang('data.chairman_message')</h2>
			<i class="fa fa-pencil"></i>
		</div>
  		<div class="panel-body custom-panel-body">
        {!! $home->content !!}
  		</div>
	</div>
@endsection
