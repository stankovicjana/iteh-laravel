<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductRatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductRatingController;
use App\Http\Controllers\API\AuthController;


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

Route::middleware('auth:sanctum')->get('/myprofile', function (Request $request) {
    return new UserResource($request->user());
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin
    Route::resource('products', ProductController::class)->only(['store', 'update', 'destroy']); //radi
    Route::resource('providers', ProviderController::class)->only(['store', 'update', 'destroy']); //radi
    Route::resource('users', UserController::class)->only(['destroy']);  //radi
    Route::post('/register', [AuthController::class, 'register']); //radi
    Route::resource('users', UserController::class)->only(['index', 'show']);  //radi

    //user
   // Route::resource('/apprat', ProductRatingController::class)->only(['store', 'update', 'destroy']); //ne radi

    //svi loginovani
    Route::post('/logout', [AuthController::class, 'logout']); //radi
    Route::get('/myapprat', [UserProductRatingController::class, 'myapprat']); // radi, proverava da li taj user ima rating
    Route::resource('users', UserController::class)->only(['update']); 

});

//javne rute

Route::resource('products', ProductController::class)->only(['index', 'show']); //radi

Route::resource('providers', ProviderController::class); //radi

Route::resource('apprat', ProductRatingController::class); // radi

Route::resource('users', UserController::class)->only(['index', 'show']);

Route::get('/users/{id}/apprat', [UserAppointmentRatingController::class, 'index']); //radi

Route::get('/providers/{id}/apprat', [ProviderAppointmentRatingController::class, 'index']); //radi

Route::get('/products/{id}/apprat', [ProductAppointmentRatingController::class, 'index']); //radi

Route::post('/login', [AuthController::class, 'login']); //radi

/////////


