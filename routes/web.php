<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

// Route::get('/token', [AppController::class, 'tokenPage']);
Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');