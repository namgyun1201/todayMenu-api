<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\RecipieController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProcessController;

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

Route::prefix('account')->group(function () {
    Route::get('check', [AccountController::class, 'check']);

    Route::post('register', [AccountController::class, 'add']);

    Route::post('login', [AccountController::class, 'login']);

    Route::post('refreshToken', [AccountController::class, 'refreshToken']);

});

Route::middleware('auth:api')->group(function () {
    Route::prefix('recipies')->group(function () {
        Route::get('recommend', [RecipieController::class, 'recommendList']);

        Route::get('{recipie_id}', [RecipieController::class, 'show']);

        Route::get('/', [RecipieController::class, 'list']);
    });

    Route::prefix('ingredients')->group(function () {
        Route::get('/', [IngredientController::class, 'list']);

        Route::get('{recipie_id}', [IngredientController::class, 'show']);

    });

    Route::prefix('processes')->group(function () {
        Route::get('{recipie_id}', [ProcessController::class, 'show']);
    });

    Route::get('user', function (Request $request) {
        return Auth::user();
    });
});
Route::prefix('users/{user_id}')->group(function () {



});

Route::get('/', function (Request $request) {
    return "hello";
});
