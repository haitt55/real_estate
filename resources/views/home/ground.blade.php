@extends('layouts.master')
@section('title')
    {{$ground->title}}
@stop

@section('description')
    {{$ground->meta_description}}
@stop
@section('content')
@if($ground->id == null)
	
	<span style="color: #4c5fcb;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Không có bài viết về vị trí</span>
@else 
<header class="entry-header">
							<h1 class="entry-title">{{$ground->title}}</h1>
						</header>
{!!html_entity_decode($ground->content)!!}
@endif
@endsection