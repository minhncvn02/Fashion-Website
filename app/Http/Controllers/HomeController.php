<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Notification;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function home(){
        $data['getBlog'] = Blog::getRecordActiveHome();
        $data['getSlider'] = Slider::getRecordActive();
        $data['getCategory'] = Category::getRecordActive();
        $data['getProduct'] = Product::getRecentArrival();
        $data['getProductTrendy'] = Product::getProductTrendy();

        $data['meta_title'] = 'Mango Shop';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('home', $data);
    }

    public function recent_arrival_category_product(Request $request){
        $getProduct = Product::getRecentArrival();
        $getCategory = Category::getSingle($request->category_id);

        return response()->json([
            "status" => true,
            "success" => view("product._list_recent_arrival", [
                "getProduct" => $getProduct,
                "getCategory" => $getCategory,
                ])->render(),
        ], 200);
    }

    public function blog(){
        $data['getBlog'] = Blog::getBlog();

        $data['meta_title'] = 'Tin tức';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getPopular'] = Blog::getPopular();

        return view('blog.list', $data);
    }

    public function blog_detail($slug){
        $getBlog = Blog::getSingleSlug($slug);
        if(!empty($getBlog)){
            $total_view = $getBlog->total_view;
            $getBlog->total_view = $total_view + 1;
            $getBlog->save();


            $data['getBlog'] = $getBlog;

            $data['meta_title'] = $getBlog->meta_title;
            $data['meta_description'] = $getBlog->meta_description;
            $data['meta_keywords'] = $getBlog->meta_keywords;

            $data['getPopular'] = Blog::getPopular();

            return view('blog.detail', $data);
        } else {
            abort(404);
        }
    }

    public function notification(Request $request){


        $data['meta_title'] = 'Thông báo';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getRecord'] = Notification::getRecordUser(Auth::user()->id);

        return view('user.notification', $data);
    }



}
