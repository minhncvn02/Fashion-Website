@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Loại sản phẩm
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Loại sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')
            <a href="{{ url('admin/subcategory/add') }}" class="btn btn-primary mx-2 my-2">
                Tạo loại sản phẩm
            </a>
            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="sub-category-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Tên chủ đề</th>
                                        <th>Tên loại</th>
                                        <th>Slug</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keywords</th>
                                        <th>Tạo bởi</th>
                                        <th>Tạo vào ngày</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>

                                        <td>{{$value->category_name}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->slug}}</td>
                                        <td>{{$value->meta_title}}</td>
                                        <td>{{$value->meta_description}}</td>
                                        <td>{{$value->meta_keywords}}</td>
                                        <td>{{($value->created_by_name)}}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/sub_category/edit/' .$value->id) }}" class="btn btn-warning mx-1">
                                                Cập nhật
                                            </a>
                                            <a href="{{ url('admin/sub_category/delete/' .$value->id) }}" class="btn btn-danger">
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
    new DataTable("#sub-category-table", {
        info: false,
        language: {
            search: "Tìm kiếm:",
        },
    });
</script>
@endsection
