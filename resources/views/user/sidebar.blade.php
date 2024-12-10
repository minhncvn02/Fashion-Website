<aside class="col-md-4 col-lg-3 mt-2">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        <li class="nav-item">
            <a href="{{url('user/order')}}" class="nav-link @if(Request::segment(2) == 'order') active @endif" >Đơn hàng</a>
        </li>
        <li class="nav-item">
            <a href="{{url('user/edit-profile')}}" class="nav-link @if(Request::segment(2) == 'edit-profile') active @endif" >Thông tin cá nhân</a>
        </li>
        <li class="nav-item">
            @php
                $getUnreadNotificationCount = App\Models\Notification::getUnreadNotificationCount(Auth::user()->id);
            @endphp
            <a href="{{url('user/notification')}}" class="nav-link @if(Request::segment(2) == 'notification') active @endif" >Thông báo ({{$getUnreadNotificationCount}})</a>
        </li>
        <li class="nav-item">
            <a href="{{url('user/change-password')}}" class="nav-link @if(Request::segment(2) == 'change-password') active @endif" >Đổi mật khẩu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('logout')}}">Đăng xuất</a>
        </li>
    </ul>
</aside>
