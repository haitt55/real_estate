@extends('admin.layouts.master')

@section('title', 'Message Details')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dự án {{ $mainProject->project_name }}</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.main_project.index') }}" class="btn btn-success"><i class="fa fa-list"></i> List</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Chi tiết dự án
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Tên dự án</label></div>
                                        <div class="col-md-8"><p class="form-control-static">{{ $mainProject->project_name }}</p></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Ảnh logo</label></div>
                                        <div class="col-md-8"><p class="form-control-static"><img src="{{ $mainProject->project_image_logo ? asset($mainProject->project_image_logo) : asset(config('custom.no_image')) }}" style="max-width: 200px;" alt=""></p></div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Ảnh header</label></div>
                                        <div class="col-md-8"><p class="form-control-static"><img src="{{ $mainProject->project_image_header ? asset($mainProject->project_image_header) : asset(config('custom.no_image')) }}" style="max-width: 200px;" alt=""></p></div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Ảnh quảng cáo</label></div>
                                        <div class="col-md-8"><p class="form-control-static"><img src="{{ $mainProject->project_image_ads ? asset($mainProject->project_image_ads) : asset(config('custom.no_image'))}}" style="max-width: 200px;" alt=""></p></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4"><label for="name">Nội dung trang chủ</label></div>
                                        <div class="col-md-8" style="overflow-y: scroll">{!! html_entity_decode($mainProject->description) !!}</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('admin.main_project.edit', $mainProject->id) }}" class="btn btn-info"><i class="fa fa-edit"></i> Chỉnh sửa</a>
                            <button style="@if($mainProject->is_current)pointer-events:none; opacity: 0.6; @endif" class="btn btn-danger" id="btn-delete" data-link="{{ route('admin.main_project.destroy', $mainProject->id) }}"><i class="fa fa-remove"></i> Xóa dự án</button>
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
                                window.location.href = '{{ URL::route('admin.main_project.show', $mainProject->id) }}';
                            } else {
                                window.location.href = '{{ URL::route('admin.main_project.index') }}';
                            }
                        },
                        error: function(data) {
                            window.location.href = '{{ URL::route('admin.main_project.index') }}';
                        }
                    });
                }
            });
        });
    </script>
@endsection