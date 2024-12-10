<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Brand::getRecord();
        return view('admin.brand.list', $data);
    }

    public function add(){
        return view('admin.brand.add');
    }

    public function insert(Request $request){
        request()->validate([
            'slug' => 'required|unique:brand',
        ]);

        $brand = new Brand();
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->created_by = Auth::user()->id;
        $brand->save();

        return redirect('admin/brand/list')->with('success', "Thêm thương hiệu sản phẩm mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = Brand::getSingle($id);
        return view('admin.brand.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:brand,slug,'.$id
        ]);

        $brand = Brand::getSingle($id);
        $brand->name = trim($request->name);
        $brand->slug = trim($request->slug);
        $brand->status = trim($request->status);
        $brand->meta_title = trim($request->meta_title);
        $brand->meta_description = trim($request->meta_description);
        $brand->meta_keywords = trim($request->meta_keywords);
        $brand->save();

        return redirect('admin/brand/list')->with('success', "Cập nhật thương hiệu sản phẩm thành công");
    }

    public function delete($id){
        $brand = Brand::getSingle($id);
        $brand->is_delete = 1;
        $brand->save();

        return redirect()->back()->with('success', "Xoá thương hiệu sản phẩm thành công");
    }
}
