@extends('Frontend.Layout.App')
@section('title','Cart Page With Checkout')

@section('content')
<section class="checkout_area">
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-md-8">
                <h2 class="m-3">CheckOut and billing info</h2>
                <hr class="w-100"/>
                <div class="checkout_form">
                    <form method="POST" action="{{route('frontend.checkout')}}" class="m-5 checkout_form_design">
                        @csrf
                        <div class="row">
                            <div class="col">
                            <label>First Name<span style="color:red;font-weight: 800;">*</span></label>
                            <input type="text" class="form-control"  name="first_name" placeholder="Enter First Name" required>
                            </div>
                            <div class="col">
                            <label>Last Name<span style="color:red;font-weight: 800;">*</span></label>
                            <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Email<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder=" Enter Email" required >
                            </div>
                            <div class="col">
                                <label>Phone<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="number" class="form-control" name="number" placeholder=" Enter Number"  required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <label>Country<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="text" class="form-control" name="country" placeholder=" Enter Your Country"  required>
                            </div>
                            <div class="col">
                                <label>City<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="text" class="form-control" name="city" placeholder=" Enter Your City"  required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                                <label>Area<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="text" class="form-control" name="area" placeholder=" Enter Your Area"  required>
                            </div>
                            
                            <div class="col">
                                <label>Post Code<span style="color:red;font-weight: 800;">*</span></label>
                                <input type="text" class="form-control" placeholder=" Enter Your Post Code"  name="zip_code" required>
                            </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Address <span style="color:red;font-weight: 800;">*</span></label>
                                    <input type="text" class="form-control" placeholder=" Enter Your Address" name="address" required>
                                </div>
                            </div>
                            <div class="row d-none">
                                <div class="col">
                                    <input type="text" class="form-control"  name="sub_total" value="{{round($subtotal) }}">
                                    <input type="text" class="form-control"  name="delivery_charge" value="{{round($deliveryCharge)}}">
                                    <input type="text" class="form-control" name="tax_amount" value="{{ round($vatTax) }}">


                                    <input type="text" class="form-control" name="total" value="{{round($total)}}">

                                </div>
                            </div>
                            <div class="row float-right mb-5">
                            <div class="col">
                                <button type="submit" class="btn btn-dark">Place Order</button>
                            </div>
                            
                            </div>
                        </form>

                </div>
            </div>
            <div class="col-md-4 checkout_right">
            @auth
                <h2>Your Cart {{ auth()->user()->cartItems->count() }} item{{ auth()->user()->cartItems->count() !== 1 ? 's' : '' }}</h2>
            @endauth



                    <hr/>
                <div class="checkout_item_area">
                               
                @foreach($cart as $cartItem)
                    @php 
                        $productImage = $cartItem->product->product_image->first();
                    @endphp
                    <div class="row">
                        <div class="col-md-4">
                            <div class="cart_product_image">
                            <img src="{{ $productImage ? $productImage->image : '' }}" class="w-100"/>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="cart_product_text">
                            <p>{{ $cartItem->product->title }}</p>
                            <p>${{ $cartItem->product->price }}</p>
                                <p>Size:L</p>
                                <p>Color:Black</p>
                                <input type="number" name="qty" value="{{$cartItem->qty}}"  min="1" max="{{$cartItem->qty}}" class="w-25"/>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <hr/>
                    @if(!$cart->isEmpty())
                    <div class="payment_cost_area">
                        <h3>Sub Total<span class="checkout_amount">$ {{round($subtotal)}}</span></h3>
                        <hr/>
                        <h3>Vat/Tax<span class="checkout_amount">$ {{round($vatTax)}}</span></h3>
                        <hr/>
                        <h3>Delivery Charge<span class="checkout_amount">$ {{round($deliveryCharge)}}</span></h3>
                        <hr/>
                        <h3 class="mb-5">Total<span class="checkout_amount">$ {{ round($total) }}</span></h3>
                    </div>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
@if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
    @elseif(session('error'))
    <script>
        toastr.error('{{ session('error') }}');
    </script>
    @endif
    

@endsection