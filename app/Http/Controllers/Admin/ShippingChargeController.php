<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingChargeController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = ShippingCharge::getRecord();
        return view('admin.shipping_charge.list', $data);
    }

    public function add(){
        return view('admin.shipping_charge.add');
    }

    public function insert(Request $request){

        $ShippingCharge = new ShippingCharge();
        $ShippingCharge->name = trim($request->name);
        $ShippingCharge->price = trim($request->price);
        $ShippingCharge->status = trim($request->status);
        $ShippingCharge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Thêm phí vận chuyển mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = ShippingCharge::getSingle($id);
        return view('admin.shipping_charge.edit', $data);
    }

    public function update($id, Request $request){

        $ShippingCharge = ShippingCharge::getSingle($id);
        $ShippingCharge->name = trim($request->name);
        $ShippingCharge->price = trim($request->price);
        $ShippingCharge->status = trim($request->status);
        $ShippingCharge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Cập nhật phí vận chuyển thành công");
    }

    public function delete($id){
        $ShippingCharge = ShippingCharge::getSingle($id);
        $ShippingCharge->is_delete = 1;
        $ShippingCharge->save();

        return redirect()->back()->with('success', "Xoá phí vận chuyển thành công");
    }
}
