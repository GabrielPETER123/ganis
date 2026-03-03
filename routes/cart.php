<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

// ...existing code...

Route::middleware('auth')->get('/cart', [CartController::class, 'index'])->name('cart.index');