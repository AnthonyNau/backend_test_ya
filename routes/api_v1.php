<?php

use App\Http\Controllers\API\v1\DataSetController;
use App\Http\Controllers\API\v1\PortfolioController;
use App\Http\Controllers\API\v1\ReportController;
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
Route::group(['middleware' => ['auth:api', 'api']], function () {
    Route::prefix('portfolio')->name('portfolio.')->group(function () {
        Route::get('/', [PortfolioController::class, 'getPortfolio']);
        Route::post('add', [PortfolioController::class, 'add']);
        Route::put('update/{id}', [PortfolioController::class, 'update']);
    });
    Route::prefix('report')->name('report')->group(function () {
        Route::post('get', [ReportController::class, 'get']);
    });

});
Route::group(['middleware' => 'api'], function () {
    Route::prefix('data-set')->name('data-set.')->group(function () {
        Route::post('import', [DataSetController::class, 'import']);
    });
});
