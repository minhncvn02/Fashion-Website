<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = DiscountCode::getRecord();
        return view('admin.discount_code.list', $data);
    }

    public function add(){
        return view('admin.discount_code.add');
    }

    public function insert(Request $request){

        $DiscountCode = new DiscountCode();
        $DiscountCode->name = trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
        $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        return redirect('admin/discount_code/list')->with('success', "Thêm mã giảm giá mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = DiscountCode::getSingle($id);
        return view('admin.discount_code.edit', $data);
    }

    public function update($id, Request $request){

        $DiscountCode = DiscountCode::getSingle($id);
        $DiscountCode->name = trim($request->name);
        $DiscountCode->type = trim($request->type);
        $DiscountCode->percent_amount = trim($request->percent_amount);
        $DiscountCode->expire_date = trim($request->expire_date);
        $DiscountCode->status = trim($request->status);
        $DiscountCode->save();

        return redirect('admin/discount_code/list')->with('success', "Cập nhật mã giảm giá thành công");
    }

    public function delete($id){
        $DiscountCode = DiscountCode::getSingle($id);
        $DiscountCode->is_delete = 1;
        $DiscountCode->save();

        return redirect()->back()->with('success', "Xoá mã giảm giá thành công");
    }
}
