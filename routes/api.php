<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProjectController;
use App\Http\Controllers\Api\v1\LogController;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('log', [ApiController::class, 'index']);

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'jwt.protection'], function (){
   Route::post('logout', [AuthController::class, 'logout']);

   Route::get('projects', [ProjectController::class, 'index']);
   Route::post('project/clear', [ProjectController::class, 'clear']);

   Route::get('logs', [LogController::class, 'index']);
   Route::get('log', [LogController::class, 'show']);
   Route::patch('log/solved', [LogController::class, 'solve']);
   Route::delete('log/delete', [LogController::class, 'delete']);
});
