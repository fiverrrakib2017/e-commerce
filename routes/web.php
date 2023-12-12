<?php

use App\Http\Controllers\Backend\Product\productBrandController;
use App\Http\Controllers\Frontend\homeController;
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
Route::get('/',[homeController::class,'index']);

Route::get('/admin/dashboard', function () {
    return view('Backend.Pages.Dashboard.index');
});

Route::get('admin/brand',[productBrandController::class,'index'])->name('admin.brand.index');
Route::get('admin/brand/create',[productBrandController::class,'create'])->name('admin.brand.create');
Route::post('admin/brand/store',[productBrandController::class,'store'])->name('admin.brand.store');
Route::get('admin/brand/delete/{id}',[productBrandController::class,'delete'])->name('admin.brand.delete');
Route::get('admin/brand/edit/{id}',[productBrandController::class,'edit'])->name('admin.brand.edit');
Route::post('admin/brand/update',[productBrandController::class,'update'])->name('admin.brand.update');