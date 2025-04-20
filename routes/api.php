<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ToolController;
use App\Http\Controllers\Api\V1\ClienteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});

//Rotas Tools
Route::get('/v1/tools', [ToolController::class, 'index']);
Route::post('/v1/tools', [ToolController::class, 'store']);
Route::delete('/v1/tools/{id}', [ToolController::class, 'destroy']);

//Rotas Cliente
Route::post('/v1/login', [ClienteController::class, 'authenticate']);
Route::post('/v1/cadastro', [ClienteController::class, 'store']);