<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product_Order;
use App\Models\Product_Order_Details;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function order_list(){
        $data = Product_Order::where('user_id', Auth::user()->id)->latest()->get();
        return view('Frontend.Pages.Order.Order', compact('data'));
    }
    public function return_order_list(){
        $data = Product_Order::where('user_id', Auth::user()->id)->latest()->get();
        return view('Frontend.Pages.Return_Order.Return_Order', compact('data'));
    }
    public function user_account_dashboard(){
        $data=User::find(Auth::user()->id);
        return view('Frontend.Pages.Account.Account',compact('data'));
    }
    public function order_cancle(){

        $data = Product_Order::where('user_id', Auth::user()->id)->latest()->get();
        return view('Frontend.Pages.Order.Order_Cancle',compact('data'));
    }
    
}
