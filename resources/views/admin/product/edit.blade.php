@extends('admin.layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
@endsection

@section('title')
    Cập nhật sản phẩm
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Cập nhật sản phẩm</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts._message')
                        <div class="card card-primary">
                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tiêu đề<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="title" required
                                                    value="{{ old('title', $product->title) }}" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Số lượng<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="qty" required
                                                    value="{{ old('qty', $product->qty) }}" placeholder="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Chủ đề<span style="color: red">*</span></label>
                                                <select class="form-control" id="ChangeCategory" name="category_id" required>
                                                    <option value="">Chọn</option>
                                                    @foreach ($getCategory as $category)
                                                        <option {{($product->category_id == $category->id) ? 'selected' : ''}} value="{{ $category->id }}"> {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Loại sản phẩm<span style="color: red">*</span></label>
                                                <select class="form-control" id="getSubCategory" name="sub_category_id" required>
                                                    <option value="">Chọn</option>
                                                    @foreach ($getSubCategory as $subcategory)
                                                        <option {{($product->sub_category_id == $subcategory->id) ? 'selected' : ''}} value="{{ $subcategory->id }}"> {{ $subcategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Thương hiệu<span style="color: red">*</span></label>
                                                <select class="form-control" name="brand_id" required>
                                                    @foreach ($getBrand as $brand)
                                                        <option {{($product->brand_id == $brand->id) ? 'selected' : ''}} value="{{ $brand->id }}"> {{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sản phẩm nổi bật</label>
                                                <div>
                                                    <input {{!empty($product->is_trendy) ? 'checked' : ''}} type="checkbox" name="is_trendy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Màu<span style="color: red">*</span></label>
                                                @foreach ($getColor as $color)
                                                    @php
                                                        $checked = '';
                                                    @endphp

                                                    @foreach ($product->getColor as $pcolor)
                                                        @if ($pcolor->color_id == $color->id)
                                                            @php
                                                                $checked = 'checked';
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    <div>
                                                        <label>
                                                            <input {{$checked}} type="checkbox" name="color_id[]"
                                                                value="{{ $color->id }}"> {{ $color->name }}
                                                        </label>
                                                    </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá gốc<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="old_price" required
                                                    value="{{!empty($product->old_price) ? $product->old_price : ''}}" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Giá khuyến mãi<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" name="price" required
                                                    value="{{ !empty($product->price) ? $product->price : '' }}" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kích cỡ<span style="color: red">*</span></label>
                                                <div>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên</th>
                                                                <th>Giá tiền</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="AppendSize">
                                                            @php
                                                                $i_s = 1;
                                                            @endphp
                                                            @foreach ($product->getSize as $size)
                                                            <tr id="DeleteSize{{$i_s}}">
                                                                <td>
                                                                    <input type="text" value="{{$size->name}}" name="size[{{$i_s}}][name]" placeholder="S, M, L, XL, ..."
                                                                    class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text" value="{{$size->price}}" name="size[{{$i_s}}][price]" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <button type="button" id="{{$i_s}}" class="btn btn-danger btn-sm DeleteSize">Delete</button>
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $i_s++;
                                                            @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td>
                                                                    <input type="text"  name="size[100][name]" placeholder="S, M, L, XL, ..."  class="form-control">
                                                                </td>
                                                                <td>
                                                                    <input type="text"  name="size[100][price]" class="form-control">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-primary btn-sm AddSize">Thêm</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Hình ảnh<span style="color: red">*</span></label>
                                                <input type="file" name="image[]" class="form-control" multiple accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                    @if (!empty($product->getImg()->count()))
                                    <div class="row" id="sortable">
                                        @foreach ($product->getImg as $image)
                                            @if (!@empty($image->getImg()))
                                            <div class="col-md-1 sortable_image" id="{{$image->id}}" style="text-align: center">
                                                <img style="width:100%;height:100px" src="{{$image->getImg()}}" alt="">
                                                <a onclick="return confirm('Bạn có chắc chắn muốn xoá?');"
                                                href="{{url('admin/product/image_delete/'.$image->id)}}" style="margin-top:10px"
                                                class="btn btn-danger btn-sm">Xoá</a>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Thông tin sản phẩm<span style="color: red">*</span></label>
                                                <textarea name="short_description" class="form-control note" id="short-editor"  placeholder="">
                                                    {{ old('short_description', $product->short_description) }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Thông tin chi tiết<span style="color: red">*</span></label>
                                                <textarea name="description" class="form-control note" id="editor" placeholder="">
                                                    {{ old('description', $product->description) }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tình trạng <span style="color: red">*</span></label>
                                                <select class="form-control" name="status" required>
                                                    <option {{ (old('status', $product->status == 1)) ? 'selected' : '' }} value="1">Còn
                                                    </option>
                                                    <option {{ (old('status', $product->status == 0)) ? 'selected' : '' }} value="0">Hết
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $( "#sortable" ).sortable({
            update: function(event, ui){
                var photo_id = new Array();
                $('.sortable_image').each(function(){
                    var id = $(this).attr('id');
                    photo_id.push(id);
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/product_image_sortable') }}",
                    data: {
                        "photo_id": photo_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data){

                    },
                    error: function(data){

                    }
                });
            }
        });
    });

    var i = 101;
    $('body').delegate('.AddSize', 'click', function () {
        var html = '<tr id="DeleteSize'+i+'">\n\
                        <td>\n\
                            <input type="text" name="size['+i+'][name]" class="form-control">\n\
                        </td>\n\
                        <td>\n\
                            <input type="text" name="size['+i+'][price]" class="form-control">\n\
                        </td>\n\
                        <td>\n\
                            <button type="button" id="'+i+'" class="btn btn-danger btn-sm DeleteSize">Xoá</button>\n\
                        </td>\n\
                    </tr>';
            i++;
        $('#AppendSize').append(html);
    });

    $('body').delegate('.DeleteSize', 'click', function () {
        var id = $(this).attr('id');
        $('#DeleteSize'+id).remove();
    });

    $('body').delegate('#ChangeCategory', 'change', function(e){
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "{{ url('admin/get_sub_category') }}",
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data){
                $('#getSubCategory').html(data.html);
            },
            error: function(data){

            }
        });
    });
</script>


@endsection
