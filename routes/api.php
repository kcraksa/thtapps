<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;

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

Route::post('login', [AuthController::class, 'signin'])->name('login');
Route::post('register', [AuthController::class, 'signup'])->name('register');

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('news', NewsController::class);
    Route::put('news/{id}/publish', 'App\Http\Controllers\Api\NewsController@publish')->name('news.publish');
});
