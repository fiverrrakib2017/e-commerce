<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Product_Category;
use Illuminate\Http\Request;

class productCategoryController extends Controller
{
    public function index(){
        $data=Product_Category::latest()->get();
        return view('Backend.Pages.Product.Category.index',compact('data'));
    }
    public function create(){
        return view('Backend.Pages.Product.Category.Add');
    }
    public function store(Request $request){
        return $request->all(); exit;
    }
}
