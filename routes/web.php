<?php

use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ChildCategoryController;
use App\Http\Controllers\Backend\Product\DiscountController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\ShippingController;
use App\Http\Controllers\Backend\Product\SubCateogryController;
use App\Http\Controllers\Backend\Product\TempImageController;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\Backend\Shop\ShopController;
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

Route::prefix('admin/product')->group(function(){
/*Brand Route*/
Route::get('brand',[BrandController::class,'index'])->name('admin.brand.index');
Route::get('brand/create',[BrandController::class,'create'])->name('admin.brand.create');
Route::post('brand/store',[BrandController::class,'store'])->name('admin.brand.store');
Route::get('/brand/delete/{id}',[BrandController::class,'delete'])->name('admin.brand.delete');
Route::get('/brand/edit/{id}',[BrandController::class,'edit'])->name('admin.brand.edit');
Route::post('/brand/update',[BrandController::class,'update'])->name('admin.brand.update');


/*Category Route*/
Route::get('/category',[CategoryController::class,'index'])->name('admin.category.index');
Route::get('/category/create',[CategoryController::class,'create'])->name('admin.category.create');
Route::post('/category/store',[CategoryController::class,'store'])->name('admin.category.store');
Route::post('/category/delete',[CategoryController::class,'delete'])->name('admin.category.delete');
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.category.edit');
Route::post('/category/update',[CategoryController::class,'update'])->name('admin.category.update');


/* Sub Category Route*/
Route::get('/sub-category',[SubCateogryController::class,'index'])->name('admin.subcategory.index');
Route::post('/sub-category/store',[SubCateogryController::class,'store'])->name('admin.subcategory.store');
Route::get('/sub-category/edit/{id}',[SubCateogryController::class,'edit'])->name('admin.subcategory.edit');
Route::post('/sub-category/delete',[SubCateogryController::class,'delete'])->name('admin.subcategory.delete');
Route::post('/sub-category/update/{id}',[SubCateogryController::class,'update'])->name('admin.subcategory.update');
/*Get Sub Category*/
Route::get('/get-sub_category/{id}',[SubCateogryController::class,'get_sub_category']);


/* Child Category Route*/
Route::get('/child-category',[ChildCategoryController::class,'index'])->name('admin.childcategory.index');
Route::post('/child-category/store',[ChildCategoryController::class,'store'])->name('admin.childcategory.store');
Route::get('/child-category/edit/{id}',[ChildCategoryController::class,'edit'])->name('admin.childcategory.edit');
Route::post('/child-category/delete',[ChildCategoryController::class,'delete'])->name('admin.childcategory.delete');
Route::post('/child-category/update/{id}',[ChildCategoryController::class,'update'])->name('admin.childcategory.update');

/*Get child Category*/
Route::get('/get-child_category/{id}',[ChildCategoryController::class,'get_child_category']);





/* Product Route*/
Route::get('/product/all',[ProductController::class,'index'])->name('admin.products.index');
Route::get('/product/create',[ProductController::class,'create'])->name('admin.products.create');
Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('temp-image.create');
Route::post('/product/store',[ProductController::class,'store'])->name('admin.products.store');
Route::post('/product/delete',[ProductController::class,'delete'])->name('admin.products.delete');


/*Shipping Charge Route*/
Route::get('/shipping/charge/all',[ShippingController::class,'index'])->name('admin.shipping.index');
Route::get('/discount/get_data',[DiscountController::class,'get_all_data'])->name('admin.discount.all_data');
Route::get('/discount/edit/{id}',[DiscountController::class,'edit'])->name('admin.discount,edit');
Route::post('/discount/delete',[DiscountController::class,'delete'])->name('admin.discount.delete');
Route::post('/discount/store',[DiscountController::class,'store'])->name('admin.discount.store');
Route::post('/discount/update',[DiscountController::class,'update'])->name('admin.discount.update');



/* Discount Coupon Route*/
Route::get('/discount/all',[DiscountController::class,'index'])->name('admin.discount.index');
Route::get('/discount/get_data',[DiscountController::class,'get_all_data'])->name('admin.discount.all_data');
Route::get('/discount/edit/{id}',[DiscountController::class,'edit'])->name('admin.discount,edit');
Route::post('/discount/delete',[DiscountController::class,'delete'])->name('admin.discount.delete');
Route::post('/discount/store',[DiscountController::class,'store'])->name('admin.discount.store');
Route::post('/discount/update',[DiscountController::class,'update'])->name('admin.discount.update');

});


/** Seller Route **/
Route::prefix('admin/seller')->group(function(){
/** Seller Route **/
Route::get('create',[SellerController::class,'create'])->name('admin.seller.create');
Route::post('store',[SellerController::class,'store'])->name('admin.seller.store');
Route::get('all',[SellerController::class,'index'])->name('admin.seller.index');
Route::get('/all_data',[SellerController::class,'get_all_data'])->name('admin.seller.all_data');
Route::post('/delete',[SellerController::class,'delete'])->name('admin.seller.delete');
Route::get('/edit/{id}',[SellerController::class,'edit'])->name('admin.seller.edit');
Route::post('/update/{id}',[SellerController::class,'update'])->name('admin.seller.update');

/** Seller Withdraw Route **/

Route::get('/withdraw/index',[SellerController::class,'seller_withdraw_index'])->name('admin.seller.withdraw.index');
Route::get('/withdraw/all_data',[SellerController::class,'get_all_withdraw_data'])->name('admin.seller.withdraw.all_data');
Route::get('/withdraw/get/seller/name/{id}',[SellerController::class,'get_all_withdraw_seller_name'])->name('admin.seller.withdraw.get_seller_name');
Route::get('/withdraw/edit/{id}',[SellerController::class,'seller_withdraw_edit'])->name('admin.seller.withdraw.edit');
Route::post('/withdraw/update/',[SellerController::class,'seller_withdraw_update'])->name('admin.seller.withdraw.update');
Route::post('/withdraw/add/',[SellerController::class,'seller_withdraw_add'])->name('admin.seller.withdraw.add');
Route::post('/withdraw/delete/',[SellerController::class,'seller_withdraw_delete'])->name('admin.seller.withdraw.delete');

/** Seller  Withdraw Approve Route **/
Route::get('/withdraw/approve/all',[SellerController::class,'seller_withdraw_approve'])->name('admin.seller.withdraw.approve.index');

/** Seller  Withdraw Reject Route **/
Route::get('/withdraw/reject/all',[SellerController::class,'seller_withdraw_reject'])->name('admin.seller.withdraw.reject.index');

/** Seller Review Route **/
Route::get('/review/all',[SellerController::class,'seller_review'])->name('admin.seller.review.index');

});

/** Shop  Route **/
Route::prefix('admin/shop')->group(function(){
    Route::get('/list',[ShopController::class,'index'])->name('admin.shop.index');
    Route::get('/create',[ShopController::class,'create'])->name('admin.shop.create');
    Route::post('/store',[ShopController::class,'store'])->name('admin.shop.store');
});