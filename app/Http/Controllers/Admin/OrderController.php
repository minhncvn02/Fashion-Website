<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function list(){
        $data['getRecord'] = Order::getRecord();
        return view('admin.order.list', $data);
    }

    public function order_detail($id, Request $request){
        if(!empty($request->noti_id)){
            Notification::updateReadNoti($request->noti_id);
        }

        $data['getRecord'] = Order::getSingle($id);
        return view('admin.order.detail', $data);
    }

    public function order_status(Request $request){
        $getOrder = Order::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        $user_id = $getOrder->user_id;
        $url = url('admin/order/list');
        $message = "Tình trạng đơn hàng ".$getOrder->order_number." đã được cập nhật";
        Notification::insertRecord($user_id, $url, $message);

        $json['message'] = "Tình trạng đơn hàng đã được cập nhật";
        return json_encode($json);
    }
}
