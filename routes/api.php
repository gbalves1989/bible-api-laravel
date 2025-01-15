<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\TestamentoController;
use App\Http\Controllers\VersiculoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    //Testamentos
    Route::post('/testamento', [TestamentoController::class, 'store']);
    Route::get('/testamento', [TestamentoController::class, 'index']);
    Route::get('/testamento/{id}', [TestamentoController::class, 'show']);
    Route::put('/testamento/{id}', [TestamentoController::class, 'update']);
    Route::delete('/testamento/{id}', [TestamentoController::class, 'destroy']);

    //Livros
    Route::post('/livro', [LivroController::class, 'store']);
    Route::get('/livro', [LivroController::class, 'index']);
    Route::get('/livro/{id}', [LivroController::class, 'show']);
    Route::put('/livro/{id}', [LivroController::class, 'update']);
    Route::delete('/livro/{id}', [LivroController::class, 'destroy']);

    //Versiculos
    Route::post('/versiculo', [VersiculoController::class, 'store']);
    Route::get('/versiculo', [VersiculoController::class, 'index']);
    Route::get('/versiculo/{id}', [VersiculoController::class, 'show']);
    Route::put('/versiculo/{id}', [VersiculoController::class, 'update']);
    Route::delete('/versiculo/{id}', [VersiculoController::class, 'destroy']);

    //Users
    Route::post('/user/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () {
    //Users
    Route::post('/user/signup', [AuthController::class, 'signup']);
    Route::post('/user/signin', [AuthController::class, 'signin']);
});
