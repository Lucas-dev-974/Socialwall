<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacebookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middlaware' => ['api', 'cors'],
    'prefix'     => 'auth'
], function($router) {
    Route::post('/',   [AuthController::class, 'login'])->name('login');
    Route::patch('/',  [AuthController::class, 'register']);  
    Route::get('/',    [AuthController::class, 'TestToken']); 
    
}); 


Route::group([
    'prefix'     => 'facebook'
], function($router) {
    Route::get('/auth',     [FacebookController::class, 'index']); 
    Route::get('/callback', [FacebookController::class, 'index']); 
}); 