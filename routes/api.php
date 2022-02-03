<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middlaware' => ['jwt.verify'],
    'prefix'     => 'auth'
], function($router) {
    // Route::post('/',   [AuthController::class, 'login'])->name('login');
    Route::patch('/',  [AuthController::class, 'register']);  
    Route::get('/',    [AuthController::class, 'TestToken']); 
    
}); 

Route::post('/auth',   [AuthController::class, 'login'])->name('login');

Route::group([
    // 'middleware' => ['jwt.verify'],
    'prefix'     => 'facebook'
], function($router) {
    Route::get('/',          [FacebookController::class, 'index']); 
    Route::get('/callback',  [FacebookController::class, 'callback']); 
    Route::post('/facebook', [FacebookController::class, 'setToken']);
    Route::get('/getpages',  [FacebookController::class, 'getPages']); 
}); 


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'user'
], function($router) {
    Route::get('/',        [UserController::class, 'get_me']); 
    Route::patch('/',      [UserController::class, 'update']); 
    Route::delete('/{id}', [UserController::class, 'delete']); 
}); 

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'posts'
], function($router) {
    Route::get('/{wallid}/', [PostController::class, 'get']); 
    Route::post('/',         [PostController::class, 'create']); 
    Route::patch('/',        [PostController::class, 'update']); 
    Route::delete('/{id}',   [PostController::class, 'delete']); 
}); 

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'wall'
], function($router) {
    Route::get('/',          [WallController::class, 'get']); 
    Route::get('/{wallid}/', [WallController::class, 'get']); 
    Route::post('/',         [WallController::class, 'create']); 
    Route::patch('/',        [WallController::class, 'update']); 
    Route::delete('/{id}',   [WallController::class, 'delete']); 
}); 

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'settings'
], function($router) {
    Route::get('/{wallid}/',     [SettingsController::class, 'get']); 
    Route::post('/',     [SettingsController::class, 'create']); 
    Route::patch('/',     [SettingsController::class, 'update']); 
    Route::delete('/{id}',     [SettingsController::class, 'delete']); 
}); 



Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'settings'
], function($router) {
    Route::get('/{wallid}/',     [SettingsController::class, 'get']); 
    Route::post('/',     [SettingsController::class, 'create']); 
    Route::patch('/',     [SettingsController::class, 'update']); 
    Route::delete('/{id}',     [SettingsController::class, 'delete']); 
}); 

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'admin'
], function($router) {
    Route::get('/',  [AdminController::class, 'get']); 
    Route::post('/', [AdminController::class, 'set']); 
}); 
