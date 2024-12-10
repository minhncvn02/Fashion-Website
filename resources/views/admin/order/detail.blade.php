@extends('admin.layouts.app')

@section('style')

@endsection

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chi tiết đơn hàng</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
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
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sản phẩm mua </h3>
                            </div>

                            <table id="order-item" class="table table-striped" style="width:100%">
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
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
@endsection
