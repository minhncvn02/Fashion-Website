@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Cập nhật tài khoản
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật tài khoản</h1>
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
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ old('name',$getRecord->name) }}" placeholder="Điền tên">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required
                                    value="{{ old('email',$getRecord->email) }}" placeholder="Điền email">
                                <div style="color: red">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" required
                                    placeholder="Điền mật khẩu">
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role">
                                    <option {{ ($getRecord->role == 0) ? 'selected' : '' }} value="0">Khách hàng</option>
                                    <option {{ ($getRecord->role == 1) ? 'selected' : '' }} value="1">Admin</option>
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
