@extends('admin.layouts.master')

@section('title', 'Bảng giá và Chính sách')

@section('css')
    @parent

    <!-- DataTables CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dự án - Bảng giá và Chính sách</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="/admin/pricePolicy/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tạo Bảng giá và Chính sách cho dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Xem Bảng giá và Chính sách :{{$pricePolicy->title }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                            	<h1>Showing {{$pricePolicy->title }}</h1>

								    <div class="jumbotron text-center">
								        <h2>{{ $pricePolicy->name }}</h2>
								    </div>
								    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Slug</label></div>
                                        <div class="col-md-8"><p class="form-control-static">{{ $pricePolicy->slug }}</p></div>
                                    </div>
                                	</div>
								    <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Nội dung</label></div>
                                        <div class="col-md-8"><p class="form-control-static">{!!$pricePolicy->content!!}</p></div>
                                    </div>
                                	</div>
								    <div class="row">
			                        <div class="col-lg-12">
			                            <button class="btn btn-danger" id="btn-delete" data-link="{{ route('admin.pricePolicy.destroy', $pricePolicy->id) }}"><i class="fa fa-remove"></i> Xóa Bảng giá và Chính sách</button>
			                        </div>
			                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
@endsection
@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-delete").click(function() {
                if (confirm('Do you really want to delete this data?')) {
                    var url = $(this).attr('data-link');
                    $.ajax({
                        url : url,
                        type : 'DELETE',
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');
                            if (token) {
                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                        },
                        success: function(data) {
                            if (data.error) {
                                window.location.href = '{{ URL::route('admin.pricePolicy.show', $pricePolicy->id) }}';
                            } else {
                                window.location.href = '{{ URL::route('admin.pricePolicy.index') }}';
                            }
                        },
                        error: function(data) {
                            window.location.href = '{{ URL::route('admin.pricePolicy.index') }}';
                        }
                    });
                }
            });
        });
    </script>
@endsection
