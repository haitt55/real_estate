@extends('layouts.master')
@section('title')
    {{$position->title}}
@stop

@section('description')
    {{$position->meta_description}}
@stop
@section('content')
@if($position->id == null)
	
	<span style="color: #4c5fcb;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Không có bài viết về vị trí</span>
@else 
<header class="entry-header">
	<h1 class="entry-title">{{$position->title}}</h1>
</header>
{!!html_entity_decode($position->content)!!}
@endif
@endsection