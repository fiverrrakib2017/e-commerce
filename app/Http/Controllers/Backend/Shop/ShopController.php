<?php

namespace App\Http\Controllers\Backend\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        return view('Backend.Pages.Shop.index');
    }
    public function create(){
        return view('Backend.Pages.Shop.Create');
    }
    public function store(Request $request){
        return $request->all();
    }
}
