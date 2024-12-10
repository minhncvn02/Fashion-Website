@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Màu sản phẩm
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Màu sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')
            <a href="{{ url('admin/color/add') }}" class="btn btn-primary mx-2 my-2">
                Tạo màu sản phẩm
            </a>
            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="color-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Tên</th>
                                        <th>Mã màu</th>
                                        <th>Tạo bởi</th>
                                        <th>Tạo vào ngày</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>

                                        <td>{{$value->name}}</td>
                                        <td>{{$value->code}}</td>
                                        <td>{{($value->created_by_name)}}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/color/edit/' .$value->id) }}" class="btn btn-warning mx-1">
                                                Cập nhật
                                            </a>
                                            <a href="{{ url('admin/color/delete/' .$value->id) }}" class="btn btn-danger">
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
    new DataTable("#color-table", {
        info: false,
        language: {
            search: "Tìm kiếm:",
        },
    });
</script>
@endsection
