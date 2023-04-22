<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;
use App\Http\Controllers\RecipieController;

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

    Route::get('login', [AccountController::class, 'login']);
});

Route::prefix('users/{user_id}')->group(function () {
    Route::prefix('recipies', function () {
        Route::get('/', [RecipieController::class, 'list']);
    });


});

Route::get('/', function (Request $request) {
    return "hello";
});
