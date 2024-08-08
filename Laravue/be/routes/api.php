<?php

use App\Http\Controllers\NotiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function () {
//     return view('help');
// });
Route::get('/get-users', [UserController::class, 'getUser']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/edit', [UserController::class, 'edit']);
Route::get('/first-noti', [NotiController::class, 'firstNoti']);

