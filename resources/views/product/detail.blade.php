@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{url('assets/css/plugins/nouislider/nouislider.css')}}">
@endsection

@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item" style="text-transform:none"><a href="{{url($getProduct->getCategory->slug)}}">{{$getProduct->getCategory->name}}</a></li>
                <li class="breadcrumb-item" style="text-transform:none"><a href="{{url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a></li>
                <li class="breadcrumb-item active" style="text-transform:none" aria-current="page">{{$getProduct->title}}</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                    $getProductImage = $getProduct->getImgSingle($getProduct->id);
                                @endphp
                                @if (!empty($getProductImage) && !empty($getProductImage->getImg()))
                                <img id="product-zoom" src="{{$getProductImage->getImg()}}" data-zoom-image="{{$getProductImage->getImg()}}"
                                    style="max-width: 100%; height: auto; object-fit: contain;">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getProduct->getImg as $img)
                                <a class="product-gallery-item" href="#" data-image="{{$img->getImg()}}" data-zoom-image="{{$img->getImg()}}">
                                    <img src="{{$img->getImg()}}" alt="product side">
                                </a>
                                @endforeach
                            </div>
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{$getProduct->title}}</h1><!-- End .product-title -->

                            <div class="product-price">
                                <span id="getTotalPrice">{{ number_format($getProduct->price) }} VNĐ
                                    @if($getProduct->price != $getProduct->old_price)
                                    <s style="margin-left: 8px">{{number_format($getProduct->old_price)}} VNĐ</s>
                                    @endif
                                </span>
                            </div>

                            <div class="product-content">
                                {!! $getProduct->short_description !!}
                            </div>

                        <form action="{{url('product/add-to-cart')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="product_id" value="{{$getProduct->id}}" id="">
                            @if (!empty($getProduct->getColor->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="color">Màu:</label>
                                <div class="select-custom">
                                    <select name="color_id" id="color_id" required class="form-control">
                                        <option value="">Chọn</option>
                                        @foreach ($getProduct->getColor as $color)
                                        <option value="{{$color->getColor->id}}">{{$color->getColor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            @if (!empty($getProduct->getSize->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Kích cỡ:</label>
                                <div class="select-custom">
                                    <select name="size_id" id="size" required class="form-control getSizePrice">
                                        <option data-price="0" value="">Chọn</option>
                                        @foreach ($getProduct->getSize as $size)
                                        <option data-price="{{!empty($size->price) ? $size->price : 0}}" value="{{$size->id}}">{{$size->name}}
                                            @if (!empty($size->price))
                                                ({{number_format($size->price)}} VNĐ)
                                            @endif
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Số lượng:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" class="form-control" value="1" min="1" max="{{ $getProduct->qty }}" name="qty" required step="1" data-decimals="0" required>
                                </div>
                            </div>

                            <div class="product-details-action">
                                <button type="submit" class="btn-product btn-cart" {{ $getProduct->qty > 0 ? '' : 'disabled' }}>
                                    {{ $getProduct->qty > 0 ? 'THÊM VÀO GIỎ' : 'HẾT HÀNG' }}
                                </button>
                            </div>
                        </form>

                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Chủ đề:</span>
                                    <a href="{{url($getProduct->getCategory->slug)}}">{{$getProduct->getCategory->name}}</a>, <a href="{{url($getProduct->getCategory->slug.'/'.$getProduct->getSubCategory->slug)}}">{{$getProduct->getSubCategory->name}}</a>
                                </div><!-- End .product-cat -->

                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->
        </div><!-- End .container -->

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">THÔNG TIN CHI TIẾT</a>
                    </li>

                </ul>
            </div><!-- End .container -->

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top:20px;">
                            {!! $getProduct->description !!}
                        </div>
                    </div><!-- End .product-desc-content -->
                </div><!-- .End .tab-pane -->


            </div><!-- End .tab-content -->
        </div><!-- End .product-details-tab -->

        <div class="container">
            <h2 class="title text-center mb-4">BẠN CÓ THỂ THÍCH</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach ($getRelatedProduct as $value)
                @php
                    $getProductImage = $value->getImgSingle($value->id);
                @endphp
                <div class="product product-7 text-center" >
                    <figure class="product-media">
                        <a href="{{url($value->slug)}}">
                            @if (!empty($getProductImage) && !empty($getProductImage->getImg()))
                            <img style="height:280px;width:100%;object-fit:cover" src="{{$getProductImage->getImg()}}" alt="{{$value->title}}" class="product-image">
                            @endif
                        </a>
                    </figure>

                    <div class="product-body" >
                        <div class="product-cat">
                            <a href="{{url($value->category_slug.'/'.$value->sub_category_slug)}}">{{$value->sub_category_name}}</a>
                        </div>
                        <h3 class="product-title"><a href="{{url($value->slug)}}">{{$value->title}}</a></h3>
                        <div class="product-price">
                            {{number_format($value->price)}} VNĐ
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="{{url('assets/js/bootstrap-input-spinner.js')}}"></script>
<script src="{{url('assets/js/jquery.elevateZoom.min.js')}}"></script>

<script>
    $('.getSizePrice').change(function(){
        var prduct_price = '{{$getProduct->price}}';
        var price = $('option:selected', this).attr('data-price');
        var total = parseInt(prduct_price) + parseInt(price);
        $('#getTotalPrice').html(total);
    });

    $(document).ready(function() {
        $('#qty').on('input', function() {
            var max = parseInt($(this).attr('max'));
            var value = parseInt($(this).val());
            if (value > max) {
                $(this).val(max);
            }
        });
    });
</script>
@endsection
