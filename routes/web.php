<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Home Redirect
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if(Auth::check()){

        if(Auth::user()->role == 'admin'){
            return redirect('/admin/dashboard');
        }

        if(Auth::user()->role == 'client'){
            return redirect('/client/dashboard');
        }

    }

    return redirect('/login');

});


/*
|--------------------------------------------------------------------------
| Guest Routes (Only if NOT logged in)
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function(){

    /* Client Auth */

    Route::get('/login',[AuthController::class,'showLogin']);
    Route::post('/login',[AuthController::class,'login']);

    Route::get('/register',[AuthController::class,'showRegister']);
    Route::post('/register',[AuthController::class,'register']);

    /* Admin Auth */

    Route::get('/admin/login',[AuthController::class,'showAdminLogin']);
    Route::post('/admin/login',[AuthController::class,'adminLogin']);

});


/*
|--------------------------------------------------------------------------
| Logout (Requires login)
|--------------------------------------------------------------------------
*/

Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','client'])->group(function(){

    /* Dashboard */

    Route::get('/client/dashboard',[DashboardController::class,'client']);

    /* Orders */

    Route::get('/client/order/create',[OrderController::class,'create']);
    Route::post('/client/order/store',[OrderController::class,'store']);

    Route::get('/client/orders',[OrderController::class,'clientOrders']);

    /* Cart */

    Route::get('/client/cart',[CartController::class,'index']);

    Route::post('/client/cart/add',[CartController::class,'add']);

    Route::post('/client/cart/update',[CartController::class,'update']);

    Route::post('/client/cart/remove/{id}',[CartController::class,'remove']);

    Route::post('/client/cart/clear',[CartController::class,'clear']);

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function(){

    /* Dashboard */

    Route::get('/admin/dashboard',[DashboardController::class,'admin']);

    /* Orders */

    Route::get('/admin/orders',[OrderController::class,'adminOrders']);

    Route::post('/admin/orders/{id}/approve',[OrderController::class,'approve']);

    Route::post('/admin/orders/{id}/cancel',[OrderController::class,'cancel']);

    /* Analytics */

    Route::get('/admin/analytics',[DashboardController::class,'analytics']);
    Route::post('/admin/orders/{id}/payment',[OrderController::class,'updatePayment']);

});