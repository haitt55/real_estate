@extends('layouts.master') 
@section('content')
				<h1 class="modal-title"
					style="text-align: center; line-height: 1.428571;">LIÊN HỆ</h1>
				<h2 class="modal-title"
					style="text-align: center; line-height: 1.428571;">Đăng kí nhận
					thông tin dự án.</h2><br>
				<form action="{{route('store.index')}}" method = "POST">
				{!! csrf_field() !!}
					<div class="form-group" style="margin-left: 20%">
						<input type="text" name="full_name" id="full_name"
							class="form-control" style="width: 70%;" placeholder="Họ tên" />
					</div>
					<div class="form-group" style="margin-left: 20%">
						<input type="email" name="email" id="email" class="form-control"
							style="width: 70%;" placeholder="Email" />
					</div>
					<div class="form-group" style="margin-left: 20%">
						<input type="number" name="phone_number" id="phone_number"
							class="form-control" style="width: 70%;"
							placeholder="Số điện thoại" />
					</div>
					<div class="form-group" style="margin-left: 20%">
						<textarea type="text" name="message" id="message"
							class="form-control" style="width: 70%;" placeholder="Tin nhắn"></textarea>
					</div>
					<button type="submit"
					style="margin-left: 20%; background-color: #337ab7 !important; width: 56%; height: 50px;"
					id="sendButton" class="btn btn-default">
					<span style="color: #ffffff; font-weight: bold;">Gửi thông tin</span>
				</button>
				</form>
				
				<!-- 					<button type="button"  id="closeButton" class="btn btn-default" -->
				<!-- 						data-dismiss="modal">Đóng</button> -->


@endsection
