<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wish_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    public function wish_list(Request $request){
        // Check if user is authenticated
        if (!auth()->check()) {
            return response()->json(['error' =>"Please Login"]);
        }
        $data = Wish_list::with('product','user')->where('user_id', Auth::id())
            ->get();
        return view('Frontend.Pages.Wishlist.Wishlist',compact('data'));
    }
    public function wish_list_to_cart($product_id,$qty){
        /* Check if user is authenticated */ 
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $proudct=Product::find($product_id);
        
        if (($proudct==NULL)) {
            return redirect()->back()->with('error', 'Product not found');
        }
        if ($qty > $proudct->qty) {
            return redirect()->back()->with('error', 'Out of Stock');
        }
        // Check if the product is already in the  cart
        $existingCartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $product_id)
            ->first();

        if ($existingCartItem) {
            return redirect()->back()->with('error', 'Product already in cart');
        }

        $cart=new Cart();
        $cart->product_id=$product_id;
        $cart->user_id=Auth::id();
        $cart->qty=$qty;
        $cart->save();
        
        $wishlist=Wish_list::where(['product_id'=>$product_id]);
        $wishlist->delete();

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }
    public function delete_wishlist($deleteId){
        // Check if user is authenticated
         if (!auth()->check()) {
            return redirect()->route('login');
        }
        $wishlist=Wish_list::find($deleteId);
        $wishlist->delete();
        return redirect()->back()->with('success', 'Delete Successfully !');
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
