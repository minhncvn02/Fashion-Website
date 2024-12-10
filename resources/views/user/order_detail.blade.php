@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Chi tiết đơn hàng</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('user.sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mã đơn hàng: <span style="font-weight: normal">{{$getRecord->order_number}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Họ tên: <span style="font-weight: normal">{{$getRecord->name}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Địa chỉ: <span style="font-weight: normal">{{$getRecord->address}}, {{$getRecord->ward}}, {{$getRecord->district}}, {{$getRecord->city}}</span>  </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Số điện thoại: <span style="font-weight: normal">{{$getRecord->phone}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email: <span style="font-weight: normal">{{$getRecord->email}}</span></label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Mã giảm giá: <span style="font-weight: normal">{{$getRecord->discount_code}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Giá trị giảm: <span style="font-weight: normal">{{number_format($getRecord->discount_amount)}} VNĐ</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phương thức giao hàng: <span style="font-weight: normal">{{$getRecord->getShipping->name}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Phí giao hàng: <span style="font-weight: normal">{{number_format($getRecord->shipping_amount)}} VNĐ</span></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tình trạng:
                                                <span style="font-weight: normal">
                                                    @if($getRecord->status == 0)
                                                        Đang xử lý
                                                    @elseif($getRecord->status == 1)
                                                        Đang giao hàng
                                                    @elseif($getRecord->status == 2)
                                                        Đã giao hàng
                                                    @elseif($getRecord->status == 3)
                                                        Đã hoàn thành
                                                    @else
                                                        Đã huỷ
                                                    @endif
                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tạo vào ngày: <span style="font-weight: normal">{{date('d-m-Y, h:i A', strtotime($getRecord->created_at))}}</span></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phương thức thanh toán: <span style="font-weight: normal">{{($getRecord->payment_method == 'cash') ? 'Thanh toán khi nhận hàng' : ''}}</span></label>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tổng tiền: <span style="font-weight: normal">{{number_format($getRecord->total_amount)}} VNĐ</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Ghi chú: <span style="font-weight: normal">{{$getRecord->note}}</span></label>
                                </div>
                            </div>

                            <div class="card">

                                <table id="order-product-item" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên</th>
                                            <th>Số lượng</th>
                                            <th>Giá (VNĐ)</th>
                                            <th>Kích cỡ</th>
                                            <th>Màu</th>
                                            <th>Tổng tiền (VNĐ)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getRecord->getItem as $item)
                                        @php
                                            $getProductImage = $item->getProduct->getImgSingle($item->getProduct->id);
                                        @endphp
                                        <tr>
                                            <td>
                                                <img style="width:100px;height:100px" src="{{$getProductImage->getImg()}}">
                                            </td>
                                            <td><a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a></td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                            <td>{{$item->size_name}}</td>
                                            <td>{{$item->color_name}}</td>
                                            <td>{{number_format($item->total_price)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection

@section('script')
<script src="{{ url('public/scripts/data-table.js') }}"></script>
@endsection
