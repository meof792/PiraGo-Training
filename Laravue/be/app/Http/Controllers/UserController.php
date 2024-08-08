<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function getUser(Request $request)
    {
        if (!$request->input('id')) {
            return response()->json(['error' => 'ID người dùng không hợp lệ'], 404);
        }
        $user = DB::table('users') //user người gửi yêu cầu
            ->where('id', $request->input('id'))
            ->first();
        $users = DB::table('users')
            ->where('in_company', $user->in_company)
            ->get();
        return response()->json($users);
    }
    public function login(Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'id' => 'required|integer|regex:/^\d+$/',
        ]);
        if ($validator1->fails()) {
            return response()->json(['success' => false, 'msg' => 'Tên đăng nhập không hợp lệ']);
        }
        $validator2 = Validator::make($request->all(), [
            'password' => 'required|string|min:6',
        ]);
        // Nếu dữ liệu password không hợp lệ, trả về thông báo lỗi
        if ($validator2->fails()) {
            return response()->json(['success' => false, 'msg' => 'Mật khẩu có ít nhất 6 kí tự']);
        }
        $user = DB::table('users')
            ->where('id', $request->input('id'))
            ->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            return response()->json(['success' => true, 'id' => $user->id, 'username' => $user->username]);
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
            'password' => 'required|string|min:6',
            'company' => 'required|string',
        ]);

        // Nếu có lỗi, trả về thông báo lỗi
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('username')) {
                return response()->json(['success' => false, 'msg' => 'Tên đăng nhập không được để trống']);
            }
            if ($errors->has('company')) {
                return response()->json(['success' => false, 'msg' => 'Tên công ty không được để trống']);
            }
            if ($errors->has('password')) {
                return response()->json(['success' => false, 'msg' => 'Mật khẩu phải có ít nhất 6 kí tự']);
            }
        }

        // Chèn dữ liệu vào cơ sở dữ liệu
        DB::table('users')->insert([
            'username' => $request->input('username'),
            'company' => $request->input('company'),
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['success' => true, 'msg' => 'Đăng ký thành công']);
    }
}
