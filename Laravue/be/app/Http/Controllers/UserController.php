<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'id' => 'required|integer|regex:/^\d+$/',
        ]);
        if ($validator1->fails()) {
            return response()->json(['success' => false, 'msg' => 'Tên đăng nhập phải có độ dài từ 5-17 kí tự (không được có dấu cách)']);
        }
        $validator2 = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);
        // Nếu dữ liệu password không hợp lệ, trả về thông báo lỗi
        if ($validator2->fails()) {
            return response()->json(['success' => false, 'msg' => 'Mật khẩu có ít nhất 6 kí tự']);
        }
        $user = DB::table('email')
            ->where('email', $request->input('email'))
            ->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            return response()->json(['success' => true, 'name' => $user->name, 'phone' => $user->phone, 'email' => $user->email]);
        }
        return response()->json(['success' => false, 'msg' => 'Tên người dùng hoặc mật khẩu không chính xác',]);
    }
    public function edit(Request $request)
    {
    }
    public function register(Request $request)
    {
        // Kiểm tra hợp lệ cho tất cả các trường
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Nếu có lỗi, trả về thông báo lỗi
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('name')) {
                return response()->json(['success' => false, 'msg' => 'Tên đăng nhập không được để trống']);
            }
            if ($errors->has('email')) {
                return response()->json(['success' => false, 'msg' => 'Email đã tồn tại hoặc không hợp lệ']);
            }
            if ($errors->has('phone')) {
                return response()->json(['success' => false, 'msg' => 'Số điện thoại không được để trống']);
            }
            if ($errors->has('password')) {
                return response()->json(['success' => false, 'msg' => 'Mật khẩu phải có ít nhất 6 kí tự']);
            }
        }

        // Chèn dữ liệu vào cơ sở dữ liệu
        $id = DB::table('users')->insertGetId([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['success' => true, 'msg' => 'Đăng ký thành công']);
    }
}
