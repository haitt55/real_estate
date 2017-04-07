@extends('layouts.master')

@section('content')
<style type="text/css">
        p {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 100%;
}
    </style>
<header class="entry-header">
	<h1 class="entry-title">Tin Tức</h1>
</header>
@foreach ($news as $new)
      <div class="row">
		<div class="col-sm-4 col-md-3">
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}" class="thumbnail"><img src="{{$new->image_header}}" class="center-block wp-post-image" alt=""  sizes="(max-width: 300px) 100vw, 300px" height="200" width="300"></a>
		</div>
		<div class="col-sm-8 col-md-9">
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}"><h2>{{$new->title}}</h2></a>
			<p id = "abc">{{$new->content}}</p>
			<a href="{{ route('newpost.index', ['slug' => $new->slug]) }}" class="btn btn-info">Xem thêm</a>
		</div>
	</div>
@endforeach

@endsection