<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('Backend.Pages.Product.index');
    }
    public function create(){
        return view('Backend.Pages.Product.Create');
    }
}
