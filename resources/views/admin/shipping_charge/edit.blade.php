@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Cập nhật thông tin phí vận chuyển
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật thông tin phí vận chuyển</h1>
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
                                <label>Tên phí vận chuyển <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ old('name', $getRecord->name) }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Phí<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="price" required
                                    value="{{ old('price', $getRecord->price) }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Tình trạng <span style="color: red">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option {{ (old('status') == 1) ? 'selected' : '' }} value="1">Còn</option>
                                    <option {{ (old('status') == 0) ? 'selected' : '' }} value="0">Hết</option>
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
