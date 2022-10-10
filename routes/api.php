<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

//RUTA DEL usercontroller
Route::controller(UserController::class)->group(function(){
    Route::post('register', 'register');
    Route::get('user/{user}', 'show');
    Route::get('user/{user}/seller', 'show_seller');
    Route::get('user-order/{user}', 'listOrdersUser');

});

//Ruta SellerController
Route::controller(SellerController::class)->group(function() {
    Route::post('seller', 'store');
    Route::get('seller/{seller}', 'show');
    Route::get('seller/{seller}/user', 'show_user');
});



//OrderController routing
Route::controller(OrderController::class)->group(function() {
    Route::post('order', 'storeOrder');
    Route::get('order/{order}', 'listOrders');
    //rutas de los products
    Route::post('order/{order}/products/{product}/order', 'registerProduct');
    Route::get('order/{order}/products', 'listProduct');
});

//ProductController routing
Route::controller(ProductController::class)->group(function() {
    Route::post('product', 'storeProduct');
    Route::get('product/{product}/orders', 'listOrder');

});


