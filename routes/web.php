<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/{account_code}', [RoutingController::class, 'view_LoginPage'])
    ->name('login.page');


Route::get('/calvinstore', function () {
    return redirect()->route('login.page');
});


// AUTHORIZATION
Route::get('/{account_code}/signup', [RoutingController::class, 'view_SignUp'])->name('signup.page');

Route::post('/login-post', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');


// DASHBOARD SELLER
Route::middleware(['role:admin_seller'])->group(function () {
    Route::get('/{account_code}/dashboard-seller', [SellerController::class, 'view_HomeSeller'])->name('dashboard.home.seller');

    //PRODUCTS ------------------------------------
    Route::get('/{account_code}/products', [SellerController::class, 'view_Product'])->name('seller.products');

    Route::get('/{account_code}/products/{slug}/edit-page', [ProductController::class, 'edit_Product'])
        ->name('products.editPage');

    Route::put('/{account_code}/products/{slug}', [ProductController::class, 'update_Product'])
        ->name('products.update');

    // delete
    Route::delete('/{account_code}/products/delete/{slug}', [
        ProductController::class,
        'delete_Product'
    ])->name('products.destroy');

    Route::get('/{account_code}/add-product', [ProductController::class, 'add_Product_Page'])
        ->name('add.product.page');

    Route::post('/{account_code}/post-product', [ProductController::class, 'post_Product'])
        ->name('post.product');



    //PREORDER ------------------------------------
    Route::get('/{account_code}/preorderlist', [SellerController::class, 'view_PreOrderList'])
        ->name('seller.preorder.preorderlist');
    Route::get('/{account_code}/preordercreate', [SellerController::class, 'view_PreOrderCreate'])
        ->name('seller.preorder.create');
});

Route::middleware(['role:user'])->group(function () {
    Route::get('/{account_code}/dashboard-user', [UserController::class, 'view_HomeUser'])->name('dashboard.home.user');
});
