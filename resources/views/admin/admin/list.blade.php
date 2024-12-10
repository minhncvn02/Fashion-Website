@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Tài khoản
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tài khoản</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')
            <a href="{{ url('admin/admin/add') }}" class="btn btn-primary mx-2 my-2">
                Tạo tài khoản
            </a>
            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="account-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Tài khoản</th>
                                        <th>Role</th>
                                        <th>Tình trạng</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{($value->is_admin == 1) ? 'Admin' : 'Khách hàng' }}</td>
                                        <td>{{($value->is_delete == 0) ? 'Đang hoạt động' : 'Đã xoá' }}</td>
                                        <td>
                                            <a href="{{ url('admin/admin/edit/' .$value->id) }}" class="btn btn-warning mx-1">
                                                Cập nhật
                                            </a>
                                            <a href="{{ url('admin/admin/delete/' .$value->id) }}" class="btn btn-danger">
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
        new DataTable('#account-table');
    </script>
@endsection
