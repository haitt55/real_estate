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

@foreach ($news as $new)
      <div class="row">
		<div class="col-sm-4 col-md-3">
			<a href="/home/newpost/{{$new->slug}}" class="thumbnail"><img src="http://duancocobay.net/wp-content/uploads/2017/03/img20170307095615894-300x200.jpg" class="center-block wp-post-image" alt="" srcset="http://duancocobay.net/wp-content/uploads/2017/03/img20170307095615894-300x200.jpg 300w, http://duancocobay.net/wp-content/uploads/2017/03/img20170307095615894.jpg 640w" sizes="(max-width: 300px) 100vw, 300px" height="200" width="300"></a>
		</div>
		<div class="col-sm-8 col-md-9">
			<a href="/home/newpost/{{$new->slug}}"><h2>{{$new->title}}</h2></a>
			<p id = "abc">{{$new->content}}</p>
			<a href="/home/newpost/{{$new->slug}}" class="btn btn-info">Xem thêm</a>
		</div>
	</div>
@endforeach

@endsection