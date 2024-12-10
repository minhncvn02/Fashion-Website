@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Tin tức
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tin tức</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.layouts._message')
            <a href="{{ url('admin/blog/add') }}" class="btn btn-primary mx-2 my-2">
                Tạo tin tức
            </a>
            <div class="container-fluid">
                <div class="md-6">
                    <div class="card">
                        <div class="card-body">
                            <table id="blog-table" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tiêu đề</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keywords</th>
                                        <th>Tạo vào ngày</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>
                                            @if (!empty($value->getImg()))
                                                <img src="{{ $value->getImg() }}" style="height:100px;width:100%;object-fit:cover">
                                            @endif
                                        </td>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->meta_title}}</td>
                                        <td>{{$value->meta_description}}</td>
                                        <td>{{$value->meta_keywords}}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/blog/edit/' .$value->id) }}" class="btn btn-warning mx-1">
                                                Cập nhật
                                            </a>
                                            <a href="{{ url('admin/blog/delete/' .$value->id) }}" class="btn btn-danger">
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
    new DataTable("#blog-table", {
        info: false,
        language: {
            search: "Tìm kiếm:",
        },
    });
</script>
@endsection
