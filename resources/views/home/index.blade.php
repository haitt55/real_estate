@extends('layouts.master') @section('title') {{$project->page_title}}
@stop @section('description') {{$project->meta_description}} @stop
@section('images') {{$project->project_image_header}} @stop
@section('content')
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
				src="{{$project->project_image_ads}}" alt="" width="660"
				height="345">
		</div>
		@endif @if($project->project_image_ads1 != null)
		@if($project->project_image_ads != null)
		<div class="item">
			<img id="image_ads_02"
				style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
				src="{{$project->project_image_ads1}}" alt="" width="660"
				height="345">
		</div>
		@else
		<div class="item active">
			<img id="image_ads_02"
				style="width: 100%; max-height: 500px; margin-bottom: 30px !important"
				src="{{$project->project_image_ads1}}" alt="" width="660"
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
		<h1 class="entry-title">{{$project->project_name}}</h1>
	</header>
	<p style="text-align: center;">
		<strong>{{$project->page_title}}</strong>
	</p>
	{!!html_entity_decode($project->description)!!}
	<div class="modal" id="myModal" role="dialog" style="display: none">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" id="headerCloseButton" class="close"
						data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thông tin khách hàng</h4>
				</div>
				<div class="modal-body">
					<form >
							<div class="form-group">
							<label>Họ và tên: </label> <input type="text" name="full_name"
								id="full_name" class="form-control" />
						</div>
						<input id ="project_id" name="project_id" type="hidden" value = "{{$project->id}}">
						<div class="form-group">
							<label>Email: </label> <input type="email" name="email"
								id="email" class="form-control" />
						</div>
						<div class="form-group">
							<label>Số điện thoại: </label> <input type="number"
								name="phone_number" id="phone_number" class="form-control" />
						</div>
						<div class="form-group">
							<label>Tin Nhắn: </label>
							<textarea type="text" name="message" id="message"
								class="form-control"></textarea>
						</div>
						
					</form>	
				</div>
				<div class="modal-footer">
					<button type="button" style="margin-right: 40% ;background-color: blue !important"id="sendButton" class="btn btn-default"><span style="color: #ffffff;font-weight: bold;">Gửi thông tin</span></button>
<!-- 					<button type="button"  id="closeButton" class="btn btn-default" -->
<!-- 						data-dismiss="modal">Đóng</button> -->
				</div>
				
			</div>
		</div>
	</div>
	<script type="text/javascript">
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
				var project_id = $("#project_id").val();
				$.ajax({
                    url : '{{ route("addCustomer") }}',
                    type : 'Post',
//                     beforeSend: function (xhr) {
//                         var token = $('meta[name="csrf_token"]').attr('content');
//                         if (token) {
//                             return xhr.setRequestHeader('X-CSRF-TOKEN', token);
//                         }
//                     },
                    dataType: 'json',
                    data: {full_name : full_name, email: email, phone_number : phone_number, message: message, project_id : project_id, _token: '<?php echo csrf_token() ?>'},
                    success: function(data) {
                        if(data.code == 1){
                        	$("#myModal").css('display', 'none');
                            }
                    }
                });
			});
</script>
	@endsection