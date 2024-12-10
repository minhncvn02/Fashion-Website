@extends('admin.layouts.app')

@section('style')

@endsection

@section('title')
    Đơn hàng
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Đơn hàng</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')

            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="order-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Họ tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Phường/Xã</th>
                                        <th>Quận/Huyện</th>
                                        <th>Tỉnh/Thành phố</th>
                                        <th>Số điện thoại</th>
                                        <th>Tổng tiền (VNĐ)</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái</th>
                                        <th>Tạo vào ngày</th>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td><a href="{{ url('admin/order/detail/'.$value->id) }}">{{$value->order_number}}</a></td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->address}}</td>
                                        <td>{{$value->ward}}</td>
                                        <td>{{$value->district}}</td>
                                        <td>{{$value->city}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->total_amount}}</td>
                                        <td>{{($value->payment_method == 'cash') ? 'COD' : ''}}</td>
                                        <td>
                                            <select class="form-control ChangeStatus" style="width:125px" name="" id="{{$value->id}}">
                                                <option {{($value->status == 0) ? 'selected' : ''}} value="0">Đang xử lý</option>
                                                <option {{($value->status == 1) ? 'selected' : ''}} value="1">Đang giao hàng</option>
                                                <option {{($value->status == 2) ? 'selected' : ''}} value="2">Đã giao hàng</option>
                                                <option {{($value->status == 3) ? 'selected' : ''}} value="3">Đã hoàn thành</option>
                                                <option {{($value->status == 4) ? 'selected' : ''}} value="4">Đã huỷ</option>
                                            </select>
                                        </td>
                                        <td>{{ date('d/m/Y, h:i A', strtotime($value->created_at)) }}</td>
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
    <script>
        $('body').delegate('.ChangeStatus', 'change', function(){
            var status = $(this).val();
            var order_id = $(this).attr('id');

            $.ajax({
                type: "GET",
                url: "{{url('admin/order_status')}}",
                data: {
                    status: status,
                    order_id: order_id,
                },
                dataType: "json",
                success: function(data){
                    alert(data.message);
                },

            });
        });
    </script>

    <script>
        new DataTable("#order-table", {
            info: false,
            language: {
                search: "Tìm kiếm:",
            },
        });
    </script>
@endsection
