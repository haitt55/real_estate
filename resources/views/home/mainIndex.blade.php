@extends('layouts.master')
@section('title') {{$mainProject->page_title ? 'ggag' : ''}}
@stop @section('description') {{$mainProject->meta_description}} @stop
@section('content')
<style type="text/css">
        p {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}
    </style>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>

	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">

		@if($mainProject->project_image_ads != null)
			<div class="item active">
				<img id="image_ads_01"
					 style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
					 src="../{{$mainProject->project_image_ads}}" alt="" width="660"
					 height="345">
			</div>
		@endif @if($mainProject->project_image_ads1 != null)
			@if($mainProject->project_image_ads != null)
				<div class="item">
					<img id="image_ads_02"
						 style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
						 src="../{{$mainProject->project_image_ads1}}" alt="" width="660"
						 height="345">
				</div>
			@else
				<div class="item active">
					<img id="image_ads_02"
						 style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
						 src="../{{$mainProject->project_image_ads1}}" alt="" width="660"
						 height="345">
				</div>
		@endif @endif

	<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button"
		   data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
									aria-hidden="true"></span> <span class="sr-only">Previous</span>
		</a> <a class="right carousel-control" href="#myCarousel"
				role="button" data-slide="next"> <span
					class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>
<header class="entry-header" style="margin-top: 20px;">
	<h1 class="entry-title" id="projectName">{{$mainProject->project_name}}</h1>
</header>
{!!html_entity_decode($mainProject->description)!!}
@endsection
