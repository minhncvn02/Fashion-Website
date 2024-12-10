@extends('layouts.app')
@section('style')
<style>
    .truncate {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="intro-section bg-lighter pt-5 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                        <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "responsive": {
                                    "768": {
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach($getSlider as $slider)
                            @if(!empty($slider->getImg()))
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="{{$slider->getImg()}}">
                                        <img src="{{$slider->getImg()}}" alt="{{$slider->title}}" class="slider-image">
                                    </picture>
                                </figure>
                                <div class="intro-content">
                                    <h1 class="intro-title">
                                        {!! $slider->title !!}
                                    </h1>
                                    @if (!empty($slider->button_link) && !empty($slider->button_name))
                                        <a href="{{ $slider->button_link }}" class="btn btn-outline-white">
                                            <span>{{ $slider->button_name }}</span>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <span class="slider-loader"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($getProductTrendy->count()))
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Sản phẩm nổi bật</h2>
        </div>

        <div class="tab-content tab-content-carousel">

            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                    data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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
                    @foreach($getProductTrendy as $value)
                    @php
                        $getProductImage = $value->getImgSingle($value->id);
                    @endphp
                        <div class="product product-7 text-center">
                            <figure class="product-media">
                                <a href="{{url($value->slug)}}">
                                    @if (!empty($getProductImage) && !empty($getProductImage->getImg()))
                                        <img style="height:280px;width:100%;object-fit:cover" src="{{$getProductImage->getImg()}}" alt="{{$value->title}}" class="product-image">
                                    @endif
                                </a>
                            </figure>

                            <div class="product-body">
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
    </div>
    @endif

    <div class="container">
        <div class="heading heading-center mb-6">
            <h2 class="title-lg">Sản phẩm mới</h2>

            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
                @foreach($getCategory as $category)
                <li class="nav-item">
                    <a class="nav-link getCategoryProduct" data-val="{{$category->id}}" id="top-{{$category->slug}}-link" data-toggle="tab" href="#top-{{$category->slug}}-tab" role="tab" aria-controls="top-{{$category->slug}}-tab" aria-selected="false">{{$category->name}}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    @include('product._list')
                </div>
                <div class="more-container text-center">
                    <a href="{{url('search')}}" class="btn btn-outline-darker btn-more"><span>Xem thêm</span></a>
                </div>
            </div>

            @foreach($getCategory as $category)
            <div class="tab-pane p-0 fade getCategoryProduct{{$category->id}}" id="top-{{$category->slug}}-tab" role="tabpanel" aria-labelledby="top-{{$category->slug}}-link">

            </div>
            @endforeach
        </div>

    </div>

    <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
        <div class="container">
           <h2 class="title-lg text-center mb-3 mb-md-4">Tin tức</h2>

            <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                    "nav": false,
                    "dots": true,
                    "items": 3,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "600": {
                            "items":2
                        },
                        "992": {
                            "items":3
                        }
                    }
                }'>
                @foreach($getBlog as $blog)
                <article class="entry entry-display">
                    <figure class="entry-media">
                        <a href="{{url('blog/'.$blog->slug)}}">
                            <img src="{{$blog->getImg()}}" style="height:300px;width:100%;object-fit:cover">
                        </a>
                    </figure>

                    <div class="entry-body pb-4 text-center">
                        <div class="entry-meta">
                            {{date('d/m/Y', strtotime($blog->created_at))}}
                        </div>

                        <h3 class="entry-title">
                            <a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a>
                        </h3><!-- End .entry-title -->

                        <div class="entry-content">
                            <div class="truncate">
                                <p>{!! $blog->description !!}</p>
                            </div>
                            <a href="{{url('blog/'.$blog->slug)}}" class="read-more">Xem</a>
                        </div><!-- End .entry-content -->
                    </div><!-- End .entry-body -->
                </article><!-- End .entry -->
                @endforeach

            </div>
        </div>

        <div class="more-container text-center mb-0 mt-3">
            <a href="{{url('blog')}}" class="btn btn-outline-darker btn-more"><span>Xem thêm</span></a>
        </div><!-- End .more-container -->
    </div>
</main><!-- End .main -->
@endsection

@section('script')
<script>
    $('body').delegate('.getCategoryProduct', 'click', function(){
        var category_id = $(this).attr('data-val');
        $.ajax({
            url: "{{url('recent_arrival_category_product')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                category_id : category_id,
            },
            dataType: "json",
            success: function(response){
                $('.getCategoryProduct'+category_id).html(response.success)
            }
        });
    });
</script>
@endsection



