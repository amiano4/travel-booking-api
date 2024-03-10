<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InitializationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

$loginAbilities = implode(',', [AuthController::$abAdminUser, AuthController::$abPanelUser]);

Route::controller(AuthController::class)->group(function() use($loginAbilities) {
    Route::post('login', 'login')->name('panelLogin');
    Route::middleware('auth:sanctum', 'ability:' . $loginAbilities)->get('refresh-auth', 'refreshAuth');
    Route::middleware('auth:sanctum', 'ability:' . $loginAbilities)->get('logout', 'logout');
});

Route::get('initialize/{website}', [InitializationController::class, 'handleInitialization']);

// both for admin and client
Route::middleware('auth:sanctum', 'ability:' . $loginAbilities)->group(function() {
    Route::controller(ProductController::class)->prefix('product')->group(function() {
        Route::post('add', 'add');
        Route::get('flag/{product}/{status}', 'flag');
    });

    Route::controller(ProductController::class)->prefix('products')->group(function() {
        Route::get('', 'productsByVendor');
    });
});

// super admin control
Route::middleware('auth:sanctum', 'abilities:' . AuthController::$abAdminUser)->group(function () {
    Route::controller(UserController::class)->prefix('user')->group(function() {
        Route::post('create', 'createUser');
    });
});

// regular client control
Route::middleware('auth:sanctum', 'abilities:' . AuthController::$abPanelUser)->group(function () {
    Route::controller(ProductController::class)->prefix('products')->group(function() {
        // Route::get('', 'productsByVendor');
    });
});
