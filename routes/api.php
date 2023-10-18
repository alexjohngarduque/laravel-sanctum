<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/loginv2',[AuthController::class, 'loginv2']);
Route::post('/register',[AuthController::class, 'register']);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('/profile', function (Request $request){
        return $request->user();
    });
    
    Route::resource('/tasks', AuthController::class);
    Route::post('/logout',[AuthController::class, 'logout']);
});
