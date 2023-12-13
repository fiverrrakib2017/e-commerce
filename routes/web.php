<?php

use App\Http\Controllers\Backend\Product\productBrandController;
use App\Http\Controllers\Backend\Product\productCategoryController;
use App\Http\Controllers\Backend\Product\productSubCateogryController;
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
})->name('admin.dashboard');

/*Brand Route*/
Route::get('admin/brand',[productBrandController::class,'index'])->name('admin.brand.index');
Route::get('admin/brand/create',[productBrandController::class,'create'])->name('admin.brand.create');
Route::post('admin/brand/store',[productBrandController::class,'store'])->name('admin.brand.store');
Route::get('admin/brand/delete/{id}',[productBrandController::class,'delete'])->name('admin.brand.delete');
Route::get('admin/brand/edit/{id}',[productBrandController::class,'edit'])->name('admin.brand.edit');
Route::post('admin/brand/update',[productBrandController::class,'update'])->name('admin.brand.update');


/*Category Route*/
Route::get('admin/category',[productCategoryController::class,'index'])->name('admin.category.index');
Route::get('admin/category/create',[productCategoryController::class,'create'])->name('admin.category.create');
Route::post('admin/category/store',[productCategoryController::class,'store'])->name('admin.category.store');
Route::post('admin/category/delete',[productCategoryController::class,'delete'])->name('admin.category.delete');
Route::get('admin/category/edit/{id}',[productCategoryController::class,'edit'])->name('admin.category.edit');
Route::post('admin/category/update',[productCategoryController::class,'update'])->name('admin.category.update');


/* Sub Category Route*/
Route::get('admin/sub-category',[productSubCateogryController::class,'index'])->name('admin.subcategory.index');
Route::post('admin/sub-category/store',[productSubCateogryController::class,'store'])->name('admin.subcategory.store');
Route::get('admin/sub-category/edit/{id}',[productSubCateogryController::class,'edit'])->name('admin.subcategory.edit');
Route::post('admin/sub-category/delete',[productSubCateogryController::class,'delete'])->name('admin.subcategory.delete');
Route::post('admin/sub-category/update/{id}',[productSubCateogryController::class,'update'])->name('admin.subcategory.update');