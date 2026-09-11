<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\AuthController;

// CRUD dos Contatos
Route::middleware('auth:sanctum')->apiResource('contatos', ContatoController::class);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);   

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('/me', fn(Request $r) => $r->user());   
    Route::post('/logout', function (Request $r) {
        $r->user()->currentAccessToken()->delete();
        return response()->json(null, 204);
    });


});
