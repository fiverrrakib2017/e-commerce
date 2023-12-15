<?php

use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ChildCategoryController;
use App\Http\Controllers\Backend\Product\DiscountController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\SubCateogryController;
use App\Http\Controllers\Backend\Product\TempImageController;
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
Route::get('admin/brand',[BrandController::class,'index'])->name('admin.brand.index');
Route::get('admin/brand/create',[BrandController::class,'create'])->name('admin.brand.create');
Route::post('admin/brand/store',[BrandController::class,'store'])->name('admin.brand.store');
Route::get('admin/brand/delete/{id}',[BrandController::class,'delete'])->name('admin.brand.delete');
Route::get('admin/brand/edit/{id}',[BrandController::class,'edit'])->name('admin.brand.edit');
Route::post('admin/brand/update',[BrandController::class,'update'])->name('admin.brand.update');


/*Category Route*/
Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category.index');
Route::get('admin/category/create',[CategoryController::class,'create'])->name('admin.category.create');
Route::post('admin/category/store',[CategoryController::class,'store'])->name('admin.category.store');
Route::post('admin/category/delete',[CategoryController::class,'delete'])->name('admin.category.delete');
Route::get('admin/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
Route::post('admin/category/update',[CategoryController::class,'update'])->name('admin.category.update');


/* Sub Category Route*/
Route::get('admin/sub-category',[SubCateogryController::class,'index'])->name('admin.subcategory.index');
Route::post('admin/sub-category/store',[SubCateogryController::class,'store'])->name('admin.subcategory.store');
Route::get('admin/sub-category/edit/{id}',[SubCateogryController::class,'edit'])->name('admin.subcategory.edit');
Route::post('admin/sub-category/delete',[SubCateogryController::class,'delete'])->name('admin.subcategory.delete');
Route::post('admin/sub-category/update/{id}',[SubCateogryController::class,'update'])->name('admin.subcategory.update');
/*Get Sub Category*/
Route::get('/get-sub_category/{id}',[SubCateogryController::class,'get_sub_category']);


/* Child Category Route*/
Route::get('admin/child-category',[ChildCategoryController::class,'index'])->name('admin.childcategory.index');
Route::post('admin/child-category/store',[ChildCategoryController::class,'store'])->name('admin.childcategory.store');
Route::get('admin/child-category/edit/{id}',[ChildCategoryController::class,'edit'])->name('admin.childcategory.edit');
Route::post('admin/child-category/delete',[ChildCategoryController::class,'delete'])->name('admin.childcategory.delete');
Route::post('admin/child-category/update/{id}',[ChildCategoryController::class,'update'])->name('admin.childcategory.update');

/*Get child Category*/
Route::get('/get-child_category/{id}',[ChildCategoryController::class,'get_child_category']);





/* Product Route*/
Route::get('/admin/product/all',[ProductController::class,'index'])->name('admin.products.index');
Route::get('/admin/product/create',[ProductController::class,'create'])->name('admin.products.create');
Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('temp-image.create');
Route::post('/admin/product/store',[ProductController::class,'store'])->name('admin.products.store');
Route::post('/admin/product/delete',[ProductController::class,'delete'])->name('admin.products.delete');


/* Product Route*/
Route::get('/admin/product/discount/all',[DiscountController::class,'index'])->name('admin.discount.index');