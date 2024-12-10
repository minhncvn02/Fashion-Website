<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = SubCategory::getRecord();
        return view('admin.subcategory.list', $data);
    }

    public function add(){
        $data['getCategory'] = Category::getRecord();
        return view('admin.subcategory.add', $data);
    }

    public function insert(Request $request){
        request()->validate([
            'slug' => 'required|unique:sub_category',
        ]);

        $subcategory = new SubCategory();
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->created_by = Auth::user()->id;
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', "Thêm loại sản phẩm mới thành công");
    }

    public function edit($id){
        $data['getCategory'] = Category::getRecord();
        $data['getRecord'] = SubCategory::getSingle($id);
        return view('admin.subcategory.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,'.$id
        ]);

        $subcategory = SubCategory::getSingle($id);
        $subcategory->category_id = trim($request->category_id);
        $subcategory->name = trim($request->name);
        $subcategory->slug = trim($request->slug);
        $subcategory->status = trim($request->status);
        $subcategory->meta_title = trim($request->meta_title);
        $subcategory->meta_description = trim($request->meta_description);
        $subcategory->meta_keywords = trim($request->meta_keywords);
        $subcategory->save();

        return redirect('admin/sub_category/list')->with('success', "Cập nhật loại sản phẩm thành công");
    }
    public function delete($id){
        $category = SubCategory::getSingle($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->back()->with('success', "Xoá loại sản phẩm thành công");
    }

    public function get_sub_category(Request $request){
        $category_id = $request->id;
        $get_sub_category = SubCategory::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Chọn</option>';
        foreach ($get_sub_category as $value){
            $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
