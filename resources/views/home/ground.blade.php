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
<script type="text/javascript">
var nav = '<li id="menu-item-position" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-position"><a href="">Vị trí</a></li>'
	    +'<li id="menu-item-ground" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-ground"><a href="">Mặt bằng</a></li>'
	    +'<li id="menu-item-utility" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-utility"><a href="">Tiện ích</a></li>'
	    +'<li id="menu-item-pricePolicy" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-pricePolicy"><a href="">Giá bán &#8211; Chính Sách</a></li>';
	    		$(".menu-main-menu-container").css("max-width", "1550px !important");
				$("#menu-main-menu").append(nav);
	    var BASEURL = window.location.pathname;
		var id = BASEURL.split("/")[1];
	    $.ajax({
	        url : '{{ route('home.getCurrentProject') }}',
	        type : 'Get',
	        dataType : 'json',
	        data: {id: id},
	        beforeSend: function (xhr) {
	            var token = $('meta[name="csrf_token"]').attr('content');
	            if (token) {
	                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
	            }
	        },
	        success: function(data) {
	            if(data.code == 1){
	            	
	            	$("#image_header").attr("src", "../../" + data.project.project_image_header).css('max-height', '150px').css('width', '50%');
//	             	$(".entry-content").append(data.project.description);
					if(data.project.position_slug != null){
						$(".menu-item-position").find( "a" ).attr("href", "/"+id+"/position/" + data.project.position_slug);
					} else {
						$(".menu-item-position").find( "a" ).attr("href", "/"+id+"/position/default");	
					}
					if(data.project.ground_slug != null){
						$(".menu-item-ground").find( "a" ).attr("href", "/"+id+"/ground/" + data.project.ground_slug);
					} else {
						$(".menu-item-ground").find( "a" ).attr("href", "/"+id+"/ground/default");	
						}
					if(data.project.utility_slug != null){
						$(".menu-item-utility").find( "a" ).attr("href", "/"+id+"/utility/" + data.project.utility_slug);
					} else {
						$(".menu-item-utility").find( "a" ).attr("href", "/"+id+"/utility/default");	
						}
					if(data.project.pricePolicy_slug != null){
						$(".menu-item-pricePolicy").find( "a" ).attr("href", "/"+id+"/pricePolicy/" + data.project.pricePolicy_slug);
					} else {
						$(".menu-item-pricePolicy").find( "a" ).attr("href", "/"+id+"/pricePolicy/default");	
						}
					$(".menu-item-new").find( "a" ).hide();
					$(".menu-item-tiendo").find( "a" ).hide();
					$("#menu-item-sale").find('a').text(data.project.project_name);
					
	            }	
	        },
	        error: function(data) {
	        }
	    });
</script>
@endsection