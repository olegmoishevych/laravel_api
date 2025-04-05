<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\ProductController;

Route::get('/hello', [HelloController::class, 'index']);

Route::get('/products', [ProductController::class, 'getAllProducts']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
Route::patch('/products/{id}', [ProductController::class, 'update']);

