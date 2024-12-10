<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\ShippingCharge;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class SliderController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Slider::getRecord();
        return view('admin.slider.list', $data);
    }

    public function add(){
        return view('admin.slider.add');
    }

    public function insert(Request $request){

        $slider = new Slider;
        $slider->title = trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);

        $file = $request->file('image_name');
        $ext = $file->getClientOriginalExtension();
        $randomStr = Str::random(20);
        $filename = strtolower($randomStr).'.'.$ext;
        $file->move('upload/slider/', $filename);

        $slider->image_name = trim($filename);

        $slider->status = trim($request->status);
        $slider->save();

        return redirect('admin/slider/list')->with('success', "Thêm slider mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = Slider::getSingle($id);
        return view('admin.slider.edit', $data);
    }

    public function update($id, Request $request){

        $slider = Slider::getSingle($id);
        $slider->title = trim($request->title);
        $slider->button_name = trim($request->button_name);
        $slider->button_link = trim($request->button_link);

        if(!empty($request->file('image_name'))){
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/slider/', $filename);
            $slider->image_name = trim($filename);
        }

        $slider->status = trim($request->status);
        $slider->save();

        return redirect('admin/slider/list')->with('success', "Cập nhật slider thành công");
    }

    public function delete($id){
        $slider = Slider::getSingle($id);
        $slider->is_delete = 1;
        $slider->save();

        return redirect()->back()->with('success', "Xoá slider thành công");
    }
}
