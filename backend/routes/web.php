<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/create', [BookController::class, 'create']);
Route::post('/books', [BookController::class, 'store']);
Route::post('/autor', [UserController::class, 'storeAutor']);
Route::get('/books/create/autor', [UserController::class, 'createAutor']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/books/{id}/edit', [BookController::class, 'edit']);
Route::put('/books/{id}/update', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);