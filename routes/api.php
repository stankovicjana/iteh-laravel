<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;

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

//javne rute

Route::resource('products', ProductController::class)->only(['index', 'show']);

Route::resource('providers', ProviderController::class);

Route::resource('apprat', ProductRatingController::class);

Route::resource('users', UserController::class)->only(['index', 'show']);

Route::get('/users/{id}/apprat', [UserAppointmentRatingController::class, 'index']);

Route::get('/providers/{id}/apprat', [ProviderAppointmentRatingController::class, 'index']);

Route::get('/products/{id}/apprat', [ProductAppointmentRatingController::class, 'index']);