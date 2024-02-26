<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Invoice_Note;
use App\Models\Product;
use App\Models\Product_Order;
use App\Models\Product_Order_Details;

class CheckoutController extends Controller
{
    private function extractTaxRate($tax)
        {
            /* Default to 5% if 'tax' is not numeric */
            return is_numeric($tax) ? $tax / 100 : 0.00;
        }
    public function index(){
        
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
        return view('Frontend.Pages.Checkout.Checkout',compact('cart', 'subtotal', 'vatTax', 'deliveryCharge', 'total'));
    }
    public function checkout(Request $request){
       /* Now  check if the cart items  empty*/
       $cart = Cart::where('user_id', Auth::id())->with('product')->get();
        if ($cart->isEmpty()) {
            return redirect()->back()->with('error', 'Your Cart is Empty');
        }
        /* Now  check if the cart items are not empty*/
        if ($cart->isNotEmpty()) {
            $order = new Product_Order();
            $order->user_id = Auth::id();
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
            $order->email_address = $request->email;
            $order->phone_number = preg_replace('/[^0-9]/', '', $request->phone);
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
            /* Clear the user's cart after successful checkout */
            Cart::where('user_id', Auth::id())->delete();
            return redirect()->route('frontend.thank_you')->with('order',$order);
        }
    }
}
