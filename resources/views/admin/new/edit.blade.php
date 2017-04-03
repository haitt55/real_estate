@extends('admin.layouts.master')

@section('title', 'Tin Tức')

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
            <h1 class="page-header">Dự án - Tin Tức</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="/admin/new/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tạo Tin Tức cho dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chỉnh sửa Tin Tức: {{$new->title }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
										{{ Form::model($new, array('route' => array('admin.new.update', $new->id), 'method' => 'PUT')) }}										
										<div class="form-group">
									        {{ Form::label('project_id', 'Dự án') }}
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
											{{ Form::textarea('meta_description', Input::old('meta_description'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
											{{ Form::Checkbox('published', '1', Input::old('published'))}} 
											{{ Form::label('published', 'Đã được đăng') }}</div>
									    {{ Form::submit('Update the new!', array('class' => 'btn btn-primary')) }}
									
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
        CKEDITOR.replace( 'meta_description' );
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        if($( "input[name='published']" ).value == 1){
        	$( "input[name='published']" ).attr('checked');
            }
        });
    $( "input[name='published']" ).on( "click", function(){
    	this.value = this.checked ? 1 : 0;
    	   // alert(this.value);
    	}).change();
    </script>
    @endsection 