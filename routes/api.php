<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\TestamentoController;
use App\Http\Controllers\VersiculoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    //Testamentos
    Route::post('/testamento', [TestamentoController::class, 'store'])->name('testamento.store');
    Route::get('/testamento', [TestamentoController::class, 'index'])->name('testamento.index');
    Route::get('/testamento/{id}', [TestamentoController::class, 'show'])->name('testamento.show');
    Route::put('/testamento/{id}', [TestamentoController::class, 'update'])->name('testamento.update');
    Route::delete('/testamento/{id}', [TestamentoController::class, 'destroy'])->name('testamento.destroy');

    //Livros
    Route::post('/livro', [LivroController::class, 'store'])->name('livro.store');
    Route::get('/livro', [LivroController::class, 'index'])->name('livro.index');
    Route::get('/livro/{id}', [LivroController::class, 'show'])->name('livro.show');
    Route::put('/livro/{id}', [LivroController::class, 'update'])->name('livro.update');
    Route::patch('/livro/{id}', [LivroController::class, 'upload'])->name('livro.upload');
    Route::delete('/livro/{id}', [LivroController::class, 'destroy'])->name('livro.destroy');

    //Versiculos
    Route::post('/versiculo', [VersiculoController::class, 'store'])->name('versiculo.store');
    Route::get('/versiculo', [VersiculoController::class, 'index'])->name('versiculo.index');
    Route::get('/versiculo/{id}', [VersiculoController::class, 'show'])->name('versiculo.show');
    Route::put('/versiculo/{id}', [VersiculoController::class, 'update'])->name('versiculo.update');
    Route::delete('/versiculo/{id}', [VersiculoController::class, 'destroy'])->name('versiculo.destroy');

    //Users
    Route::post('/user/logout', [AuthController::class, 'logout']);
});

Route::prefix('v1')->group(function () {
    //Users
    Route::post('/user/signup', [AuthController::class, 'signup']);
    Route::post('/user/signin', [AuthController::class, 'signin']);
});
