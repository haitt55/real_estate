@extends('admin.layouts.master')

@section('title', 'tiến độ')

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
            <h1 class="page-header">Dự án - tiến độ</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="/admin/progress/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm tiến độ cho Dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    tiến độ
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-progress">
                                    <thead>
                                    <tr>
                                        <th>Tên tiến độ</th>
                                        <th>Tên Dự án</th>
                                        <th>Chỉnh sửa lần cuối</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($progress as $prog)
                                        <tr>
                                            <td><a href="/admin/progress/{{ $prog->slug }}">{{ $prog->title }}</a></td>
                                            <td>{{ $prog->project_name }}</td>
                                            <td>{{ $prog->updated_at }}</td>
                                            <td>
                                                <a href="/admin/progress/{{ $prog->id }}/edit" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
<!--                                                  {{ Form::open(array('url' => 'admin/progress/' . $prog->id, 'class' => 'pull-right')) }} -->
<!-- 								                    {{ Form::hidden('_method', 'DELETE') }} -->
<!-- 								                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }} -->
<!-- 								                {{ Form::close() }} -->
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
            $("#dataTables-progress").DataTable({
                responsive: true,
                "order": [[ 1, "desc" ]],
                "aoColumns": [
                    null, null, null,
                    { bSortable: false }
                ]
            });
        });
    </script>
@endsection