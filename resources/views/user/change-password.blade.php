@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Đổi mật khẩu</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('user.sidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content mt-2">
                            @include('layouts._message')
                            <form action="" method="POST">
                                {{ csrf_field() }}
                                <label>Mật khẩu cũ *</label>
                                <input type="password" name="old_password" value="" class="form-control" required>

                                <label>Mật khẩu mới *</label>
                                <input type="password" name="password" value="" class="form-control" required>

                                <label>Xác nhận mật khẩu *</label>
                                <input type="password" name="cpassword" value="" class="form-control" required>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    Đổi mật khẩu
                                </button>
                            </form>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')

@endsection
