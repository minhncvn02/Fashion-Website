<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @php
          $getUnreadNotification = App\Models\Notification::getUnreadNotification();
      @endphp
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{$getUnreadNotification->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{$getUnreadNotification->count()}} thông báo</span>
            @foreach($getUnreadNotification as $noti)
            <div class="dropdown-divider"></div>
            <a href="{{$noti->url}}?noti_id={{$noti->id}}" class="dropdown-item">
                <div>{{$noti->message}}</div>
                <div class="text-muted text-sm">{{date('d/m/Y h:i A', strtotime($noti->created_at))}}</div>
            </a>
            <div class="dropdown-divider"></div>
            @endforeach
          <a href="{{url('admin/notification')}}" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
        </div>
      </li>
    </ul>
  </nav>
