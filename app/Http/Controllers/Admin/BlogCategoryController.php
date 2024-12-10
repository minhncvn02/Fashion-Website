<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = BlogCategory::getRecord();
        return view('admin.blog_category.list', $data);
    }

    public function add(){
        return view('admin.blog_category.add');
    }

    public function insert(Request $request){
        request()->validate([
            'slug' => 'required|unique:blog_category',
        ]);

        $category = new BlogCategory();
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();

        return redirect('admin/blog_category/list')->with('success', "Thêm chủ đề tin tức mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = BlogCategory::getSingle($id);
        return view('admin.blog_category.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:blog_category,slug,'.$id
        ]);

        $category = BlogCategory::getSingle($id);
        $category->name = trim($request->name);
        $category->slug = trim($request->slug);
        $category->status = trim($request->status);
        $category->meta_title = trim($request->meta_title);
        $category->meta_description = trim($request->meta_description);
        $category->meta_keywords = trim($request->meta_keywords);
        $category->save();

        return redirect('admin/blog_category/list')->with('success', "Cập nhật chủ đề tin tức thành công");
    }

    public function delete($id){
        $category = BlogCategory::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Xoá chủ đề tin tức thành công");
    }
}
