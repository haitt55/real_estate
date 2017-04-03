@extends('admin.layouts.master')

@section('title', 'thêm dự án mới')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm mới dự án</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12 text-right">
            <a href="{{ route('admin.project.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Danh sách dự án</a>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('admin.project.store') }}" role="form" enctype="multipart/form-data">
                                @include('admin.layouts.partials.errors')
                                {!! csrf_field() !!}
                                <div class="form-group">
                                    <label for="title">Tên dự án <span class="required">(*)</span></label>
                                    <input type="text" name="project_name" id="project_name" class="form-control" value="{{ old('project_name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="content">Mô tả</label>
                                    <textarea name="description" id="description">{{ old('description') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh hiển thị trên header</label>
                                    <input type="file" id="project_image_header" name="project_image_header" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_header_preview" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo</label>
                                    <input type="file" id="project_image_ads" name="project_image_ads" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads_preview" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="page_title">Page Title</label>
                                    <input type="text" name="page_title" id="page_title" class="form-control" value="{{ old('page_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keyword">Meta Keyword</label>
                                    <input type="text" name="meta_keyword" id="meta_keyword" class="form-control" value="{{ old('meta_keyword') }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Meta Description</label>
                                    <input type="text" name="meta_description" id="meta_description" class="form-control" value="{{ old('meta_description') }}">
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="is_current" id="is_current" value="1"{{ old('is_current', true) ? ' checked="checked"' : '' }}> Đặt là dự án đang chạy</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
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
        CKEDITOR.replace( 'description' );
    </script>
    <script>
        $(function() {
            $("#project_image_header").change(function(){
                readURL(this, 'project_image_header_preview');
            });

            $("#project_image_ads").change(function(){
                readURL(this, 'project_image_ads_preview');
            });
        });
        function readURL(input, targetID) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#' + targetID).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection