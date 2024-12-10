@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Thông báo</h1>
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

                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td style="padding: 5px">
                                            <a style="color: black {{empty($value->is_read) ? 'font-style:italic' : ''}}" href="{{$value->url}}?noti_id={{$value->id}}">
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
