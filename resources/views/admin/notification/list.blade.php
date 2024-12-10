@extends('admin.layouts.app')

@section('style')
@endsection

@section('title')
    Thông báo
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thông báo</h1>
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
                            <table id="noti-table" class="table table-striped" style="overflow:auto">
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>
                                            <a style="color: black {{empty($value->is_read) ? 'font-weight:bold' : ''}}" href="{{$value->url}}?noti_id={{$value->id}}">
                                                {{$value->message}}
                                            </a>
                                            <div>
                                                <small>{{date('d/m/Y h:i A', strtotime($value->created_at))}}</small>
                                            </div>
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
    new DataTable("#noti-table", {
        info: false,
        language: {
            search: "Tìm kiếm:",
        },
    });
</script>
@endsection
