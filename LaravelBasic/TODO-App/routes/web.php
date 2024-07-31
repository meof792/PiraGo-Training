<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::post('/addcheck', [AppController::class, 'addTask']);
Route::post('/complete', [AppController::class, 'complete']);
Route::post('/delete', [AppController::class, 'delete']);
Route::get('/', [AppController::class, 'index']);
