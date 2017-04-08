@extends('layouts.master')
@section('title')
    {{$pricePolicy->title}}
@stop

@section('description')
    {{$pricePolicy->meta_description}}
@stop
@section('content')
@if($pricePolicy->id == null)
	
	<span style="color: #4c5fcb;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Không có bài viết về vị trí</span>
@else 
<header class="entry-header">
	<h1 class="entry-title">{{$pricePolicy->title}}</h1>
</header>
{!!html_entity_decode($pricePolicy->content)!!}
	<script type="text/javascript">
	jQuery(document).ready(function () {
	$(".sidebar").hide();
	});
</script>
@endif
@endsection