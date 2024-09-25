<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/books", [BookController::class, 'indexApi']);
Route::post("/books", [BookController::class, 'storeApi']);
Route::get('/books/{id}/edit', [BookController::class, 'editApi']);
Route::put('/books/{id}/update', [BookController::class, 'updateApi']);
Route::delete('/books/{id}', [BookController::class, 'destroyApi']);

Route::get("/users", [UserController::class, 'indexApi']);
Route::post("/users", [UserController::class, 'storeAutorApi']);