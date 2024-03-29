<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouletteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public Routes
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'register']);


Route::resource('/roulette', RouletteController::class);

//Protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('/profile', function (Request $request){
        return $request->user();
    });
    
    //Route::resource('/roulette', RouletteController::class);
    Route::post('/logout',[AuthController::class, 'logout']);

});
