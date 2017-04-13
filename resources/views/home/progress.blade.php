@extends('layouts.master')

@section('content')
@if($progress->id == null)
	
	<span style="color: #4c5fcb;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Không có bài viết về Tiến độ</span>
@else 
<header class="entry-header">
							<h1 class="entry-title">{{$progress->title}}</h1>
						</header>
{!!html_entity_decode($progress->content)!!}
@endif
@endsection