<?php

use App\Modules\Livros\Presentation\Http\Controllers\LivroController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/livros', [LivroController::class, 'index'])->name('livros.index');
Route::post('/livros', [LivroController::class, 'store'])->name('livros.store');
Route::get('/livros/create', [LivroController::class, 'create'])->name('livros.create');
