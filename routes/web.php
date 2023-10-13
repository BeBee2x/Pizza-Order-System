<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    Route::middleware(['admin_auth'])->group(function () {

        //category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category-list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('category-createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category-create');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category-delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category-edit');
            Route::post('update',[CategoryController::class,'update'])->name('category-update');
        });

        //admin account
        Route::prefix('admin')->group(function () {
            //account center
            Route::get('account/info',[AdminController::class,'accountInfo'])->name('admin-accountInfo');
            Route::get('account/info/editpage',[AdminController::class,'accountInfoEditPage'])->name('admin-accountInfoEditPage');
            Route::post('account/info/update/{id}',[AdminController::class,'accountInfoUpdate'])->name('admin-accountInfoUpdate');
            //password
            Route::get('password/changePage',[AdminController::class,'changePasswordPage'])->name('admin-changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin-changePassword');
            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin-list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin-delete');
            Route::get('changeRolePage/{id}',[AdminController::class,'changeRolePage'])->name('admin-changeRolePage');
            Route::post('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin-changeRole');
            //user list
            Route::get('userList',[AdminController::class,'userList'])->name('admin-userList');
            Route::get('changeAdminPage/{id}',[AdminController::class,'changeAdminPage'])->name('admin-changeAdminPage');
            Route::get('deleteUser/{id}',[AdminController::class,'deleteUser'])->name('admin-deleteUser');
            Route::post('changeAdmin/{id}',[AdminController::class,'changeAdmin'])->name('admin-changeAdmin');
            Route::get('editUserPage/{id}',[AdminController::class,'editUserPage'])->name('admin-editUserPage');
            //user message
            Route::get('userMessagePage',[AdminController::class,'userMessagePage'])->name('admin-userMessagePage');
        });

        //products
        Route::prefix('product')->group(function(){
            //list
            Route::get('list',[ProductController::class,'list'])->name('product-list');
            Route::get('createPage',[ProductController::class,'createPage'])->name('product-createPage');
            Route::post('create',[ProductController::class,'create'])->name('product-create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product-delete');
            Route::get('details/{id}',[ProductController::class,'details'])->name('product-details');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product-editPage');
            Route::post('update',[ProductController::class,'update'])->name('product-update');
        });

        Route::prefix('order')->group(function(){
            //list
            Route::get('list',[OrderController::class,'list'])->name('order-list');
            Route::post('searchByStatus',[OrderController::class,'searchByStatus'])->name('order-searchByStatus');
            Route::get('statusChange',[OrderController::class,'statusChange'])->name('order-statusChange');
            Route::get('details/{orderCode}',[OrderController::class,'details'])->name('order-details');
        });

    });

    //user
    Route::group(['prefix'=>'user','middleware' => 'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user-home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user-filter');
        Route::get('history',[UserController::class,'history'])->name('user-history');
        Route::get('contactPage',[UserController::class,'contactPage'])->name('user-contactPage');
        Route::post('sendContactMessage',[UserController::class,'sendContactMessage'])->name('user-sendContactMessage');
        Route::get('successPage',[UserController::class,'successPage'])->name('user-successPage');

        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user-pizzaDetails');
        });

        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user-cartList');
            Route::get('clear',[UserController::class,'clearCart'])->name('user-clearCart');
        });

        Route::prefix('password')->group(function(){
            Route::get('changePage',[UserController::class,'changePasswordPage'])->name('user-changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user-changePassword');
        });

        Route::prefix('account')->group(function(){
            Route::get('details',[UserController::class,'details'])->name('user-details');
            Route::get('updatePage',[UserController::class,'updatePage'])->name('user-updatePage');
            Route::post('update,{id}',[UserController::class,'update'])->name('user-update');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('pizzalist',[AjaxController::class,'pizzalist'])->name('ajax-pizzalist');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax-addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax-order');
            Route::get('viewCount',[AjaxController::class,'viewCount'])->name('ajax-viewCount');
        });

    });

});

//login & register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth-loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth-registerPage');
});
