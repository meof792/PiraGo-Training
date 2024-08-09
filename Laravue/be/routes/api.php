<?php

use App\Http\Controllers\NotiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function () {
//     return view('help');
// });
Route::post('/update', [UserController::class, 'update']);
Route::get('/get-user', [UserController::class, 'getUser']);
Route::get('/get-users', [UserController::class, 'getUsers']);
Route::post('/add-member', [UserController::class, 'addMember']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/edit', [UserController::class, 'edit']);
Route::get('/first-noti', [NotiController::class, 'firstNoti']);

