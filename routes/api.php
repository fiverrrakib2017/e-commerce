<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\ProductController;

Route::post('login',[AuthController::class,'login']);

Route::post('logout',[AuthController::class,'logout'])
  ->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user/landing-page',[LandingPageController::class,'index']);

    Route::get('/user/landing-page/{id}',[LandingPageController::class,'view']);

    Route::get('/products',[ProductController::class,'index']);

    Route::get('/product/{id}',[ProductController::class,'get_product']);
});
Route::get('/dev/products',[ProductController::class,'indexForDev']);

Route::get('/dev/product/{id}',[ProductController::class,'get_productForDev']);
Route::get('/dev/user/landing-page/{id}',[LandingPageController::class,'viewForDev']);
Route::get('/dev/user/landing-page/{id}/save',[LandingPageController::class,'DevSave']);
