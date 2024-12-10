@extends('layouts.app')

@section('style')

@endsection

@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Giỏ hàng</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item active" style="text-transform:none" aria-current="page">Giỏ hàng</li>
            </ol>
        </div>
    </nav>
    <div class="page-content">
        <div class="cart">
            <div class="container">
                @include('layouts._message')
                @if (!empty(Cart::getContent()->count()))
                <div class="row">
                    <div class="col-lg-9">
                    <form action="{{url('update_cart')}}" method="POST">
                        {{ csrf_field() }}
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá (VNĐ)</th>
                                    <th>Số lượng</th>
                                    <th>Tổng (VNĐ)</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach (Cart::getContent() as $key => $cart)
                                @php
                                    $getCartProduct = App\Models\Product::getSingle($cart->id);
                                @endphp
                                @if (!empty($getCartProduct))
                                    @php
                                        $getProductImage = $getCartProduct->getImgSingle($getCartProduct->id);
                                    @endphp
                                <tr>
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="#">
                                                    <img src="{{$getProductImage->getImg()}}" alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{url($getCartProduct->slug)}}">{{$getCartProduct->title}}</a>
                                            </h3>
                                        </div>
                                    </td>
                                    <td class="price-col">{{number_format($cart->price)}} </td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <input type="number" class="form-control" value="{{$cart->quantity}}"
                                            min="1" name="cart[{{$key}}][qty]" max="100" step="1" data-decimals="0" required>

                                            <input type="hidden" value="{{$cart->id}}" name="cart[{{$key}}][id]">
                                        </div>
                                    </td>
                                    <td class="total-col">{{number_format($cart->price * $cart->quantity)}} </td>
                                    <td class="remove-col"><a href="{{url('cart/delete/'.$cart->id)}}" class="btn-remove"><i class="icon-close"></i></a></td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                        </table>

                        <div class="cart-bottom">
                            <button type="submit" class="btn btn-outline-dark-2"><span>CẬP NHẬT GIỎ HÀNG</span><i class="icon-refresh"></i></button>
                        </div>
                    </form>
                    </div>
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">GIỎ HÀNG</h3><!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Giá:</td>
                                        <td>{{number_format(Cart::getSubTotal())}} VNĐ</td>
                                    </tr>

                                    <tr class="summary-total">
                                        <td>Tổng tiền:</td>
                                        <td>{{number_format(Cart::getSubTotal())}} VNĐ</td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="{{url('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">THANH TOÁN</a>
                        </div>

                        <a href="{{url('')}}" class="btn btn-outline-dark-2 btn-block mb-3"><span>TIẾP TỤC MUA HÀNG</span><i class="icon-refresh"></i></a>
                    </aside><!-- End .col-lg-3 -->
                </div>
                @else
                <p>Giỏ hàng trống</p>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')

@endsection
