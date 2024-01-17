<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add_to_cart(Request $request){
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $proudct=Product::find($request->product_id);
        
        if (($proudct==NULL)) {
            return redirect()->back()->with('error', 'Product not found');
        }
        if ($request->qty > $proudct->qty) {
            return redirect()->back()->with('error', 'Out of Stock');
        }
        // Check if the product is already in the  cart
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            return redirect()->back()->with('error', 'Product already in cart');
        }

        $cart=new Cart();
        $cart->product_id=$request->product_id;
        $cart->user_id=Auth::id();
        $cart->qty=$request->qty;
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }
}
