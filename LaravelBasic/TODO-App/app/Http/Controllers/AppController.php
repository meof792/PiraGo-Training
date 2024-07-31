<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    //
    public function complete(Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'id' => 'required|string',
        ]);
        if ($validator1->fails()) {
            return response()->json(['status' => false]);
        }

        DB::table('todos')->where('id', $request->input('id'))->update(['status' => 1]);
        return redirect('/');
    }
    public function delete(Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'id' => 'required|string',
        ]);
        if ($validator1->fails()) {
            return response()->json(['status' => false]);
        }

        DB::table('todos')->where('id', $request->input('id'))->delete();
        return redirect('/');
    }
    public function addTask(Request $request)
    {
        $validator1 = Validator::make($request->all(), [
            'taskName' => 'required|string',
            'deadline' => 'required|date',
        ]);
        if ($validator1->fails()) {
            return response()->json(['status' => false, 'msg' => "Invalid name or deadline"]);
        }

        DB::table('todos')->insert([
            ['title' => $request->input('taskName'), 'deadline' => $request->input('deadline')],
        ]);

        return redirect('/');
    }

    public function index()
    {
        $todos = DB::table('todos')->orderBy('deadline')->get();
        return view('welcome', ['todos' => $todos]);
    }
}
