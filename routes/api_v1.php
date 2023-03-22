<?php

use App\Http\Controllers\API\v1\PortfolioController;
use App\Http\Controllers\API\v1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->name('user.')->group(function () {
    Route::group(['middleware' => 'api'], function () {
        Route::post('register', [UserController::class, 'register']);
        Route::post('login', [UserController::class, 'login']);
        Route::get('logout', [UserController::class, 'logout']);
        Route::post('refresh', [UserController::class, 'refresh']);
        Route::get('/', [UserController::class, 'getUser']);
    });
});
Route::group(['middleware' => 'api', 'auth:api'], function () {
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::post('add', [PortfolioController::class, 'add']);
        Route::put('update', [PortfolioController::class, 'login']);
    });
    Route::prefix('data-set')->name('data-set.')->group(function () {
        Route::post('import', [PortfolioController::class, 'import']);
    });
    Route::prefix('report')->name('report')->group(function () {
        Route::post('get', [PortfolioController::class, 'get']);
    });

});
