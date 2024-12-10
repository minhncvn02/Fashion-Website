<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Color::getRecord();
        return view('admin.color.list', $data);
    }

    public function add(){
        return view('admin.color.add');
    }

    public function insert(Request $request){

        $color = new Color();
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color/list')->with('success', "Thêm màu sản phẩm mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = Color::getSingle($id);
        return view('admin.color.edit', $data);
    }

    public function update($id, Request $request){

        $color = Color::getSingle($id);
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->save();

        return redirect('admin/color/list')->with('success', "Cập nhật màu sản phẩm thành công");
    }

    public function delete($id){
        $color = Color::getSingle($id);
        $color->is_delete = 1;
        $color->save();

        return redirect()->back()->with('success', "Xoá màu sản phẩm thành công");
    }
}
