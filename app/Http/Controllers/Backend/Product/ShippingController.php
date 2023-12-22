<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(){
        return  view('Backend.Pages.Product.Shipping-Charge.index');
    }
   
}
