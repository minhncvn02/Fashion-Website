@component('mail::message')
    Chào <b>{{$user->name}}</b>,
    <p>Bạn đã đăng ký tài khoản Mango Store,</p>
    <p>Bấm vào nút dưới đây để xác nhận tài khoản của bạn.</p>
    <p>
        @component('mail::button', ['url' => url('activate/'.base64_encode($user->id))])
            Xác nhận tài khoản
        @endcomponent
    </p>
    <p>Đây là bước xác nhận tài khoản, hãy bấm xác nhận để là thành viên chính thức của Mango Store và nhận nhiều ưu đãi khác.</p>
@endcomponent
