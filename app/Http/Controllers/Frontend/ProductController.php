<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get_details($id) {
        $product = Product::with('product_image', 'brand', 'category')->find($id);
    
        return view('Frontend.Pages.Product.Product_Details',compact('product'));
    }
}    
