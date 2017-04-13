@extends('admin.layouts.master')
@section('title', 'Dự án')

@section('css')
    @parent

    <!-- DataTables CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
@endsection
@section('content')
    @if(session('message'))
        <div class="alert alert-success" style="margin-top: 10px; margin-bottom: 0px;">
            <ul>
                <li>{{session('message')}}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dự án</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.main_project.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Project List
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-mainProjects">
                                    <thead>
                                    <tr>
                                        <th>Tên dự án</th>
                                        <th>Trạng thái</th>
                                        <th>Chỉnh sửa lần cuối</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($mainProjects as $mainProject)
                                        <tr>
                                            <td><a href="{{ route('admin.main_project.show', $mainProject->id) }}">{{ $mainProject->project_name }}</a></td>
                                            <td>
                                                @if ($mainProject->is_current)
                                                    <span class="label label-success">Dự án đang chạy</span>
                                                @else
                                                    <span class="label label-danger">Dự án cũ</span>
                                                @endif
                                            </td>
                                            <td>{{ $mainProject->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('admin.main_project.edit', $mainProject->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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

@section('javascript')
    @parent

    <!-- DataTables JavaScript -->
    <script src="/templates/admin/sbadmin2/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/templates/admin/sbadmin2/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
@endsection

@section('inline_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#dataTables-mainProjects").DataTable({
                responsive: true,
                "order": [[1, 'desc'],[ 2, "desc" ]],
                "aoColumns": [
                    null, null, null,
                    { bSortable: false }
                ]
            });
        });
    </script>
@endsection
