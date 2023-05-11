<?php

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

Route::get('/containers', [App\Http\Controllers\DockerContainersController::class, 'list']);
Route::post('/updateContainer', [App\Http\Controllers\DockerContainersController::class, 'changeStatusContainer']);
