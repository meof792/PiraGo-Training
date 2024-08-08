<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotiController extends Controller
{
    //
    public function firstNoti(Request $request)
    {
        if (!$request->input('id')) {
            return response()->json(['error' => 'ID người dùng không hợp lệ'], 404);
        }
        $user = DB::table('users')
            ->where('id', $request->input('id'))
            ->first();
        $noti = DB::table('noti')
            ->where('in_company', $user->in_company)
            ->orderBy('timestamp', 'asc')
            ->first();
        return response()->json($noti);
    }
}
