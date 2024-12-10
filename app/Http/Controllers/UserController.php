<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function order(Request $request){
        if(!empty($request->noti_id)){
            Notification::updateReadNoti($request->noti_id);
        }
        $data['getRecord'] = Order::getRecordUser(Auth::user()->id);
        $data['meta_title'] = 'Đơn hàng';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.order', $data);
    }

    public function order_detail($id){
        $data['getRecord'] = Order::getSingleOrder(Auth::user()->id, $id);
        if(!empty($data['getRecord'])){
            $data['meta_title'] = 'Chi tiết đơn hàng';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            return view('user.order_detail', $data);
        } else {
            abort(404);
        }

    }

    public function editProfile(){

        $data['meta_title'] = 'Thông tin cá nhân';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        $data['getProfile'] = User::getUser(Auth::user()->id);

        return view('user.edit-profile', $data);
    }

    public function updateProfile(Request $request){
        $user = User::getUser(Auth::user()->id);

        $user->name = trim($request->name);
        $user->address = trim($request->address);
        $user->ward = trim($request->ward);
        $user->district = trim($request->district);
        $user->city = trim($request->city);
        $user->phone = trim($request->phone);
        $user->save();

        return redirect()->back()->with('success','Cập nhật thông tin thành công');
    }


    public function changePassword(){

        $data['meta_title'] = 'Đổi mật khẩu';
        $data['meta_description'] = '';
        $data['meta_keywords'] = '';

        return view('user.change-password', $data);
    }

    public function updatePassword(Request $request){
        $user = User::getUser(Auth::user()->id);

        if(Hash::check($request->old_password, $user->password)){
            if($request->password == $request->cpassword){
                $user->password = Hash::make($request->password);
                $user->save();

                return redirect()->back()->with('success','Đổi mật khẩu thành công');
            }else{
                return redirect()->back()->with('error','Mật khẩu mới không khớp');
            }
        }else{
            return redirect()->back()->with('error','Mật khẩu cũ không đúng');
        }


    }
}
