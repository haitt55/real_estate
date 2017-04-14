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
            <a href="{{ route('admin.project.index') }}" class="btn btn-success"><i class="fa fa-list"></i> Danh sách sản phẩm</a>
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
                                    <label for="project_name">Tên sản phẩm <span class="required">(*)</span></label>
                                    <input type="text" name="project_name" id="project_name" class="form-control" value="{{ old('project_name') }}">
                                </div>
                                <div class="form-group">{{ Form::label('main_project_id', 'Dự án') }}
                                    {{ Form::select('main_project_id', $mainProjects,null, ['class' =>
                                    'form-control']) }}</div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo 1</label>
                                    <input type="file" id="project_image_ads" name="project_image_ads" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads_preview" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Ảnh banner quảng cáo 2</label>
                                    <input type="file" id="project_image_ads1" name="project_image_ads1" accept="image/*">
                                    <div class="row" style="margin-top: 10px;">
                                        <div class="display-image col-md-12">
                                            <img class="thumbnail" style="max-width: 200px;" id="project_image_ads1_preview" src="" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="content">Nội dung</label>
                                    <textarea name="description" id="description">{{ old('description') }}</textarea>
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

            $("#project_image_logo").change(function(){
                readURL(this, 'project_image_logo_preview');
            });

            $("#project_image_ads").change(function(){
                readURL(this, 'project_image_ads_preview');
            });

            $("#project_image_ads1").change(function(){
                readURL(this, 'project_image_ads1_preview');
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