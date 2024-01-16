<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use Illuminate\Http\Request;

class homeController extends Controller
{
    public function index(){
        $brand=Product_Brand::latest()->get();
        $category=Product_Category::latest()->get();
        $product=Product::with('product_image','brand','category')->latest()->get();

        return view('Frontend.Pages.Home.Home',compact('brand','category','product'));
    }
}
