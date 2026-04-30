<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;

Route::post("/login", [AuthController::class, 'login']);


Route::post("/user", [UserController::class, 'store']);

Route::get('/teste', function (){
    return response()->json(["message" => "testeee"]);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::get("/testeAuth", function () {
        return response()->json(["message" => "Autenticado"]); 
    });
});
