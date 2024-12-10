@component('mail::message')
    Chào <b>{{$user->name}}</b>,
    <p>Bạn đã quên mật khẩu tài khoản Mango Store và muốn lấy lại mật khẩu,</p>
    <p>Bấm vào nút dưới đây để lấy lại mật khẩu tài khoản.</p>
    <p>
        @component('mail::button', ['url' => url('reset/'.$user->remember_token)])
            Quên mật khẩu
        @endcomponent
    </p>
@endcomponent
