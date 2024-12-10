@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Đơn hàng</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    @include('user.sidebar')

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <table id="users-table" class="table table-striped" style="overflow:auto">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tổng tiền (VNĐ)</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Tạo vào ngày</th>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td><a href="{{ url('user/order/detail/' .$value->id) }}">{{$value->order_number}}</a></td>
                                        <td>{{$value->total_amount}}</td>
                                        <td>{{($value->payment_method == 'cash') ? 'COD' : ''}}</td>
                                        <td>
                                            @if($value->status == 0)
                                                Đang xử lý
                                            @elseif($value->status == 1)
                                                Đang giao hàng
                                            @elseif($value->status == 2)
                                                Đã giao hàng
                                            @elseif($value->status == 3)
                                                Đã hoàn thành
                                            @else
                                                Đã huỷ
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y, h:i A', strtotime($value->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
