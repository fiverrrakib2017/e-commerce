<?php

use App\Http\Controllers\Backend\Address\AddressController;
use App\Http\Controllers\Backend\Address\CityController;
use App\Http\Controllers\Backend\Address\CountryController;
use App\Http\Controllers\Backend\Address\StateController;
use App\Http\Controllers\Backend\Blog\BlogController;
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ChildCategoryController;
use App\Http\Controllers\Backend\Product\DiscountController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Frontend\ProductController as FrontProudctController;
use App\Http\Controllers\Backend\Product\ShippingController;
use App\Http\Controllers\Backend\Product\SubCateogryController;
use App\Http\Controllers\Backend\Product\TempImageController;
use App\Http\Controllers\Backend\Seller\SellerController;
use App\Http\Controllers\Backend\Shop\pickupController;
use App\Http\Controllers\Backend\Shop\ShopController;
use App\Http\Controllers\Backend\Shop\StaffController;
use App\Http\Controllers\Backend\Blog\CategoryController as blogCategory;
use App\Http\Controllers\Backend\Customer\CustomerController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Order\OrderController;
use App\Http\Controllers\Backend\Subscriber\SubscriberController;
use App\Http\Controllers\Backend\Landing_Page\PageController;
use App\Http\Controllers\Backend\About\AboutController as AboutBackend; 
use App\Http\Controllers\Backend\Contract\ContractController as ContractBackend;
use App\Http\Controllers\Backend\Customer\InvoiceController;
use App\Http\Controllers\Backend\Supplier\Supplier_invoiceController;
use App\Http\Controllers\Backend\Supplier\SupplierController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FrontBlogController;
use App\Http\Controllers\Frontend\homeController;
use App\Http\Controllers\Frontend\Front_subscriber_Controller;
use App\Http\Controllers\Frontend\wishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
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

/* Frontend Route */

Route::get('/',[homeController::class,'index'])->name('frontend.home');
Route::get('/babybouncer',[homeController::class,'babybouncer']);
Route::get('/babyoffer',[homeController::class,'babyoffer']);
Route::post('/leadsave',[homeController::class,'leadSave'])->name('lead.save');
Route::get('/load-more', [homeController::class, 'load_more'])->name('frontend.load-more');
/* Product Details Route */
Route::get('/product/details/{id}',[FrontProudctController::class,'get_details'])->name('frontend.product.details');

/* Product  Route */
Route::get('/product/all',[FrontProudctController::class,'get_all_product'])->name('frontend.product.all');

/* Category base Product Route */
Route::get('/product/category/{id}',[FrontProudctController::class,'category_product'])->name('frontend.product.category');

/* Brand base Product Route */
Route::get('/product/brand/{id}',[FrontProudctController::class,'brand_product'])->name('frontend.product.brand');

/* Wishlist  Route */
Route::get('/wish/list',[wishlistController::class,'wish_list'])->name('frontend.wish_list');

Route::get('/wishlist/to/cart/{id}/{qty}',[wishlistController::class,'wish_list_to_cart'])->name('frontend.wish_list_to_cart');

Route::get('/wishlist/delete/{deleteId}',[wishlistController::class,'delete_wishlist'])->name('frontend.delete_wishlist');

Route::post('/add-to-wishlist',[wishlistController::class,'add_to_wishlist'])->name('frontend.add_to_wishlist');




/* Cart Route */
Route::post('/add-to-cart',[CartController::class,'add_to_cart'])->name('frontend.add_to_cart');
Route::get('/cart',[CartController::class,'cart'])->name('frontend.cart.index');
Route::post('/checkout',[CartController::class,'checkout'])->name('frontend.checkout');
Route::get('/thank/you',function(){
    return view('Frontend.Pages.thank_you');
})->name('frontend.thank_you');

/* Cart Checkout Route */
Route::get('/checkout',[CheckoutController::class,'index'])->name('frontend.checkout.index');
Route::post('/cart/checkout',[CheckoutController::class,'checkout'])->name('frontend.cart.checkout');


/* Order Route */
Route::get('/user/account/order/all',[AccountController::class,'order_list'])->name('frontend.order_list');

/* Return  Route */
Route::get('/user/account/return/order/all',[AccountController::class,'return_order_list'])->name('frontend.return_order_list');

/* Account  Route */
Route::get('/user/account/dashboard',[AccountController::class,'user_account_dashboard'])->name('frontend.user_account');

/* Order Cancle  Route */
Route::get('/user/account/order/cancle',[AccountController::class,'order_cancle'])->name('frontend.order_cancle');

/* Blog  Route */
Route::get('/user/blog/list',[FrontBlogController::class,'show_blog_page'])->name('frontend.blog');

Route::get('/user/blog/category/{id}',[FrontBlogController::class,'category_blog'])->name('frontend.category_blog');

Route::get('/user/single/blog/{blogId}',[FrontBlogController::class,'single_blog_page'])->name('frontend.single_blog_page');

/* About US   Route */
Route::get('/user/about',[AboutController::class,'show_about'])->name('frontend.show_about');


/* Contract  Route */
Route::get('/user/contact',[ContactController::class,'show_contact'])->name('frontend.show_contact');
Route::post('/user/contact/send',[ContactController::class,'send_data'])->name('frontend.contract.send_data');


/* Subscriber Route */
Route::post('/user/subscriber/store/data',[Front_subscriber_Controller::class,'store'])->name('frontend.subscriber.store');


/* Backend Route */

Route::get('/admin/login', [AdminController::class, 'login_form'])->name('admin.login');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login.functionality');

Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/logout',[AdminController::class,'logout'])->name('admin.logout');
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

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
        Route::get('/all',[ProductController::class,'index'])->name('admin.products.index');
        Route::get('/get_product/{id}',[ProductController::class,'get_product'])->name('admin.products.get_product');
        Route::get('/create',[ProductController::class,'create'])->name('admin.products.create');
        Route::get('/edit/{id}',[ProductController::class,'edit'])->name('admin.products.edit');
        Route::post('/upload-temp-image', [TempImageController::class, 'create'])->name('tempimage.create');
        Route::post('/store',[ProductController::class,'store'])->name('admin.products.store');
        Route::post('/delete',[ProductController::class,'delete'])->name('admin.products.delete');


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
        Route::get('/all_data',[ShopController::class,'get_all_data'])->name('admin.shop.all_data');
        Route::post('/delete',[ShopController::class,'delete'])->name('admin.shop.delete');
        Route::get('/edit/{id}',[ShopController::class,'edit'])->name('admin.shop.edit');
        Route::post('/update',[ShopController::class,'update'])->name('admin.shop.update');
        /** Staff  Route **/
        Route::get('/staff/list',[StaffController::class,'index'])->name('admin.staff.index');
        Route::get('/staff/all_data',[StaffController::class,'all_data'])->name('admin.staff.all_data');
        Route::post('/staff/store',[StaffController::class,'store'])->name('admin.staff.store');
        Route::get('/staff/edit/{id}',[StaffController::class,'edit'])->name('admin.staff.edit');
        Route::post('/staff/update/',[StaffController::class,'update'])->name('admin.staff.update');
        Route::post('/staff/delete/',[StaffController::class,'delete'])->name('admin.staff.delete');

        /** Pick up Point  Route **/
        Route::get('/pickup-point',[pickupController::class,'index'])->name('admin.pickup.index');
        Route::get('/pickup-point/all/data',[pickupController::class,'get_all_data'])->name('admin.pickup.all_data');
        Route::post('/pickup-point/store',[pickupController::class,'store'])->name('admin.pickup.store');
        Route::post('/pickup-point/delete',[pickupController::class,'delete'])->name('admin.pickup.delete');
        Route::get('/pickup-point/edit/{id}',[pickupController::class,'edit'])->name('admin.pickup.edit');
        Route::post('/pickup-point/update/',[pickupController::class,'update'])->name('admin.pickup.update');

    });
    /** Blog  Route **/
    Route::prefix('admin/blog')->group(function(){
        /** Category  Route **/
        Route::get('/category/list',[blogCategory::class,'index'])->name('admin.blog.category.index');
        Route::get('/category/all/data',[blogCategory::class,'get_all_data'])->name('admin.blog.category.all_data');

        Route::post('/category/store',[blogCategory::class,'store'])->name('admin.blog.category.store');

        Route::get('/category/edit/{id}',[blogCategory::class,'edit'])->name('admin.blog.category.edit');

        Route::post('/category/delete/',[blogCategory::class,'delete'])->name('admin.blog.category.delete');

        Route::post('/category/update/',[blogCategory::class,'update'])->name('admin.blog.category.update');
        /** Blog  Route **/
        Route::get('/list',[BlogController::class,'index'])->name('admin.blog.index');
        Route::get('/all-data',[BlogController::class,'get_all_data'])->name('admin.blog.all_data');
        Route::get('/create',[BlogController::class,'create'])->name('admin.blog.create');
        Route::post('/store-data',[BlogController::class,'store'])->name('admin.blog.store');
        Route::get('/edit/{id}',[BlogController::class,'edit'])->name('admin.blog.edit');
        Route::post('/update',[BlogController::class,'update'])->name('admin.blog.update');
        Route::post('/delete',[BlogController::class,'delete'])->name('admin.blog.delete');
    });
    /** Address  Route **/
    Route::prefix('admin/address')->group(function(){
        /** Country  Route **/
        Route::get('/country/list',[CountryController::class,'index'])->name('admin.address.country.index');

        Route::get('/country/get_all_data',[CountryController::class,'get_all_data'])->name('admin.address.country.all_data');

        Route::post('/country/store',[CountryController::class,'store'])->name('admin.address.country.store');

        Route::get('/country/edit/{id}',[CountryController::class,'edit'])->name('admin.address.country.edit');

        Route::post('/country/update',[CountryController::class,'update'])->name('admin.address.country.update');

        Route::post('/country/delete',[CountryController::class,'delete'])->name('admin.address.country.delete');

        /** State  Route **/
        Route::get('/state/list',[StateController::class,'index'])->name('admin.address.state.index');

        Route::get('/state/get_all_data',[StateController::class,'get_all_data'])->name('admin.address.state.all_data');

        Route::post('/state/store',[StateController::class,'store'])->name('admin.address.state.store');

        Route::get('/state/edit/{id}',[StateController::class,'edit'])->name('admin.address.state.edit');

        Route::post('/state/update',[StateController::class,'update'])->name('admin.address.state.update');

        Route::post('/state/delete',[StateController::class,'delete'])->name('admin.address.state.delete');

        /** City   Route **/
        Route::get('/city/list',[CityController::class,'index'])->name('admin.address.city.index');

        Route::get('/city/get_all_data',[CityController::class,'get_all_data'])->name('admin.address.city.all_data');

        Route::get('/city/edit/{id}',[CityController::class,'edit'])->name('admin.address.city.edit');

        Route::post('/city/update',[CityController::class,'update'])->name('admin.address.city.update');

        Route::post('/city/store',[CityController::class,'store'])->name('admin.address.city.store');

        Route::post('/city/delete',[CityController::class,'delete'])->name('admin.address.city.delete');

        /** Address  Route **/
        Route::get('/list',[AddressController::class,'index'])->name('admin.address.index');

        Route::get('/get_all_data',[AddressController::class,'get_all_data'])->name('admin.address.all_data');

        Route::post('/store',[AddressController::class,'store'])->name('admin.address.store');

        Route::get('/edit/{id}',[AddressController::class,'edit'])->name('admin.address.edit');

        Route::post('/update',[AddressController::class,'update'])->name('admin.address.update');

        Route::post('/delete',[AddressController::class,'delete'])->name('admin.address.delete');
    });

    /** Customer  Route **/
    Route::prefix('admin/customer')->group(function(){
        Route::get('/list',[CustomerController::class,'index'])->name('admin.customer.index');

        Route::get('/all-data',[CustomerController::class,'get_all_data'])->name('admin.customer.get_all_data');

        Route::get('/create',[CustomerController::class,'create'])->name('admin.customer.create');

        Route::get('/edit/{id}',[CustomerController::class,'edit'])->name('admin.customer.edit');

        Route::post('/delete',[CustomerController::class,'delete'])->name('admin.customer.delete');

        Route::post('/store',[CustomerController::class,'store'])->name('admin.customer.store');

        Route::post('/update/{id}',[CustomerController::class,'update'])->name('admin.customer.update');

         /** Customer Invoice  Route **/
         Route::get('/invoice/create',[InvoiceController::class,'create_invoice'])->name('admin.customer.invoice.create_invoice');

         Route::get('/invoice/get_all_data',[InvoiceController::class,'show_invoice_data'])->name('admin.customer.invoice.show_invoice_data');
         
         /*Seach Invoice Page Product Data*/
         Route::post('/invoice/search_data',[InvoiceController::class,'search_product_data'])->name('admin.customer.invoice.search_product_data');

         Route::get('/invoice/show',[InvoiceController::class,'show_invoice'])->name('admin.customer.invoice.show_invoice');

        Route::post('/invoice/store',[InvoiceController::class,'store_invoice'])->name('admin.customer.invoice.store_invoice');

        Route::get('/invoice/view/{id}',[InvoiceController::class,'view_invoice'])->name('admin.customer.invoice.view_invoice');

         Route::get('/invoice/edit/{id}',[InvoiceController::class,'edit_invoice'])->name('admin.customer.invoice.edit_invoice');

         Route::post('/invoice/update',[InvoiceController::class,'update_invoice'])->name('admin.customer.invoice.update_invoice');

         Route::post('/invoice/delete',[InvoiceController::class,'delete_invoice'])->name('admin.customer.invoice.delete_invoice');

        

        
    });

    /** Supplier Mangement   Route **/
    Route::prefix('admin/supplier')->group(function(){
        Route::get('/list',[SupplierController::class,'index'])->name('admin.supplier.index');

        Route::get('/all-data',[SupplierController::class,'get_all_data'])->name('admin.supplier.get_all_data');

        Route::get('/create',[SupplierController::class,'create'])->name('admin.supplier.create');

        Route::post('/store',[SupplierController::class,'store'])->name('admin.supplier.store');
        
        Route::get('/edit/{id}',[SupplierController::class,'edit'])->name('admin.supplier.edit');

        Route::post('/update/{id}',[SupplierController::class,'update'])->name('admin.supplier.update');

        Route::post('/delete',[SupplierController::class,'delete'])->name('admin.supplier.delete');

        /** Supplier Invoice  Route **/
        Route::get('/invoice/create',[Supplier_invoiceController::class,'create_invoice'])->name('admin.supplier.invoice.create_invoice');

        Route::get('/invoice/get_all_data',[Supplier_invoiceController::class,'show_invoice_data'])->name('admin.supplier.invoice.show_invoice_data');

        Route::post('/invoice/store',[Supplier_invoiceController::class,'store_invoice'])->name('admin.supplier.invoice.store_invoice');

        Route::get('/invoice/show',[Supplier_invoiceController::class,'show_invoice'])->name('admin.supplier.invoice.show_invoice');

        Route::get('/invoice/view/{id}',[Supplier_invoiceController::class,'view_invoice'])->name('admin.supplier.invoice.view_invoice');

        Route::get('/invoice/edit/{id}',[Supplier_invoiceController::class,'edit_invoice'])->name('admin.supplier.invoice.edit_invoice');

        Route::post('/invoice/update',[Supplier_invoiceController::class,'update_invoice'])->name('admin.supplier.invoice.update_invoice');

        Route::post('/invoice/delete',[Supplier_invoiceController::class,'delete_invoice'])->name('admin.supplier.invoice.delete_invoice');
         
    });

    /** Order Mangement   Route **/
    Route::prefix('admin/order')->group(function(){

        Route::get('/list',[OrderController::class,'index'])->name('admin.order.index');

        Route::get('/get_order/{id}',[OrderController::class,'get_order'])->name('admin.order.get_order');

        Route::get('/all-data',[OrderController::class,'get_all_data'])->name('admin.order.get_all_data');

        Route::post('/note/store',[OrderController::class,'order_note_store'])->name('admin.order.note.store');
        
        Route::get('/get_note/{id}',[OrderController::class,'get_note'])->name('admin.order.get_note');

        Route::post('/confirm_order/{id}',[OrderController::class,'confirm_order'])->name('admin.order.confirm_order');

        Route::post('/delete',[OrderController::class,'delete'])->name('admin.order.delete');
    });


    /** Landing Page Mangement Route **/
    Route::prefix('admin/landing_page')->group(function(){
        Route::get('/list',[PageController::class,'index'])->name('admin.landing_page.index');
        Route::get('/create',[PageController::class,'create'])->name('admin.landing_page.create');
        Route::post('/save-page',[PageController::class,'save_page'])->name('admin.landing_page.save_page');
        Route::get('/get_all_data',[PageController::class,'get_all_data'])->name('admin.landing_page.get_all_data');
        Route::post('/delete',[PageController::class,'delete'])->name('admin.landing_page.delete');
        Route::get('/view/{id}',[PageController::class,'view'])->name('admin.landing_page.view');
        Route::get('/edit/{id}',[PageController::class,'edit'])->name('admin.landing_page.edit');
        Route::post('/update/{id}',[PageController::class,'update'])->name('admin.landing_page.update_page');

    });

    /**Home Page  Mangement Route **/
    Route::prefix('admin/home_page')->group(function(){
         /** About Route **/
        Route::get('/about/list',[AboutBackend::class,'index'])->name('admin.home_page.about.index');

        Route::get('/about/get_all_data',[AboutBackend::class,'get_all_data'])->name('admin.home_page.about.all_data');

        Route::post('/about/store',[AboutBackend::class,'store'])->name('admin.home_page.about.store');

        Route::post('/about/delete',[AboutBackend::class,'delete'])->name('admin.home_page.about.delete');

        Route::get('/about/edit/{id}',[AboutBackend::class,'edit'])->name('admin.home_page.about.edit');

        Route::post('/about/update',[AboutBackend::class,'update'])->name('admin.home_page.about.update');

        /** Contract Route **/
        Route::get('/contract/list',[ContractBackend::class,'index'])->name('admin.home_page.contract.index');

        Route::get('/contract/all_data',[ContractBackend::class,'get_all_data'])->name('admin.home_page.contract.all_data');

        Route::post('/contract/delete',[ContractBackend::class,'delete'])->name('admin.home_page.contract.delete');

    });

    /** Subscrib  Route **/
     Route::get('/admin/subscriber/data/all',[SubscriberController::class,'index'])->name('admin.subscriber.index');
     Route::get('/admin/subscriber/get_all_data',[SubscriberController::class,'get_all_data'])->name('admin.subscriber.get_all_data');
     Route::post('/admin/subscriber/delete/',[SubscriberController::class,'delete'])->name('admin.subscriber.delete');
});



/*Important Route*/

Route::get('/migrate-fresh-seed',function(){
    Artisan::call('migrate:fresh --seed');
      // Return a response
    return response('Migration and seeding complete');
});
Route::get('/config/cache',function(){
    Artisan::call('config:cache');
    return response('Configuration cached successfully.');
});
Route::get('/optimize', function () {
    // Run optimize commands
    Artisan::call('optimize');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');

    // Return a response
    return response('Optimization complete');
});
Route::get('/migrate',function(){
    Artisan::call('migrate');
      // Return a response
    return response('Migration complete');
});




Auth::routes();

