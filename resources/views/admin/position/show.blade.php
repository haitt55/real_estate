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
                    Xem Vị trí :{{$position->title }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                            	<h1>Showing {{$position->title }}</h1>

								    <div class="jumbotron text-center">
								        <h2>{{ $position->name }}</h2>
								        <p>
								            <strong>Slug:</strong> {{ $position->slug }}<br>
								            <strong>Content:</strong> {{ $position->content }}<br>
								            <strong>Page Title:</strong> {{ $position->page_title }}<br>
								            <strong>Meta Keyword:</strong> {{ $position->meta_keyword }}<br>
								            <strong>Meta Description:</strong> {{ $position->meta_description }}<br>
								        </p>
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

