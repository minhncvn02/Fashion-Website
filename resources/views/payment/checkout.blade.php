@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Thanh toán</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" style="text-transform:none" aria-current="page">Thanh toán</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="" id="SubmitForm" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Thông tin đặt hàng</h2>

                                <label>Họ và tên *</label>
                                <input type="text" name="name" value="{{!empty(Auth::user()->name) ? Auth::user()->name : ''}}" class="form-control" required>

                                <label>Địa chỉ *</label>
                                <input type="text" name="address" value="{{!empty(Auth::user()->address) ? Auth::user()->address : ''}}" class="form-control" placeholder="Ví dụ: 43/7, đường Trần Tấn" required>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Phường/Xã *</label>
                                        <input type="text" name="ward" value="{{!empty(Auth::user()->ward) ? Auth::user()->ward : ''}}" class="form-control" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Quận/Huyện *</label>
                                        <input type="text" name="district" value="{{!empty(Auth::user()->district) ? Auth::user()->district : ''}}" class="form-control" required>
                                    </div>

                                    <div class="col-sm-4">
                                        <label>Tỉnh/Thành phố *</label>
                                        <input type="text" name="city" value="{{!empty(Auth::user()->city) ? Auth::user()->city : ''}}" class="form-control" required>
                                    </div>
                                </div>

                                <label>Số điện thoại *</label>
                                <input type="tel" name="phone" value="{{!empty(Auth::user()->phone) ? Auth::user()->phone : ''}}" class="form-control" required>

                                <label>Email *</label>
                                <input type="email" name="email" value="{{!empty(Auth::user()->email) ? Auth::user()->email : ''}}" class="form-control" required>

                                @if (empty(Auth::check()))
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input createAccount" name="is_create" id="checkout-create-acc">
                                    <label class="custom-control-label" for="checkout-create-acc">Bạn có muốn tạo tài khoản?</label>
                                </div>

                                <div id="showPassword" style="display: none">
                                    <label>Mật khẩu *</label>
                                    <input type="text" id="inputPassword" name="password" class="form-control">
                                </div>
                                @endif

                                <label>Ghi chú</label>
                                <textarea class="form-control" name="note" cols="30" rows="4" placeholder=""></textarea>
                        </div>
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Đơn hàng của bạn</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Tổng</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach (Cart::getContent() as $key => $cart)
                                        @php
                                            $getCartProduct = App\Models\Product::getSingle($cart->id);
                                        @endphp
                                        <tr>
                                            <td><a href="{{url($getCartProduct->slug)}}">{{$getCartProduct->title}}</a></td>
                                            <td>{{number_format($cart->price * $cart->quantity)}} VNĐ</td>
                                        </tr>
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Giá:</td>
                                            <td>{{number_format(Cart::getSubTotal())}} VNĐ</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">
                                                    <div class="input-group">
                                                        <input type="text" name="discount_code" id="getDiscountCode" class="form-control"  placeholder="Mã giảm giá">
                                                        <div class="input-group-append">
                                                            <button id="ApplyDiscount" style="height:39px" type="button" class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Giảm giá:</td>
                                            <td><span id="getDiscountAmount"></span> VNĐ</td>
                                        </tr>

                                        <tr class="summary-shipping">
                                            <td>Ship:</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach ($getShipping as $shipping)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" value="{{$shipping->id}}" required name="shipping" id="{{$shipping->id}}" data-price="{{!empty($shipping->price) ? $shipping->price : 0}}" class="custom-control-input getShippingCharge">
                                                    <label class="custom-control-label" for="{{$shipping->id}}">{{$shipping->name}}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @if (!empty($shipping->price))
                                                {{number_format($shipping->price)}} VNĐ
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-total">
                                            <td>Tổng tiền:</td>
                                            <td><span id="getPayableTotal">{{number_format(Cart::getSubTotal())}}</span> VNĐ</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <input type="hidden" name="" id="getShippingChargeTotal" value="0">
                                <input type="hidden" name="" id="PayableTotal" value="{{Cart::getSubTotal()}}">

                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="payment_method" value="cash" id="cod" class="custom-control-input " required>
                                        <label class="custom-control-label" for="cod">Thanh toán khi nhận hàng</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" disabled name="payment_method" value="momo" id="momo" class="custom-control-input " required>
                                        <label class="custom-control-label" for="momo">Momo (chưa hoàn thành)</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Đặt hàng</span>
                                    <span class="btn-hover-text">Tiến hành thanh toán</span>
                                </button>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>

    $('body').delegate('.createAccount', 'change', function(){
        if(this.checked){
            $('#showPassword').show();
            $('#inputPassword').prop('required', true);
        } else {
            $('#showPassword').hide();
            $('#inputPassword').prop('required', false);
        }
    });


    $('body').delegate('#SubmitForm', 'submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "{{url('checkout/place_order')}}",
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data){
                if(data.status == false){
                    alert(data.message);
                } else {
                    window.location.href = data.redirect;
                }
            },
            error: function(data){

            }
        });
    });


    $('body').delegate('.getShippingCharge', 'change', function(){
        var price = $(this).attr('data-price');
        var total = $('#PayableTotal').val();
        $('#getShippingChargeTotal').val(price);

        var final_total = parseInt(price) + parseInt(total);

        $('#getPayableTotal').html(final_total);

    });


    $('body').delegate('#ApplyDiscount', 'click', function(){
            var discount_code = $('#getDiscountCode').val();

            $.ajax({
                type: "POST",
                url: "{{url('checkout/apply_discount_code')}}",
                data: {
                    discount_code: discount_code,
                    "_token": "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(data){
                    $('#getDiscountAmount').html(data.discount_amount);

                    var shipping = $('#getShippingChargeTotal').val();
                    var final_total = parseInt(shipping) + parseInt(data.payable_total);

                    $('#getPayableTotal').html(final_total);
                    $('#PayableTotal').val(data.payable_total);

                    if(data.status == false){
                        alert(data.message);
                    }
                },
                error: function(data){

                }
            });
        });
</script>
@endsection
