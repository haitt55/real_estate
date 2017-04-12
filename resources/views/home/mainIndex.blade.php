@extends('layouts.master') @section('content')
<style type="text/css">
        p {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}
    </style>
@foreach ($projects as $project)
      <div class="row">
		<div class="col-sm-4 col-md-3">
			<a href="{{ route('home.index', ['id' => $project->id]) }}" class="thumbnail"><img src="{{$project->project_image_header}}" class="center-block wp-post-image" alt=""  sizes="(max-width: 300px) 100vw, 300px" height="200" width="300"></a>
		</div>
		<div class="col-sm-8 col-md-9">
			<a href="{{ route('home.index', ['id' => $project->id]) }}"><h2>{{$project->project_name}}</h2></a>
			<p id = "abc">{!!html_entity_decode($project->description)!!}</p>
			<a href="{{ route('home.index', ['id' => $project->id]) }}" class="btn btn-info">Xem thêm</a>
		</div>
	</div>
@endforeach
{!!html_entity_decode($mainProject->description)!!}

@endsection
