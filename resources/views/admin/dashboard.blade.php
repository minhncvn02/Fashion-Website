@extends('admin.layouts.app')

@section('title')
    Dashboard
@endsection

@section('style')

@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Tổng số đơn hàng</span>
                        <span class="info-box-number">{{$TotalOrder}}</span>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                        <span class="info-box-text">Đơn hàng hôm nay</span>
                        <span class="info-box-number">{{$TotalTodayOrder}}</span>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Đơn hàng gần nhất</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table id="lastest-order-table" class="table table-striped table-valign-middle">
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
                            <th>Tạo vào ngày</th>
                    </thead>
                    <tbody>
                        @foreach ($getLatestOrders as $value)
                        <tr>
                            <td><a href="{{ url('admin/order/detail/'.$value->id) }}">{{$value->order_number}}</a></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->address}}</td>
                            <td>{{$value->ward}}</td>
                            <td>{{$value->district}}</td>
                            <td>{{$value->city}}</td>
                            <td>{{$value->phone}}</td>
                            <td>{{$value->total_amount}}</td>
                            <td>{{ date('d-m-Y, h:i A', strtotime($value->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
</div>
@endsection

@section('script')
    <script src="{{url('public/assets/dist/js/pages/dashboard3.js')}}"></script>

    <script>
        new DataTable('#lastest-order-table',{
            info: false,
            language: {
                search: "Tìm kiếm:",
            },
        });
    </script>
@endsection
