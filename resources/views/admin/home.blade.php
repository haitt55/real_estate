@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tag fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countProjects }}</div>
                                <div>Dự án</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.project.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-envelope-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countPositions }}</div>
                                <div>Vị trí</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.position.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $countCustomers }}</div>
                                <div>Khách hàng</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.customer.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection