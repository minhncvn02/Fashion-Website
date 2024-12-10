@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Thông tin cá nhân</h1>
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
                                <label>Họ và tên *</label>
                                <input type="text" name="name" value="{{$getProfile->name}}" class="form-control" required>

                                <label>Địa chỉ *</label>
                                <input type="text" name="address" value="{{$getProfile->address}}" class="form-control" placeholder="Ví dụ: 43/7, đường Trần Tấn" required>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Phường/Xã *</label>
                                        <input type="text" name="ward" value="{{$getProfile->ward}}" class="form-control" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Quận/Huyện *</label>
                                        <input type="text" name="district" value="{{$getProfile->district}}" class="form-control" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Tỉnh/Thành phố *</label>
                                        <input type="text" name="city" value="{{$getProfile->city}}" class="form-control" required>
                                    </div>
                                </div>

                                <label>Số điện thoại *</label>
                                <input type="tel" name="phone" value="{{$getProfile->phone}}" class="form-control" required>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    Cập nhật
                                </button>
                            </form>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div>
</main>
@endsection

@section('script')

@endsection
