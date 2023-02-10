<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductProductRatingController;
use App\Http\Controllers\ProviderProductRatingController;
use App\Http\Controllers\UserController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\UserProductRatingController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductRatingController;


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
    //return $request->user();
});


    Route::group(['middleware' => ['auth:sanctum']], function () {
    //admin 
    Route::resource('products', ProductController::class)->only(['store']);  //+
    Route::resource('providers', 'App\Http\Controllers\ProviderController')->only(['store']); //+

    Route::post('/register', [AuthController::class, 'register']); //+
    //vraca sve usere, get metoda
    Route::resource('users', UserController::class)->only(['index', 'show']);  //+

    //svi loginovani
    Route::post('/logout', [AuthController::class, 'logout']); //+
    Route::get('/myapprat', [UserProductRatingController::class, 'myapprat']); // proverava da li taj user ima rating, +
    Route::resource('users', UserController::class)->only(['update']); //*

});

/*
Route::put('products/{id}', 'App\Http\Controllers\ProductController@update'); //+
Route::delete('products/{id}', 'App\Http\Controllers\ProductController@destroy'); //+
Route::put('users/{id}', 'App\Http\Controllers\UserController@update'); //+
Route::delete('users/{id}', 'App\Http\Controllers\UserController@destroy'); //+
*/

//javne rute

//vraca sve proizvode, get
Route::resource('products', ProductController::class)->only(['index', 'show']); //+
//vraca sve providere, get
Route::resource('providers', ProviderController::class); //+
//vraca sve ocene, get
Route::resource('apprat', ProductRatingController::class); // +
//vraca sve usere, get metoda
Route::resource('users', UserController::class)->only(['index', 'show']); //+

//vraca za odredjenog usera koje je ocene ostavio, get metoda
Route::get('/users/{id}/apprat', [UserProductRatingController::class, 'index']); //+

Route::get('/providers/{id}/apprat', [ProviderProductRatingController::class, 'index']); //+

Route::get('/products/{id}/apprat', [ProductProductRatingController::class, 'index']); //+

Route::post('/login', [AuthController::class, 'login']); //+

/////////


