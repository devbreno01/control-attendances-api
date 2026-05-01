<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SectorController;
use App\Http\Controllers\Api\PriorityController;
use App\Http\Controllers\Api\TicketController;

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


    Route::get("/priorities", [PriorityController::class, 'get']);
    Route::get("/priority/{id}", [PriorityController::class, 'getById']);
    Route::post("/priorities", [PriorityController::class, 'store']);
    Route::put("/priority/{id}", [PriorityController::class, 'update']);
    Route::delete("/priority/{id}", [PriorityController::class, 'delete']);


    Route::get("/tickets", [TicketController::class, 'get']);
    Route::get("/ticket/{id}", [TicketController::class, 'getById']);
    Route::post("/tickets", [TicketController::class, 'store']);
    Route::put("/ticket/{id}", [TicketController::class, 'update']);
    Route::delete("/ticket/{id}", [TicketController::class, 'delete']);


});
