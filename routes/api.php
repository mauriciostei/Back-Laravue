<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\PersonaController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// AUTH
Route::group(["prefix" => "/v1/auth"], function(){
    Route::post("/login", [AuthController::class, "login"]);
    Route::post("/registro", [AuthController::class, "registro"]);

    Route::group(["middleware" => "auth:sanctum"], function(){
        Route::get("/perfil", [AuthController::class, "perfil"]);
        Route::post("/logout", [AuthController::class, "logout"]);
    });
});


Route::middleware('auth:sanctum')->group(function(){

    Route::apiResource('personas', PersonaController::class);
    Route::apiResource('carreras', CarrerasController::class);
    Route::apiResource('materias', MateriasController::class);

});