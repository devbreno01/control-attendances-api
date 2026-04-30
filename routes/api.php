<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SectorController;
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

    Route::get("/sectors", [SectorController::class, 'get']);
    Route::get("/sector/{id}", [SectorController::class, 'getById']);
    Route::post("/sectors", [SectorController::class, 'store']);
    Route::put("/sector/{id}", [SectorController::class, 'update']);
    Route::delete("/sector/{id}", [SectorController::class, 'delete']);

});
