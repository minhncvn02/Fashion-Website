<div class="products mb-3">
    <div class="row justify-content-center">
        @foreach ($getProduct as $value)
        @php
            $getProductImage = $value->getImgSingle($value->id);
        @endphp
        <div class="col-12 col-md-4 col-lg-4">
            <div class="product product-7">
                <figure class="product-media">
                    <a href="{{url($value->slug)}}">
                        @if (!empty($getProductImage) && !empty($getProductImage->getImg()))
                            <img style="height:280px;width:100%;object-fit:cover" src="{{$getProductImage->getImg()}}" alt="{{$value->title}}" class="product-image">
                        @endif
                        @if ($value->qty == 0)
                            <span style="position: absolute; top: 10px; right: 10px; background-color: rgba(255, 0, 0, 0.7); color: white; padding: 5px 10px; border-radius: 3px; font-size: 14px;"><b>Hết hàng</b></span>
                        @endif
                    </a>
                </figure>

                <div class="product-body">
                    <div class="product-cat">
                        <a href="{{url($value->category_slug.'/'.$value->sub_category_slug)}}">{{$value->sub_category_name}}</a>
                    </div>
                    <h3 class="product-title"><a href="{{url($value->slug)}}">{{$value->title}}</a></h3>
                    <div class="product-price">
                        @if($value->price != $value->old_price)
                        <s style="margin-right: 8px">{{number_format($value->old_price)}} VNĐ</s>
                        @endif
                        {{number_format($value->price)}} VNĐ
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


    {{-- <div class="pagination justify-content-center">
        {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
    </div> --}}

