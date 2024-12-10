<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login_admin(){
        if(!empty(Auth::check()) && Auth::user()->is_admin == 1){
            return redirect('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function auth_login_admin(Request $request){
        $remember = !empty($request->remeber) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => 1, 'status' => 1, 'is_delete' => 0] , $remember)){
            return redirect('admin/dashboard');
        } else{
            return redirect()->back()->with('error', "Xin vui lòng nhập lại email và mật khẩu");
        }
    }

    public function logout_admin(){
        Auth::logout();
        return redirect('admin');
    }

    public function auth_register(Request $request){
        $checkEmail = User::checkEmail( $request->email );
        if(empty($checkEmail)){
            $save = new User;
            $save->name = trim($request->name);
            $save->email = trim($request->email);
            $save->password = Hash::make($request->password);
            $save->save();

            Mail::to($save->email)->send(new RegisterMail($save));

            $user_id = 1;
            $url = url('admin/admin/list');
            $message = "Khách hàng ".$request->name." đã đăng ký tài khoản";
            Notification::insertRecord($user_id, $url, $message);

            $json['status'] = true;
            $json['message'] = "Đăng ký thành công, vui lòng kiểm tra email để xác nhận tài khoản";
        } else{
            $json['status'] = false;
            $json['message'] = "Email đã tồn tại";
        }
        echo json_encode($json);
    }

    public function activate_email($id){
        $id = base64_decode($id);
        $user = User::getUser($id);
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->save();

        return redirect(url(''))->with('success','Email của bạn đã được xác nhận');
    }

    public function auth_login(Request $request){
        $remember = !empty($request->is_remeber) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1, 'is_delete' => 0] , $remember)){
            if(!empty(Auth::user()->email_verified_at)){
                $json['status'] = true;
                $json['message'] = "Đăng nhập thành công";
            } else{
                $save = User::getUser(Auth::user()->id);
                Mail::to($save->email)->send(new RegisterMail($save));
                Auth::logout();

                $json['status'] = false;
                $json['message'] = "Vui lòng kiểm tra email để xác nhận tài khoản";
            }

        } else{

            $json['status'] = false;
            $json['message'] = "Xin vui lòng nhập lại email và mật khẩu";
        }
        echo json_encode($json);
    }

    public function logout_user(){
        Auth::logout();
        return redirect(url(''));
    }

    public function forgot_password(){
        $data['meta_title'] = "Quên mật khẩu";
        return view('auth.forgot' , $data);
    }

    public function auth_forgot_password(Request $request){
        $user = User::where('email', '=', $request->email)->first();
        if(!empty($user)){
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Vui lòng kiểm tra email để lấy lại mật khẩu");
        } else {
            return redirect()->back()->with('error', "Email không tồn tại");
        }
    }

    public function reset($token){
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user)){
            $data['meta_title'] = "Đổi mật khẩu";

            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function auth_reset($token, Request $request){
        if($request->password == $request->cpassword){
           $user = User::where('remember_token', '=', $token)->first();
           $user->password = Hash::make($request->password);
           $user->remember_token = Str::random(30);
           $user->email_verified_at = date("Y-m-d H:i:s");
           $user->save();

           return redirect(url(''))->with('success', "Đổi mật khẩu thành công");
        } else {
            return redirect()->back()->with('error', "Mật khẩu không trùng khớp");
        }
    }
}

