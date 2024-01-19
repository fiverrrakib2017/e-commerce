<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wish_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    public function show(){
        return 'this is show method';
    }
    public function add_to_wishlist(Request $request){
        // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json(['error' =>"Please Login"]);
        }
        $proudct=Product::find($request->product_id);
        
        if (($proudct==NULL)) {
            return response()->json(['error' =>"Product not found"]);
        }
        if ($request->qty > $proudct->qty) {
            return response()->json(['error' =>"Out of Stock"]);
        }
        // Check if the product is already in the  cart
        $existingCartItem = Wish_list::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCartItem) {
            return response()->json(['error' =>"Product already in WishList"]);
        }

        $cart=new Wish_list();
        $cart->product_id=$request->product_id;
        $cart->user_id=Auth::id();
        $cart->qty=$request->qty;
        $cart->save();

        return response()->json(['success' =>"Item added"]);
    }
}
