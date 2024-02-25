<?php

use App\Http\Controllers\BusLineController;
use App\Http\Controllers\EdgesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerticesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('guest:api')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    });

    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::get('/id', [UserController::class, 'getid']);
    
        Route::delete('/delete/order', [OrderController::class, 'destroy']);
        Route::resource('orders', OrderController::class);
        Route::post('/orders/join', [OrderController::class, 'joinOrder']);
        Route::post('/complete/order', [OrderController::class, 'completeOrder']);
        Route::post('/feedback', [VerticesController::class, 'feedback']);
        Route::get('/history', [OrderController::class, 'gethistory']);
        Route::get('/pending/orders', [OrderController::class, 'getPendingOrders']);
        Route::post('/shortest-path', [EdgesController::class, 'findShortestPath']);
        Route::get('/orders/destination', [OrderController::class, 'getOrdersBydestnaion']);
        Route::get('orders/gender', [OrderController::class, 'getOrdersBygender']);
        Route::get('/profile', [UserController::class, 'getprofile']);
        Route::post('/search', [OrderController::class, 'search']);
    });
  

//dashboard
Route::prefix('admin')->group(function () {
    Route::delete('/vertices', [VerticesController::class, 'destroy']);

    Route::resource('vertices', VerticesController::class);
    Route::resource('edges', EdgesController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::delete('/busline', [BusLineController::class, 'destroy']);
    Route::resource('busline', BusLineController::class);

});




Route::get('migrate' , function(){
    return Artisan::call('migrate:fresh');
  });
  
  Route::get('seed' , function(){
      return Artisan::call('db:seed');
  });


























