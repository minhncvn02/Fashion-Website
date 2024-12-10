@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Tạo mã giảm giá
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tạo mã giảm giá</h1>
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
                                <label>Tên mã giảm giá <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ old('name') }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Loại<span style="color: red">*</span></label>
                                <select class="form-control" name="type" required>
                                    <option {{ (old('type') == 'Tiền mặt') ? 'selected' : '' }} value="Tiền mặt">Tiền mặt</option>
                                    <option {{ (old('type') == '% giá trị') ? 'selected' : '' }} value="% giá trị">% giá trị</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Giá trị giảm<span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="percent_amount" required
                                    value="{{ old('percent_amount') }}" placeholder="">
                            </div>

                            <div class="form-group">
                                <label>Ngày hết hạn<span style="color: red">*</span></label>
                                <input type="date" class="form-control" name="expire_date" required
                                    value="{{ old('expire_date') }}">
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
                            <button type="submit" class="btn btn-primary">Thêm</button>
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
