@extends('layouts.master')
@section('title')
    {{$pricePolicy->title}}
@stop

@section('description')
    {{$pricePolicy->meta_description}}
@stop
@section('content')
<script type="text/javascript">
	jQuery(document).ready(function () {
	$(".sidebar").hide();
	});
	var nav = '<li id="menu-item-position" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-position"><a href="">Vị trí</a></li>'
	    +'<li id="menu-item-ground" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-ground"><a href="">Mặt bằng</a></li>'
	    +'<li id="menu-item-utility" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-utility"><a href="">Tiện ích</a></li>'
	    +'<li id="menu-item-pricePolicy" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-pricePolicy"><a href="">Giá bán &#8211; Chính Sách</a></li>';
	    		$(".menu-main-menu-container").css("max-width", "1550px !important");
	    		$(".menu-item-new").find( "a" ).hide();
				$(".menu-item-tiendo").find( "a" ).hide();
				$("#menu-item-sale").find( "a" ).text('{{$project->project_name}}');
				$("#menu-item-sale").after(nav);
				
	    var BASEURL = window.location.pathname;
		var id = BASEURL.split("/")[1];
		if('{{$project->position_slug}}' != ''){
			$(".menu-item-position").find( "a" ).attr("href", "/"+id+"/position/" + '{{$project->position_slug}}');
		} else {
			$(".menu-item-position").find( "a" ).attr("href", "/"+id+"/position/default");	
		}
		if('{{$project->ground_slug}}' != ''){
			$(".menu-item-ground").find( "a" ).attr("href", "/"+id+"/ground/" + '{{$project->ground_slug}}');
		} else {
			$(".menu-item-ground").find( "a" ).attr("href", "/"+id+"/ground/default");	
			}
		if('{{$project->utility_slug}}' != ''){
			$(".menu-item-utility").find( "a" ).attr("href", "/"+id+"/utility/" + '{{$project->utility_slug}}');
		} else {
			$(".menu-item-utility").find( "a" ).attr("href", "/"+id+"/utility/default");	
			}
		if('{{$project->pricePolicy_slug}}' != ''){
			$(".menu-item-pricePolicy").find( "a" ).attr("href", "/"+id+"/pricePolicy/" + '{{$project->pricePolicy_slug}}');
		} else {
			$(".menu-item-pricePolicy").find( "a" ).attr("href", "/"+id+"/pricePolicy/default");	
			}
</script>
@if($pricePolicy->id == null)
	
	<span style="color: #4c5fcb;font-weight: bold;padding-left: 28px !important;padding: 10px 0px;">Không có bài viết về Giá bán và chính sách</span>
@else 
<header class="entry-header">
	<h1 class="entry-title">{{$pricePolicy->title}}</h1>
</header>
{!!html_entity_decode($pricePolicy->content)!!}
	
@endif
@endsection