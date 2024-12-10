<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            @if (!empty(Auth::check()))
                                <li><a href="{{url('user/order')}}"><i class="icon-user"></i>{{Auth::user()->name}}</a></li>
                                <li><a href="{{url('logout')}}"></i>Đăng xuất</a></li>
                            @else
                                <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Đăng nhập</a></li>
                            @endif

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">

                <a href="{{url('')}}" class="logo">
                    <img src="{{url('assets/images/logo_mango_mobile.jpg')}}" alt="" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class="active">
                            <a href="{{url('')}}">Home</a>
                        </li>
                        <li>
                            <a href="javascript:;" class="sf-with-ul">Chủ đề</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-12">
                                        <div class="menu-col">
                                            <div class="row">
                                                @php
                                                    $getCategoryHeader = App\Models\Category::getRecordMenu();
                                                @endphp
                                                @foreach ($getCategoryHeader as $value_h_c)
                                                <div class="col-md-4" style="margin-bottom:20px">
                                                    <a href="{{url($value_h_c->slug)}}" class="menu-title">{{$value_h_c->name}}</a>
                                                    <ul>
                                                        @foreach ($value_h_c->getSubCategory as $value_h_sub)

                                                            <li><a href="{{url($value_h_c->slug.'/'.$value_h_sub->slug)}}">{{$value_h_sub->name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li>
                            <a href="{{url('blog')}}">Tin tức</a>
                        </li>

                    </ul>
                </nav>
            </div>

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{url('search')}}" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Tìm kiếm</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="" value="{{!empty(Request::get('q')) ? Request::get('q') : ''}}" required>
                        </div>
                    </form>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{Cart::getContent()->count()}}</span>
                    </a>
                    @if (!empty(Cart::getContent()->count()))
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            @foreach (Cart::getContent() as $header_cart)
                                @php
                                    $getCartProduct = App\Models\Product::getSingle($header_cart->id);
                                @endphp
                                @if (!empty($getCartProduct))
                                    @php
                                        $getProductImage = $getCartProduct->getImgSingle($getCartProduct->id);
                                    @endphp
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="{{url($getCartProduct->slug)}}">{{$getCartProduct->title}}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty">{{$header_cart->quantity}}</span>
                                                x {{number_format($header_cart->price)}} VNĐ
                                            </span>
                                        </div>

                                        <figure class="product-image-container">
                                            <a href="{{$getCartProduct->slug}}" class="product-image">
                                                <img src="{{$getProductImage->getImg()}}" alt="product">
                                            </a>
                                        </figure>
                                        <a href="{{url('cart/delete/'.$header_cart->id)}}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                    </div>
                                @endif
                            @endforeach

                        </div>

                        <div class="dropdown-cart-total">
                            <span>Tổng tiền</span>

                            <span class="cart-total-price">{{number_format(Cart::getSubTotal())}} VNĐ</span>
                        </div>

                        <div class="dropdown-cart-action">
                            <a href="{{url('cart')}}" class="btn btn-primary">Giỏ hàng</a>
                            <a href="{{url('checkout')}}" class="btn btn-outline-primary-2"><span>Thanh toán</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</header>
