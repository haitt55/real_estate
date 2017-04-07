@extends('layouts.master')

@section('content')
<header class="entry-header">
	<h1 class="entry-title">{{$news->title}}</h1>
</header>
{!!html_entity_decode($news->content)!!}
@foreach ($anotherNew as $new)
<div class="column">
		<div class="col-xs-3 col-sm-3">
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}" class="thumbnail"><img src="{{$new->image_header}}" class="center-block wp-post-image" alt=""  sizes="(max-width: 300px) 100vw, 300px" height="200" width="300"></a>
		</div>
		<div class="col-xs-3 col-sm-3>
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}"><h2>{{$new->title}}</h2></a>
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}" class="btn btn-info">Xem thêm</a>
		</div>
	</div>
@endforeach
@endsection