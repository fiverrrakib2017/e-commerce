<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Product_Order;
use App\Models\Product_Order_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(){
        $cart=Cart::where('user_id',auth()->id())->with('product')->get();

        $subtotal = $cart->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->qty;
        });
        $vatTax = $subtotal * 0.3;
        $deliveryCharge = 100;
        $total = $subtotal + $vatTax + $deliveryCharge;
        return view('Frontend.Pages.Cart.Cart',compact('cart', 'subtotal', 'vatTax', 'deliveryCharge', 'total'));
    }
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
    public function delete_cart(Request $request){
        $cart=Cart::find($request->id);
        $cart->delete();
        return redirect()->back()->with('success', 'Item Delete successfully!');
    }
    public function checkout(Request $request){
        /* Now  check if the cart items  empty*/
        if (Cart::where('user_id', Auth::id())->count() == 0) {
            return redirect()->back()->with('error', 'Your Cart is Empty');
        }
        
        $cart = Cart::where('user_id', Auth::id())->with('product')->get();
        
        /* Now  check if the cart items are not empty*/
        if ($cart->isNotEmpty()) {
           // return $cart;
           $order=new Product_Order();
           $order->user_id=Auth::id();
           $order->sub_total=$request->sub_total;
           $order->discount=0;
           $order->grand_total=$request->total;
           $order->payment_status=1;
           $order->note='note';
           $order->order_status=1;
           $order->shipping_id=1;
           $order->coupon_code='H#43Sd';
           $order->first_name=$request->first_name;
           $order->last_name=$request->last_name;
           $order->email_address=$request->email;
           $order->phone_number=$request->number;
           $order->country='Bangladesh';
           $order->address=$request->address;
           $order->appartment=$request->area;
           $order->city=$request->city;
           $order->state=$request->area;
           $order->zip_code=$request->zip_code;
           $order->save();

          
            foreach ($cart as $item) { 
                /* Now  insert the data order details table*/
                $order_details=new Product_Order_Details(); 
                $order_details->invoice_id = $order->id;
                $order_details->product_id = $item->product_id;
                $order_details->save();

                /* Now  calculation Product QTY From Product table*/
                $productData = Product::find($item->product_id);
                $currentQty = $productData->qty;
                $updatedQty = $currentQty-$item->qty;
                $productData->qty = $updatedQty;
                $productData->update();
            }
            /* Clear the user's cart after successful checkout */
            Cart::where('user_id', Auth::id())->delete();

            return redirect()->route('frontend.thank_you')->with('success', 'Order placed successfully');
        }
    }
}
