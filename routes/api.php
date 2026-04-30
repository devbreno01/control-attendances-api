<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::post("/user", [UserController::class, 'store']);

Route::get('/teste', function (){
    return response()->json(["message" => "testeee"]);
}); 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
