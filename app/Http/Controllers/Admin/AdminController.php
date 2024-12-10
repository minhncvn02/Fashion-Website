<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function list(Request $request){
        if(!empty($request->noti_id)){
            Notification::updateReadNoti($request->noti_id);
        }
        $data['getRecord'] = User::getUsersInfo();
        return view('admin.admin.list', $data);
    }

    public function add(){
        return view('admin.admin.add');
    }

    public function insert(Request $request){
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = $request->role;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Thêm tài khoản mới thành công");
    }

    public function edit($id){
        $data['getRecord'] = User::getUser($id);
        return view('admin.admin.edit', $data);
    }

    public function update($id, Request $request){
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::getUser($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->is_admin = $request->role;
        $user->save();

        return redirect('admin/admin/list')->with('success', "Cập nhật tài khoản thành công");
    }

    public function delete($id){
        $user = User::getUser($id);
        $user->is_delete = 1;
        $user->save();

        return redirect()->back()->with('success', "Xoá tài khoản thành công");
    }
}
