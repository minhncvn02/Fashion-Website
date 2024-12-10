<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;

use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Blog::getRecord();
        return view('admin.blog.list', $data);
    }

    public function add(){
        $data['getCategory'] = BlogCategory::getRecordActive();
        return view('admin.blog.add', $data);
    }

    public function insert(Request $request){


        $blog = new Blog();
        $blog->title = trim($request->title);
        $blog->blog_category_id = trim($request->blog_category_id);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_description = trim($request->meta_description);
        $blog->meta_keywords = trim($request->meta_keywords);
        $blog->save();

        if(!empty($request->file('image_name'))){
            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/blog/', $filename);
            $blog->image_name = trim($filename);
        }
        $slug = Str::slug($request->title);
        $count = Blog::where('slug','=', $slug)->count();
        if(empty($count)){
            $blog->slug = $slug.'-'.$blog->id;
        } else {
            $blog->slug = trim($slug);
        }

        $blog->save();

        return redirect('admin/blog/list')->with('success', "Thêm tin tức mới thành công");
    }

    public function edit($id){
        $data['getCategory'] = BlogCategory::getRecordActive();
        $data['getRecord'] = Blog::getSingle($id);
        return view('admin.blog.edit', $data);
    }

    public function update($id, Request $request){

        $blog = Blog::getSingle($id);
        $blog->title = trim($request->title);
        $blog->blog_category_id = trim($request->blog_category_id);
        $blog->description = trim($request->description);
        $blog->status = trim($request->status);
        $blog->meta_title = trim($request->meta_title);
        $blog->meta_description = trim($request->meta_description);
        $blog->meta_keywords = trim($request->meta_keywords);
        $blog->save();

        if(!empty($request->file('image_name'))){
            if (!empty($blog->getImg())){
                unlink('upload/blog/'.$blog->image_name);
            }

            $file = $request->file('image_name');
            $ext = $file->getClientOriginalExtension();
            $randomStr = Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/blog/', $filename);
            $blog->image_name = trim($filename);
            $blog->save();
        }

        return redirect('admin/blog/list')->with('success', "Cập nhật tin tức thành công");
    }

    public function delete($id){
        $blog = Blog::getSingle($id);
        $blog->is_delete = 1;
        $blog->save();

        return redirect()->back()->with('success', "Xoá tin tức thành công");
    }
}
