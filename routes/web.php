<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::prefix('api')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/search/{query}', [BookController::class, 'search']);
    Route::get('/cart', [BookController::class, 'getCart']);
    Route::put('/cart', [BookController::class, 'updateCartItemQuantity']);
    Route::post('/cart/add', [BookController::class, 'addToCart']);
    Route::delete('/cart/{index}', [BookController::class, 'removeFromCart']);
});