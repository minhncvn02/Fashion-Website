<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Product::getRecord();
        return view('admin.product.list', $data);
    }
    public function add(){
        return view('admin.product.add');
    }

    public function insert(Request $request){

        $title = trim($request->title);
        $product = new Product;
        $product->title = $title;
        $product->created_by = Auth::user()->id;
        $product->save();


        $slug = Str::slug($title, "-");

        $checkSlug = Product::checkSlug($slug);
        if(empty($checkSlug)){
            $product->slug = $slug;
            $product->save();
        } else{
            $new_slug = $slug.'-'.$product->id;
            $product->slug = $new_slug;
            $product->save();
        }

        return redirect('admin/product/edit/' .$product->id);
    }

    public function edit($product_id){
        $product = Product::getSingle($product_id);

        if(!empty($product)){
            $data['getCategory'] = Category::getRecordActive();
            $data['getBrand'] = Brand::getRecordActive();
            $data['getColor'] = Color::getRecordActive();
            $data['product'] = $product;
            $data['getSubCategory'] = SubCategory::getRecordSubCategory($product->category_id);
            return view('admin.product.edit', $data);
        }
    }

    public function update($product_id, Request $request){
        $product = Product::getSingle($product_id);

        if(!empty($product)){

            $product->title = trim($request->title);
            $product->qty = trim($request->qty);
            $product->category_id = trim($request->category_id);
            $product->sub_category_id = trim($request->sub_category_id);
            $product->brand_id = trim($request->brand_id);
            $product->is_trendy = !empty($request->is_trendy) ? 1 : 0;
            $product->price = trim($request->price);
            $product->old_price = trim($request->old_price);
            $product->short_description = trim($request->short_description);
            $product->description = trim($request->description);
            $product->status = trim($request->status);
            $product->save();

            ProductColor::DeleteRecord($product->id);
            if(!empty($request->color_id)){
                foreach($request->color_id as $color_id){
                    $color = new ProductColor;
                    $color->color_id = $color_id;
                    $color->product_id = $product->id;
                    $color->save();
                }
            }

            ProductSize::DeleteRecord($product->id);
            if(!empty($request->size)){
                foreach($request->size as $size){
                    if(!empty($size['name'])){
                        $saveSize = new ProductSize;
                        $saveSize->name = $size['name'];
                        $saveSize->price = !empty($size['price']) ? $size['price'] : 0;
                        $saveSize->product_id = $product->id;
                        $saveSize->save();
                    }
                }
            }


            if(!empty($request->file('image'))){
                foreach($request->file('image') as $value ){
                   if($value->isValid()){
                        $ext = $value->getClientOriginalExtension();
                        $randomStr = $product->id.Str::random(20);
                        $filename = strtolower($randomStr).'.'.$ext;
                        $value->move('upload/product/', $filename);

                        $imageupload = new ProductImage;
                        $imageupload->image_name = $filename;
                        $imageupload->image_extension = $ext;
                        $imageupload->product_id = $product->id;
                        $imageupload->save();
                   }
                }
            }
            return redirect()->back()->with('success', "Cập nhật sản phẩm thành công");
        } else{
            abort(404);
        }
    }

    public function image_delete($id){
        $image = ProductImage::getSingle($id);

        if(!empty($image->getImg())){
            unlink('upload/product/'.$image->image_name);
        }
        $image->delete();

        return redirect()->back()->with('success', "Xoá hình ảnh sản phẩm thành công");
    }

    public function product_image_sortable(Request $request){
        if(!empty($request->photo_id)){
            $i = 1;
            foreach($request->photo_id as $photo_id){
                $image = ProductImage::getSingle($photo_id);
                $image->order_by = $i;
                $image->save();
                $i++;
            }
        }
        $json['success'] = true;
        echo json_encode($json);
    }
}
