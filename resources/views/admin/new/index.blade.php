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
@if(session('message'))
        <div class="alert alert-success" style="margin-top: 10px; margin-bottom: 0px;">
            <ul>
                <li>{{session('message')}}</li>
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách Tin tức</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <br />
    <div class="row">
        <div class="col-lg-12">
            <form class="form-inline" action="{{ route('admin.new.index') }}" method="GET">
                <div class="form-group">
                    <label for="project_id">Lọc theo dự án:</label>
                    <select class="form-control" name="project_id" id="project_id">
                        <option value="">Tất cả các dự án</option>
                        @foreach($projectOptions as $key => $value)
                            <option value="{{ $key }}" @if($key == $chosenProject)selected="selected"@endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search">&nbsp;</span>Lọc</button>
            </form>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="/admin/new/create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm Tin Tức cho dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tin Tức
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-newList">
                                    <thead>
                                    <tr>
                                        <th>Tên Tin Tức</th>
                                        <th>Trạng thái</th>
                                        <th>Chỉnh sửa lần cuối</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($newList as $new)
                                        <tr>
                                            <td><a href="/admin/new/{{ $new->id }}">{{ $new->title }}</a></td>
                                            <td>
                                                @if ($new->published == 1)
                                                    <span class="label label-success">Đã đăng</span>
                                                @else
                                                    <span class="label label-danger">Chưa đăng</span>
                                                @endif
                                            </td>
                                            <td>{{ $new->updated_at }}</td>
                                            
                                            <td>
                                                <a href="/admin/new/{{ $new->id }}/edit" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
<!--                                                  {{ Form::open(array('url' => 'admin/new/' . $new->id, 'class' => 'pull-right')) }} -->
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
            $("#dataTables-newList").DataTable({
                responsive: true,
                "order": [[ 1, "desc" ]],
                "aoColumns": [
                    null, null,
                    { bSortable: false }
                ]
            });
        });
    </script>
@endsection