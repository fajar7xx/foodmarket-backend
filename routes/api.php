<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [\App\Http\Controllers\API\UserController::class, 'fetch']);
    Route::post('user', [\App\Http\Controllers\API\UserController::class, 'updatedProfile']);
    Route::post('user/photo', [\App\Http\Controllers\API\UserController::class, 'updatePhoto']);
    Route::post('logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('food', [\App\Http\Controllers\API\FoodController::class, 'index']);
    Route::get('transaction', [\App\Http\Controllers\API\TransactionController::class, 'index']);
    Route::patch('transaction/{transaction}', [\App\Http\Controllers\API\TransactionController::class, 'update']);
});
