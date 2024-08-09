<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update(Request $request)
    {
        if (!$request->input('id')) {
            return response()->json(['error' => 'ID người dùng không hợp lệ'], 404);
        }
        // Kiểm tra hợp lệ cho tất cả các trường
        $validator = Validator::make($request->all(), [
            'newPassword' => 'nullable|string|min:6',
            'password' => 'required|string',
            'birthday' => 'nullable|date',
            'email' => 'nullable|email',
        ]);

        // Nếu có lỗi, trả về thông báo lỗi
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json(['success' => false, 'msg' => 'Email không hợp lệ']);
            }
            if ($errors->has('newPassword')) {
                return response()->json(['success' => false, 'msg' => 'Mật khẩu mới không hợp lệ']);
            }
            if ($errors->has('birthday')) {
                return response()->json(['success' => false, 'msg' => 'Ngày sinh không hợp lệ']);
            }
        }
        $user = DB::table('users')->where('id', $request->input('id'))->first();

        $updateData = [];
        if ($request->input('email')) {
            $updateData['email'] = $request->input('email');
        }
        if ($request->input('birthday')) {
            $updateData['birthday'] = $request->input('birthday');
        }
        if ($request->input('newPassword')) {
            $updateData['password'] = Hash::make($request->input('newPassword'));
        }

        DB::table('users')->where('id', $request->input('id'))->update($updateData);

        return response()->json(['success' => true]);
    }

    public function addMember(Request $request)
    {
        if (!$request->input('id')) {
            return response()->json(['error' => 'ID người dùng không hợp lệ'], 404);
        }
        // Kiểm tra hợp lệ cho tất cả các trường
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|min:6',
            'salary' => 'numeric|nullable',
        ]);

        // Nếu có lỗi, trả về thông báo lỗi
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('username')) {
                return response()->json(['success' => false, 'msg' => 'Tên người dùng không hợp lệ']);
            }
            if ($errors->has('salary')) {
                return response()->json(['success' => false, 'msg' => 'Mức lương không hợp lệ']);
            }
            if ($errors->has('password')) {
                return response()->json(['success' => false, 'msg' => 'Mật khẩu phải có ít nhất 6 kí tự']);
            }
        }
        $user = DB::table('users')
            ->where('id', $request->input('id'))
            ->first();
        // Chèn dữ liệu vào cơ sở dữ liệu
        $id = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'salary' => $request->input('salary') ?? 0,
            'in_company' => $user->in_company,
            'password' => Hash::make($request->input('password')),
        ]);

        return response()->json(['success' => true, 'msg' => 'Đăng ký thành công', 'id' => $id]);
    }
    public function getUser(Request $request)
    {
        if (!$request->input('id')) {
            return response()->json(['error' => 'ID người dùng không hợp lệ'], 404);
        }
        $user = DB::table('users') //user người gửi yêu cầu
            ->where('id', $request->input('id'))
            ->first();
        return response()->json($user);
    }
    public function getUsers(Request $request)
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
            return response()->json(['success' => true, 'id' => $user->id, 'username' => $user->username, 'is_manager' => $user->is_manager]);
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
            'username' => 'required|string',
            'password' => 'required|string|min:6',
            'company' => 'required|string',
        ]);

        // Nếu có lỗi, trả về thông báo lỗi
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('username')) {
                return response()->json(['success' => false, 'msg' => 'Tên người dùng không hợp lệ']);
            }
            if ($errors->has('company')) {
                return response()->json(['success' => false, 'msg' => 'Tên công ty không hợp lệ']);
            }
            if ($errors->has('password')) {
                return response()->json(['success' => false, 'msg' => 'Mật khẩu phải có ít nhất 6 kí tự']);
            }
        }

        // Chèn dữ liệu vào cơ sở dữ liệu
        $id = DB::table('users')->insertGetId([
            'username' => $request->input('username'),
            'company' => $request->input('company'),
            'password' => Hash::make($request->input('password')),
            'is_manager' => 1,
        ]);

        return response()->json(['success' => true, 'msg' => 'Đăng ký thành công', 'id' => $id]);
    }
}
