@extends('admin.layouts.master')

@section('title', 'Tiện ích')

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
            <h1 class="page-header">sản phẩm - Tiện ích</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.utility.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Danh sách Tiện ích</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chỉnh sửa Tiện ích: {{$utility->title }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
										{{ Form::model($utility, array('route' => array('admin.utility.update', $utility->id), 'method' => 'PUT')) }}
										<input type="hidden" id="id" value="{{$utility->id}}">											
										<div class="form-group">
									        {{ Form::label('project_id', 'sản phẩm') }}
									        {{ Form::select('project_id', $projects, null, ['class' => 'form-control']) }}
									    </div>
									    <div class="form-group">
									        {{ Form::label('title', 'Tiêu đề :') }}
									        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
									    </div>

									    <div class="form-group">
									        {{ Form::label('content', 'Nội dung : ') }}
											{{ Form::textarea('content', Input::old('content'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('page_title', 'Tiêu đề trang') }}
											{{ Form::text('page_title', Input::old('page_title'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('meta_keyword', 'Từ khóa Meta') }}
											{{ Form::text('meta_keyword', Input::old('meta_keyword'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('meta_description', 'Mô tả Meta') }}
											{{ Form::text('meta_description', Input::old('meta_description'), array('class' => 'form-control')) }}
										</div>
									    {{ Form::submit('Update the utility!', array('class' => 'btn btn-primary')) }}
									
									{{ Form::close() }}
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
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
    <script>
    CKEDITOR.replace( 'content' );
    </script>
    <script type="text/javascript">
			
				$('#project_id').change(function() {
					var url = "/admin/utility/checkProject";
					projectId = $(this).val();
					id = $("#id").val();
                    $.ajax({
                        url : url,
                        type : 'Post',
                        dataType : 'json',
                        data: {projectId : projectId, id : id},
                        beforeSend: function (xhr) {
                            var token = $('meta[name="csrf_token"]').attr('content');
                            if (token) {
                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                            }
                        },
                        success: function(data) {
                            if(data.code == 1){
                            	if (confirm('sản phẩm này đã có vị trí. Bạn có muốn xóa vị trí cũ và thêm mới?')) {
                            		$.ajax({
                                        url : "/admin/utility/delete",
                                        type : 'Post',
                                        dataType : 'json',
                                        data: {projectId : projectId},
                                        beforeSend: function (xhr) {
                                            var token = $('meta[name="csrf_token"]').attr('content');
                                            if (token) {
                                                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                                            }
                                        },
                                        
                                        success: function(data) {
                                            if(data.code == 1){
                                            	
                                                alert("Deleted");
                                            	}
                                            },
                                        
                                        error: function(data) {
//                	                            window.location.href = '{{ URL::route('admin.project.index') }}';
                                        }
                                    });
                            	} else {
                            		window.location.href = '/admin/utility/'+ data.utilityId+'/edit';
                            	}
                            
                            }	
                        },
                        error: function(data) {
//	                            window.location.href = '{{ URL::route('admin.project.index') }}';
                        }
                    });
                
    			});
// 				 .done(function( response ) {
// 			    alert( 1);
// 			  });
        
    </script>
@endsection
