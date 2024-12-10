@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Phí vận chuyển
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Phí vận chuyển</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')
            <a href="{{ url('admin/shipping_charge/add') }}" class="btn btn-primary mx-2 my-2">
                Tạo phí vận chuyển
            </a>
            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="shipping-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Tên</th>
                                        <th>Phí</th>
                                        <th>Tình trạng</th>
                                        <th>Tạo vào ngày</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>

                                        <td>{{$value->name}}</td>
                                        <td>{{$value->price}}</td>
                                        <td>{{($value->status == 1) ? 'Còn' : 'Hết'}}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/shipping_charge/edit/' .$value->id) }}" class="btn btn-warning mx-1">
                                                Cập nhật
                                            </a>
                                            <a href="{{ url('admin/shipping_charge/delete/' .$value->id) }}" class="btn btn-danger">
                                                Xoá
                                            </a>
                                        </td>
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
    new DataTable("#shipping-table", {
        info: false,
        language: {
            search: "Tìm kiếm:",
        },
    });
</script>
@endsection
