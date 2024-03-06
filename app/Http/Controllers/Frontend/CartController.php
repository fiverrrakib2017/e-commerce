<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Product_Order;
use App\Models\Invoice_Note;
use App\Models\Product_Order_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class CartController extends Controller
{
    private function extractTaxRate($tax)
    {
        /* Default to 5% if 'tax' is not numeric */
        return is_numeric($tax) ? $tax / 100 : 0.00;
    }
    public function cart()
    {
        $cart = Cart::where('user_id', auth()->id())->with('product')->get();
        $subtotal = 0;
        $vatTax = 0;
        $deliveryCharge = 0;
        $total = 0;

        if (!$cart->isEmpty()) {
            $subtotal = $cart->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->qty;
            });

            /* Calculate total with respective tax rates */
            foreach ($cart as $cartItem) {
                $vatTaxRate = $this->extractTaxRate($cartItem->product->tax);
                $price = is_numeric($cartItem->product->price) ? $cartItem->product->price : 0;
                $qty = is_numeric($cartItem->qty) ? $cartItem->qty : 0;
                $vatTax += ($price * $qty) * $vatTaxRate;

                $deliveryCharge = $cartItem->product->delivery_charge ?? 0;
                break;
            }

            $total = $subtotal + $vatTax + $deliveryCharge;
            $total = floor($total);
        }

        return view('Frontend.Pages.Cart.newCart', compact('cart', 'subtotal', 'vatTax', 'deliveryCharge', 'total'));
    }
    

    public function add_to_cart(Request $request)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $proudct = Product::find($request->product_id);

        if (($proudct == null)) {
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

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->user_id = Auth::id();
        $cart->qty = $request->qty;
        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }
    public function delete_cart(Request $request)
    {
        $cart = Cart::find($request->id);
        $cart->delete();
        return redirect()->back()->with('success', 'Item Delete successfully!');
    }

    public function checkout(Request $request)
    {
       

        $user=Auth::user();
        if($request->has('landingpage')){
            $request->validate([
                'number' => 'required|string',
                'userName' => 'required|string',
            ]);
            $number=preg_replace('/[^0-9]/', '', $request->number);
           $user= User::where('email',$number.'@chepapest.com')->first();
           if(!isset($user->id)){
                $user=new User;
                $user->email=$number.'@chepapest.com';
                $user->password=Hash::make($number);
                $user->name=$request->userName;
                $user->save();
            }
            Auth::loginUsingId($user->id);
            $cart = new Cart();
            $cart->product_id = $request->product_id;
            $cart->user_id = $user->id;
            $cart->qty = $request->qty;
            $cart->save();
        }
        /* Now  check if the cart items  empty*/
        $cart = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Your Cart is Empty');
        }

        /* Now  check if the cart items are not empty*/
        if ($cart->isNotEmpty()) {
            if($request->has('landingpage')){
                $order= $this->landingPageOrder($user,$request,$cart);
            }else{
                $order= $this->storeOrder($user,$request,$cart);
            }
            /* Clear the user's cart after successful checkout */
            Cart::where('user_id', Auth::id())->delete();
            return redirect()->route('frontend.thank_you')->with('order',$order);
            /* Make a request to the courier service API to create a Parcel */
            // $courierApiUrl = 'https://portal.steadfast.com.bd/api/v1/create_order';
            // $courierData = [
            //     'invoice' => $order->id,
            //     'recipient_name' => $order->first_name . ' ' . $request->last_name,
            //     'recipient_phone' => $order->number,
            //     'recipient_address' => $order->address,
            //     'cod_amount' => $order->total,
            //     'note' => 'Delivery instructions or other notes.',
            //     // Add other courier-related data
            // ];
            // $headers = [
            //     'Api-Key' => '9w8uwnfx7sc9r2rupggjkg2iiqxbsjin',
            //     'Secret-Key' => 'xegqa89dwila6smbneu1vtu2',
            //     'Content-Type' => 'application/json',
            // ];
            // $response = Http::withHeaders($headers)->post($courierApiUrl, $courierData);
            // if ($response->successful()) {
            //     /*  Handle the courier service response*/
            //     $courierApiResponse = $response->json();

            //     /* Clear the user's cart after successful checkout */
            //     Cart::where('user_id', Auth::id())->delete();

            //     return redirect()->route('frontend.thank_you')->with('data',['success'=> 'Order placed successfully','order'=>$order]);
            // } else {
            //     /* Handle the error response from the courier service*/
            //     return redirect()->back()->with('error', 'Failed to create shipment with the courier service');
            // }
        }
    }
    public function storeOrder($user,$request,$cart){

            // return $cart;
            $order = new Product_Order();
            $order->user_id =  $user->id;
            $order->sub_total = $request->sub_total;
            $order->discount = 0;
            $order->delivery_charge = $request->delivery_charge;
            $order->tax_amount = $request->tax_amount;
            $order->grand_total = $request->total;
            $order->payment_status = 1;
            $order->note = 'note';
            $order->order_status = 0;
            $order->shipping_id = 1;
            $order->coupon_code = 'H#43Sd';
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email_address = $user->email;
            $order->phone_number = preg_replace('/[^0-9]/', '', $request->number);
            $order->country = $request->country;
            $order->address = $request->address;
            $order->appartment = $request->area;
            $order->city = $request->city;
            $order->state = $request->area;
            $order->zip_code = $request->zip_code;
            $order->save();

            /* Create a new Invoice_Note instance*/
            $invoice_note = new Invoice_Note();
            $invoice_note->invoice_id = $order->id;
            $invoice_note->note = 'Order Created';
            $invoice_note->save();

            foreach ($cart as $item) {
                /* Now  insert the data order details table*/
                $order_details = new Product_Order_Details();
                $order_details->invoice_id = $order->id;
                $order_details->product_id = $item->product_id;
                $order_details->qty = $item->qty;
                $order_details->save();

                /* Now  calculation Product QTY From Product table*/
                $productData = Product::find($item->product_id);
                $currentQty = $productData->qty;
                $updatedQty = $currentQty - $item->qty;
                $productData->qty = $updatedQty;
                $productData->update();
            }
            return  $order;


    }
    public function landingPageOrder($user,$request,$cart){

            // return $cart;
            if(str_word_count($user->name)>1){
                $name=explode(' ', $user->name);
                $fname=$name[0];
                $lname=$name[1];
            }else{
                $fname=$user->name;
                $lname=$user->name;
            }

            $order = new Product_Order();
            $order->user_id =  $user->id;
            $order->sub_total = $request->sub_total;
            $order->discount = 0;
            $order->grand_total = $request->total;
            $order->payment_status = 1;
            $order->note = 'note';
            $order->order_status = 0;
            $order->shipping_id = 1;
            $order->coupon_code = 'H#43Sd';
            $order->first_name = $fname;
            $order->last_name = $lname;
            $order->email_address = $user->email;
            $order->phone_number = preg_replace('/[^0-9]/', '', $request->number);
            $order->country = 'country';
            $order->address = $request->address;
            $order->appartment = 'appartment';
            $order->city = 'city';
            $order->state = 'state';
            $order->zip_code = '1234';
            $order->save();

            /* Create a new Invoice_Note instance*/
            $note = new Invoice_Note();
            $note->invoice_id = $order->id;
            $note->note ='Order Created';
            $note->save();

            foreach ($cart as $item) {
                /* Now  insert the data order details table*/
                $order_details = new Product_Order_Details();
                $order_details->invoice_id = $order->id;
                $order_details->product_id = $item->product_id;
                $order_details->qty = $item->qty;
                $order_details->save();

                /* Now  calculation Product QTY From Product table*/
                $productData = Product::find($item->product_id);
                $currentQty = $productData->qty;
                $updatedQty = $currentQty - $item->qty;
                $productData->qty = $updatedQty;
                $productData->update();
            }
            return  $order;


    }
}
