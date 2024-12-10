<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Category::getRecord();
        return view('admin.category.list', $data);
    }

    public function add(){
        return view('admin.category.add');
    }

    public function insert(Request $request){
        request()->validate([
            'slug' => 'required|unique:category',
        ]);

        $category = new Category();
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->created_by = Auth::user()->id;
        $category->save();

        return redirect('admin/category/list')->with('success', "Thêm chủ đề sản phẩm mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = Category::getSingle($id);
        return view('admin.category.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:category,slug,'.$id
        ]);

        $category = Category::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();

        return redirect('admin/category/list')->with('success', "Cập nhật chủ đề sản phẩm thành công");
    }

    public function delete($id){
        $category = Category::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Xoá chủ đề sản phẩm thành công");
    }
}
