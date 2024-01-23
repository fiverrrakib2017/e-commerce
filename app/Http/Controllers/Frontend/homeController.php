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
        $product=Product::with('product_image','brand','category')->latest()->paginate(8);
        
        return view('Frontend.Pages.Home.Home',compact('brand','category','product'));
    }
    public function load_more(Request $request)
    {
        $start = $request->input('start');
        $data=Product::with('product_image','brand','category')->latest()->offset($start)
        ->limit(8)
        ->get();
        return response()->json([
            'data' => $data,
            'next' => $start + 8
        ]);
    }
    
    
}
