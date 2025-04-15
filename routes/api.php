<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ToolController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});

//Rotas
Route::get('/tools', [ToolController::class, 'index']);
Route::post('/tools', [ToolController::class, 'store']);
Route::delete('/tools/{id}', [ToolController::class, 'destroy']);