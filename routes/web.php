<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;
/*
|--------------------------------------------------------------------------
| Home (Landing Page)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    // If logged in → redirect to dashboard
    if(Auth::check()){

        if(Auth::user()->role == 'admin'){
            return redirect('/admin/dashboard');
        }

        if(Auth::user()->role == 'client'){
            return redirect('/client/dashboard');
        }
    }

    // NOT logged in → show landing page
    $foods = Item::where('category','food')->take(100)->get();
    $drinks = Item::where('category','drink')->take(100)->get();
    $desserts = Item::where('category','dessert')->take(100)->get();

    return view('index', compact('foods','drinks','desserts'));
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

    Route::get('/client/dashboard',[DashboardController::class,'client']);

    Route::get('/client/order/create',[OrderController::class,'create']);
    Route::post('/client/order/store',[OrderController::class,'store']);

    Route::get('/client/orders',[OrderController::class,'clientOrders']);

    Route::get('/client/cart',[CartController::class,'index']);
    Route::post('/client/cart/add',[CartController::class,'add']);
    Route::post('/client/cart/update',[CartController::class,'update']);
    Route::post('/client/cart/remove/{id}',[CartController::class,'remove']);
    Route::post('/client/cart/clear',[CartController::class,'clear']);
    Route::get('/client/inbox',[MessageController::class,'index']);
    Route::post('/client/inbox/read',[MessageController::class,'markAsRead']);

});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','admin'])->group(function(){

    Route::get('/admin/dashboard',[DashboardController::class,'admin']);

    Route::get('/admin/orders',[OrderController::class,'adminOrders']);
    Route::post('/admin/orders/{id}/approve',[OrderController::class,'approve']);
    Route::post('/admin/orders/{id}/cancel',[OrderController::class,'cancel']);

    Route::get('/admin/analytics',[DashboardController::class,'analytics']);
    Route::post('/admin/orders/{id}/payment',[OrderController::class,'updatePayment']);

});