@extends('layouts.master') @section('title') {{$project->page_title}}
@stop @section('description') {{$project->meta_description}} @stop
@section('images') {{$project->project_image_header}} @stop
@section('content')
<script type="text/javascript">
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
	var id = BASEURL.split("/project/")[1];
    
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
	
			function openCustomerbox() {
			    setTimeout( function() {$('#myModal').css('display', 'block') }, 10000);
			}
			$(document).ready(function() {
				var isshow = localStorage.getItem('isshow');
			    if (isshow== null) {
			        localStorage.setItem('isshow', 1);
					
			        // Show popup here
			        openCustomerbox();
			    }
				
			    
			});
			$("#headerCloseButton").click(function (){
						$("#myModal").css('display', 'none');
			    });
			$("#closeButton").click(function (){
				$("#myModal").css('display', 'none');
			});
			$("#sendButton").click(function (){
				var full_name =$("#full_name").val();
				var email =$("#email").val();
				var phone_number =$("#phone_number").val();
				var message =$("#message").val();
				var project_id = $("#project_id").val();});
				
</script>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>

	</ol>

	<!-- Wrapper for slides -->
	<div class="carousel-inner" role="listbox">

		@if($project->project_image_ads != null)
		<div class="item active">
			<img id="image_ads_01"
				style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
				src="../{{$project->project_image_ads}}" alt="" width="660"
				height="345">
		</div>
		@endif @if($project->project_image_ads1 != null)
		@if($project->project_image_ads != null)
		<div class="item">
			<img id="image_ads_02"
				style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
				src="../{{$project->project_image_ads1}}" alt="" width="660"
				height="345">
		</div>
		@else
		<div class="item active">
			<img id="image_ads_02"
				style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
				src="../{{$project->project_image_ads1}}" alt="" width="660"
				height="345">
		</div>
		@endif @endif

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" role="button"
			data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
			aria-hidden="true"></span> <span class="sr-only">Previous</span>
		</a> <a class="right carousel-control" href="#myCarousel"
			role="button" data-slide="next"> <span
			class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<header class="entry-header">
		<h1 class="entry-title" id="projectName">{{$project->project_name}}</h1>
	</header>
	<p style="text-align: center;">
		<strong>{{$project->page_title}}</strong>
	</p>
	{!!html_entity_decode($project->description)!!}
	
	<div class="modal" id="myModal" role="dialog" style="display: none">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="border-bottom: 0px">
					<button type="button" id="headerCloseButton" class="close"
						data-dismiss="modal">&times;</button>
					<h1 class="modal-title" style="text-align: center; line-height: 1.428571;">LIÊN HỆ</h1>
					<h2 class="modal-title" style="text-align: center; line-height: 1.428571;">Đăng kí nhận thông tin dự án.</h2>
				</div>
				<div class="modal-body">
					<form >
							<div class="form-group" style="margin-left: 20%">
							 <input type="text" name="full_name"
								id="full_name" class="form-control" style="width: 70%;" placeholder="Họ tên"/>
						</div>
						<input id ="project_id" name="project_id" type="hidden" value = "{{$project->projectId}}" >
						<div class="form-group" style="margin-left: 20%">
							<input type="email" name="email"
								id="email" class="form-control" style="width: 70%;" placeholder="Email"/>
						</div>
						<div class="form-group" style="margin-left: 20%">
							<input type="number"
								name="phone_number" id="phone_number" class="form-control" style="width: 70%;" placeholder="Số điện thoại"/>
						</div>
						<div class="form-group" style="margin-left: 20%">
							<textarea type="text" name="message" id="message"
								class="form-control" style="width: 70%;" placeholder="Tin nhắn"></textarea>
						</div>
						
					</form>	
				</div>
				<div class="modal-footer" style="border-top: 0px">
					<button type="button" style="margin-right: 24% ;background-color: #337ab7 !important;width: 56%;height: 50px;" id="sendButton" class="btn btn-default"><span style="color: #ffffff;font-weight: bold;">Gửi thông tin</span></button>
<!-- 					<button type="button"  id="closeButton" class="btn btn-default" -->
<!-- 						data-dismiss="modal">Đóng</button> -->
				</div>
				
			</div>
		</div>
	</div>
	
	@endsection