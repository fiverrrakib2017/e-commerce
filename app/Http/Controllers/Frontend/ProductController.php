<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Brand;
use App\Models\Product_Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get_details($id) {
        $product = Product::with('product_image', 'brand', 'category')->find($id);
    
        return view('Frontend.Pages.Product.Product_Details',compact('product'));
    }
    public function category_product($id){
        $category=Product_Category::latest()->get();
        $brand=Product_Brand::latest()->get();
        $data = Product::where(['category_id' => $id])->paginate(9);
        
        return view('Frontend.Pages.Product.Category_Product',compact('data','category','brand'));
    }
}    
