@extends('admin.layouts.master')

@section('title', 'vị trí')

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
            <h1 class="page-header">Dự án - vị trí</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            {{--<a href="" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tạo vị trí cho dự án</a>--}}
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tạo mới Vị trí
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                            	{{ Form::open(array('url' => 'admin/position/store')) }}
										<div class="form-group">
									        {{ Form::label('project_id', 'Project Id') }}
									        {{ Form::text('project_id', Input::old('project_id'), array('class' => 'form-control')) }}
									    </div>
									    <div class="form-group">
									        {{ Form::label('title', 'Title') }}
									        {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
									    </div>

									    <div class="form-group">
									        {{ Form::label('slug', 'Slug') }}
									        {{ Form::text('slug', Input::old('slug'), array('class' => 'form-control')) }}
									    </div>
									
									    <div class="form-group">
									        {{ Form::label('content', 'Content') }}
											{{ Form::text('content', Input::old('content'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('page_title', 'Page Title') }}
											{{ Form::text('page_title', Input::old('page_title'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('meta_keyword', 'Meta Keyword') }}
											{{ Form::text('meta_keyword', Input::old('meta_keyword'), array('class' => 'form-control')) }}									    
										</div>
										<div class="form-group">
									        {{ Form::label('meta_description', 'Meta Discription') }}
											{{ Form::text('meta_description', Input::old('meta_description'), array('class' => 'form-control')) }}									    
										</div>
									    {{ Form::submit('Create the Position!', array('class' => 'btn btn-primary')) }}
									
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

