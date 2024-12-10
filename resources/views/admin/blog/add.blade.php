@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Tạo tin tức
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tạo tin tức</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="md-6">
                <div class="card card-primary">
                    <form action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tiêu đề<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="title" required
                                    value="{{ old('title') }}" >
                                <div style="color: red">{{ $errors->first('title') }}</div>
                            </div>

                            <div class="form-group">
                                <label>Tên chủ đề <span style="color: red">*</span></label>
                                <select class="form-control" name="blog_category_id" id="" required>
                                    <option value="">Chọn chủ đề</option>
                                    @foreach ($getCategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh<span style="color: red">*</span></label>
                                <input type="file" class="form-control" name="image_name">
                            </div>

                            <div class="form-group">
                                <label>Mô tả<span style="color: red">*</span></label>
                                <textarea class="form-control note" name="description" id="" cols="30" rows="10">

                                </textarea>
                            </div>

                            <div class="form-group">
                                <label>Tình trạng <span style="color: red">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Còn</option>
                                    <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Hết</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Meta Title <span style="color: red">*</span></label>
                                <input class="form-control" name="meta_title" required
                                    value="{{ old('meta_title') }}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description"
                                    value="{{ old('meta_description') }}" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ old('meta_keywords') }}" placeholder="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')

@endsection
