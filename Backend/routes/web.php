<?php

use App\Http\Controllers\SubscribersController;
use Illuminate\Support\Facades\Route;



// subbscribers routes
Route::get('/subscribers',[SubscribersController::class,'index']);
Route::get('/subscribers/{id}',[SubscribersController::class,'show']);
Route::post('/subscribers',[SubscribersController::class,'store']);
Route::put('/subscribers/{id}',[SubscribersController::class,'update']);
Route::delete('/subscribers/{id}',[SubscribersController::class,'destroy']);
