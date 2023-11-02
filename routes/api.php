<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get
Route::get('productList',[RouteController::class,'productList']);
Route::get('categoryList',[RouteController::class,'categoryList']);
Route::get('categoryList/{id}',[RouteController::class,'categoryListDetails']);

//post
Route::post('create/category',[RouteController::class,'createCategory']);

//delete
Route::post('delete/category',[RouteController::class,'deleteCategory']);

//update
Route::post('update/category',[RouteController::class,'updateCategory']);
