<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/login-seller', [RoutingController::class, 'view_LoginPageSeller'])->name('login.page.seller');

Route::get('/login', [RoutingController::class, 'view_LoginPage'])->name('login.page');

Route::get('/', function () {
    return redirect()->route('login.page');
});


// AUTHORIZATION
Route::post('/login-seller', [AuthController::class, 'login_seller'])->name('login.seller.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signup', [RoutingController::class, 'view_SignUp'])->name('signup.page');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');


// DASHBOARD SELLER
Route::middleware(['role:admin_seller'])->group(function () {
    Route::get('/dashboard-home-seller', [SellerController::class, 'view_HomeSeller'])->name('dashboard.home.seller');
    Route::get('/products', [SellerController::class, 'view_Product'])->name('seller.products');

    // ambil data product (JSON) untuk modal edit
    Route::get('/products/{id}/json', [SellerController::class, 'get_ProductJson'])->name('products.json');

    // update
    Route::put('/products/{id}', [SellerController::class, 'update_Product'])->name('products.update');

    // delete
    Route::delete('/products/{id}', [SellerController::class, 'delete_Product'])->name('products.destroy');
});



Route::middleware(['role:user'])->group(function () {
    Route::get('/dashboard-home-user', [UserController::class, 'view_HomeUser'])->name('dashboard.home.user');
});