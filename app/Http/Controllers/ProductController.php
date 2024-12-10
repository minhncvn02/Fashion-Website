<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function getProductSearch(Request $request){

            $data['meta_title'] = 'Tìm kiếm';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            $getProduct = Product::getProduct();

            $page = 0;
            if(!empty($getProduct->nextPageUrl())){
                $parse_url = parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

            return view('product.list', $data);
    }

    public function getCategory($slug, $subslug = ''){
        $getProductSingle = Product::getSingleSlug($slug);
        $getCategory = Category::getSingleSlug($slug);
        $getSubCategory = SubCategory::getSingleSlug($subslug);

        $data['getColor'] = Color::getRecordActive();
        $data['getBrand'] = Brand::getRecordActive();

        if(!empty($getProductSingle)){
            $data['meta_title'] = $getProductSingle->title;
            $data['meta_description'] = $getProductSingle->short_description;

            $data['getRelatedProduct'] = Product::getRelatedProduct($getProductSingle->id, $getProductSingle->sub_category_id);

            $data['getProduct'] = $getProductSingle;

            return view('product.detail', $data);
        }

        else if(!empty($getCategory) && !empty($getSubCategory)){
            $data['meta_title'] = $getSubCategory->meta_title;
            $data['meta_description'] = $getSubCategory->meta_description;
            $data['meta_keywords'] = $getSubCategory->meta_keywords;

            $data['getCategory'] = $getCategory;
            $data['getSubCategory'] = $getSubCategory;

            $getProduct = Product::getProduct($getCategory->id, $getSubCategory->id);

            $page = 0;
            if(!empty($getProduct->nextPageUrl())){
                $parse_url = parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            return view('product.list', $data);
        }

        else if(!empty($getCategory)){

            $data['getSubCategoryFilter'] = SubCategory::getRecordSubCategory($getCategory->id);

            $data['getCategory'] = $getCategory;



            $data['meta_title'] = $getCategory->meta_title;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;

            $getProduct = Product::getProduct($getCategory->id);

            $page = 0;
            if(!empty($getProduct->nextPageUrl())){
                $parse_url = parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

            $data['getProduct'] = $getProduct;

            return view('product.list', $data);
        } else {
            abort(404);
        }
    }
    public function getFilterProductAjax(Request $request){
        $getProduct = Product::getProduct();

        $page = 0;
            if(!empty($getProduct->nextPageUrl)){
                $parse_url = parse_url($getProduct->nextPageUrl());
                if(!empty($parse_url['query'])){
                    parse_str($parse_url['query'], $get_array);
                    $page = !empty($get_array['page']) ? $get_array['page'] : 0;
                }
            }
            $data['page'] = $page;

        return response()->json([
            "status" => true,
            "page" => $page,
            "success" => view("product._list", ["getProduct" => $getProduct,])->render(),
        ], 200);
    }

}
