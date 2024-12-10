<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link text-center">
        <span class="brand-text font-weight-light">Mango Store</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar ">
        <div class="user-panel mt-3 pb-3 mb-3 text-center">
            <div class="text-light">Chào mừng</div>
              <a href="#" class="d-block ">
                 {{Auth::user()->email}}
              </a>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('admin/dashboard')}}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif" >
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/admin/list')}}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
                        <p>
                            Tài khoản
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/order/list')}}" class="nav-link @if(Request::segment(2) == 'order') active @endif">
                        <p>
                            Đơn hàng
                        </p>
                    </a>
                </li>

                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <p>
                            Phân loại sản phẩm
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{url('admin/category/list')}}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
                                <p>
                                    Chủ đề sản phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/sub_category/list')}}" class="nav-link @if(Request::segment(2) == 'sub_category') active @endif">
                                <p>
                                    Loại sản phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/brand/list')}}" class="nav-link @if(Request::segment(2) == 'brand') active @endif">
                                <p>
                                    Thương hiệu sản phẩm
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('admin/color/list')}}" class="nav-link @if(Request::segment(2) == 'color') active @endif">
                                <p>
                                    Màu sản phẩm
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/product/list')}}" class="nav-link @if(Request::segment(2) == 'product') active @endif">
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/discount_code/list')}}" class="nav-link @if(Request::segment(2) == 'discount_code') active @endif">
                        <p>
                            Mã giảm giá
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/shipping_charge/list')}}" class="nav-link @if(Request::segment(2) == 'shipping_charge') active @endif">
                        <p>
                            Phí vận chuyển
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/slider/list')}}" class="nav-link @if(Request::segment(2) == 'slider') active @endif">
                        <p>
                            Slider
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/blog_category/list')}}" class="nav-link @if(Request::segment(2) == 'blog_category') active @endif">
                        <p>
                            Chủ đề tin tức
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{url('admin/blog/list')}}" class="nav-link @if(Request::segment(2) == 'blog') active @endif">
                        <p>
                            Tin tức
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/logout') }}" class="nav-link">
                        <p>
                            Đăng xuất
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
