<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WallController;
use Illuminate\Support\Facades\Route;


Route::group([
    'middlaware' => ['jwt.verify'],
    'prefix'     => 'auth'
], function($router) {
    Route::post('/',   [AuthController::class, 'login'])->name('login');
    Route::patch('/',  [AuthController::class, 'register'])->name('register');  
    Route::get('/',    [AuthController::class, 'TestToken'])->name('check_token'); 

    Route::post('/reset-password',         [AuthController::class, 'ResetPassword']);
    Route::post('/forgot-password',        [AuthController::class, 'ForgotPassword']);
    Route::get('/reset-password/{token}',  [AuthController::class, 'ViewResetPassword'])->name('password.reset');
}); 


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'facebook'
], function($router) {
    Route::post('/facebook', [FacebookController::class, 'setToken']);
    Route::get('/getpages',  [FacebookController::class, 'getPages']); 
    Route::get('/profile',  [FacebookController::class, 'getProfile']); 
    Route::post('/after-connection',  [FacebookController::class, 'afterConnection']); 
}); 


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'user'
], function($router) {
    Route::get('/',        [UserController::class, 'get_me']); 
    Route::patch('/',      [UserController::class, 'update']); 
    Route::delete('/{id}', [UserController::class, 'delete']); 
    Route::post('/',       [UserController::class, 'search']);
}); 

Route::get('/users', [UserController::class, 'get'])->middleware(['jwt.verify']);

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
    Route::get('/',          [WallController::class, 'public_wall']); 
    Route::get('/{wallid}',  [WallController::class, 'get']); 
    Route::post('/',         [WallController::class, 'create']); 
    Route::patch('/',        [WallController::class, 'update']); 
    Route::delete('/{id}',   [WallController::class, 'delete']); 
}); 

Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'settings'
], function($router) {
    Route::get('/',          [SettingsController::class, 'all']); 
    Route::get('/wall-moderation',          [SettingsController::class, 'all']); 
    Route::post('/',         [SettingsController::class, 'UpdateOrCreate']);
    Route::delete('/{id}',   [SettingsController::class, 'delete']); 
}); 


Route::group([
    'middleware' => ['jwt.verify'],
    'prefix'     => 'admin'
], function($router) {
    Route::get('/{name}',  [AdminController::class, 'get']); 
    Route::post('/',       [AdminController::class, 'set']); 
}); 



Route::group([
    'prefix'     => 'mail'
], function($router) {
    Route::get('/confirm-mail',     [MailController::class, 'ConfirmMail']);

    // Route::get('/forgot-password',  [MailController::class, 'ViewForgotPassword']);

    
}); 
