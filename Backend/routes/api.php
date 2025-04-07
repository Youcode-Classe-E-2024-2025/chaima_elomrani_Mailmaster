<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);