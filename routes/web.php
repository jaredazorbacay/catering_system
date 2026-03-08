<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Home Route
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
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login',[AuthController::class,'showLogin']);

Route::post('/login',[AuthController::class,'login']);

Route::get('/register',[AuthController::class,'showRegister']);

Route::post('/register',[AuthController::class,'register']);

Route::post('/logout',[AuthController::class,'logout']);


/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

Route::get('/admin/login',[AuthController::class,'showAdminLogin']);

Route::post('/admin/login',[AuthController::class,'adminLogin']);


/*
|--------------------------------------------------------------------------
| CLIENT ROUTES (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','client'])->group(function(){

    Route::get('/client/dashboard',[DashboardController::class,'client']);

    Route::get('/client/order/create',[OrderController::class,'create']);

    Route::post('/client/order/store',[OrderController::class,'store']);

    Route::get('/client/orders',[OrderController::class,'clientOrders']);

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin/dashboard',[DashboardController::class,'admin']);

    Route::get('/admin/orders',[OrderController::class,'adminOrders']);

    Route::post('/admin/orders/{id}/approve',[OrderController::class,'approve']);

    Route::post('/admin/orders/{id}/cancel',[OrderController::class,'cancel']);

    Route::get('/admin/analytics',[DashboardController::class,'analytics']);

});