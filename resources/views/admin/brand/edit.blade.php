@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Cập nhật thương hiệu sản phẩm
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật thương hiệu sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="md-6">
                <div class="card card-primary">
                    <form action="" method="post">
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tên thương hiệu <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ old('name',$getRecord->name) }}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Slug<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="slug" required
                                    value="{{ old('slug',$getRecord->slug) }}" placeholder="Điền đường dẫn">
                                <div style="color: red">{{ $errors->first('slug') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Tình trạng <span style="color: red">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Còn</option>
                                    <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Hết</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Meta Title <span style="color: red">*</span></label>
                                <input class="form-control" name="meta_title" required
                                    value="{{ old('meta_title',$getRecord->meta_title) }}" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea class="form-control" name="meta_description"
                                    value="{{ old('meta_description',$getRecord->meta_description) }}" placeholder=""></textarea>
                            </div>
                            <div class="form-group">
                                <label>Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords"
                                    value="{{ old('meta_keywords',$getRecord->meta_keywords) }}" placeholder="">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="{{ url('public/assets/dist/js/pages/dashboard3.js') }}"></script>
@endsection
