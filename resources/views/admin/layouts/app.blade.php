<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="{{url('public/assets/plugins/fontawesome-free/css/all.min.css')}}">

    <link rel="stylesheet" href="{{url('public/assets/plugins/summernote/summernote-bs4.min.css')}}">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{url('public/assets/dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    @yield('style')
</head>
<body class="hold-transition sidebar-mini">
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    <div class="wrapper">
        @yield('content')
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.bootstrap5.js"></script>

<script src="{{url('public/assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('public/assets/dist/js/adminlte.js')}}"></script>
<script src="{{url('public/assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{url('public/assets/dist/js/demo.js')}}"></script>

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script src="{{url('public/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(function () {
      $('.note').summernote({
        height: 300
      })
    })
  </script>

@yield('script')
</body>
</html>
