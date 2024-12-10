@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Cập nhật slider
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật slider</h1>
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
                                <label>Tên slider</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ $getRecord->title }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh<span style="color: red">*</span></label>
                                <input type="file" class="form-control" name="image_name" value="">
                                @if (!empty($getRecord->getImg()))
                                    <img src="{{$getRecord->getImg()}}" style="margin-top:5px;height: 100px">
                                @endif
                            </div>

                            <div class="form-group">
                                <label>Tên nút</label>
                                <input type="text" class="form-control" name="button_name"
                                    value="{{ $getRecord->button_name }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Đường dẫn</label>
                                <input type="button_link" class="form-control" name="button_link"
                                    value="{{ $getRecord->button_link }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Tình trạng <span style="color: red">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Còn</option>
                                    <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Hết</option>
                                </select>
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
