<?php


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


Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::namespace('App\Http\Controllers')->group(function(){
    Route::post('login','AuthController@login');
    Route::post('register','AuthController@register');
    Route::post('logout','AuthController@logout');
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::namespace('App\Http\Controllers\Admin')->group(function(){
        //user
        Route::resource('user', UserController::class);
        Route::put('user/change-password/{user}','UserController@changePassword');
        Route::put('change-status-user/{user}','UserController@changeStatus');

        //category
        Route::resource('category', CategoryController::class);
        Route::put('change-status-category/{category}','CategoryController@changeStatus');

        //product
        Route::resource('product', ProductController::class);
        Route::put('change-status-product/{product}','ProductController@changeStatus');


        //profile
        Route::get('profile','ProfileController@index');
        Route::put('profile/{profile}', 'ProfileController@update');
        Route::put('profile/change-password/{user}','ProfileController@changePassword');
    });
});

