<?php

use App\Http\Controllers\Api\User\Auth\LoginController;
use App\Http\Controllers\Api\User\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('v1/user')->middleware('api')->group(function(){

   Route::post('register',[RegisterController::class,'register']);
   Route::post('login',[LoginController::class,'login']);

   Route::middleware('auth:sanctum')->group(function(){
    Route::get('test',function(){
        return "hello you auth";
    });
   });
});
