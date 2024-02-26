@extends('Frontend.Layout.App')
@section('title','Cart Page')
@section('content')
<div class="container-fluid mt-5">
   <div class="row mb-3">
      <div class="col-xl-8">
         <div class="row align-items-center gy-3 mb-3">
            <div class="col-sm">
               <div>
                @auth
                    <h5 class="fs-14 mb-0">Your Cart ({{ auth()->user()->cartItems->count() }} item{{ auth()->user()->cartItems->count() !== 1 ? 's' : '' }})</h5>
                @endauth
               </div>
            </div>
            <div class="col-sm-auto">
               <a href="{{route('frontend.home')}}" class="link-primary text-decoration-underline">Continue Shopping</a>
            </div>
         </div>
         @foreach($cart as $cartItem)
            @php 
                $productImage = $cartItem->product->product_image->first();
            @endphp
         <div class="card product mb-3">
            <div class="card-body">
               <div class="row gy-3">
                  <div class="col-sm-auto">
                     <div class="avatar-lg bg-light rounded p-1" style="width: 6rem; height: auto;">
                        <img src="{{ $productImage ? $productImage->image : '' }}"  alt="" class="img-fluid d-block">
                     </div>
                  </div>
                  <div class="col-sm">
                     <h5 class="fs-14 text-truncate"><a href="{{route('frontend.product.details',$cartItem->product->id)}}" class="text-body">{{ $cartItem->product->title }}</a></h5>
                     <ul class="list-inline text-muted">
                        <li class="list-inline-item">Color : <span class="fw-medium">{{ $cartItem->product->color }}</span></li>
                        <li class="list-inline-item">Size : <span class="fw-medium">{{ $cartItem->product->size }}</span></li>
                     </ul>
                     <div class="input-step">
                        <button type="button" class="btn-sm btn-primary">–</button>
                        <input type="number" class=" product-quantity" value="{{$cartItem->qty}}" min="1" max="100">
                        <button type="button" class="btn-sm btn-primary">+</button>
                     </div>
                  </div>
                  <div class="col-sm-auto">
                     <div class="text-lg-end"> 
                        <p class="text-muted mb-1">Item Price:</p>
                        <h5 class="fs-14">
                            <span style="font-size: 30px;">৳</span>
                            <span id="ticket_price" class="product-price">{{ $cartItem->product->price }}</span>
                        </h5>
                     </div>
                  </div>
               </div>
            </div>
            <!-- card body -->
            <div class="card-footer">
               <div class="row align-items-center gy-3">
                  <div class="col-sm">
                     <div class="d-flex flex-wrap my-n1">
                        <div>
                           <a href="#" class="d-block text-body p-1 px-2" data-bs-toggle="modal" data-bs-target="#removeItemModal"><i class="ri-delete-bin-fill text-muted align-bottom me-1"></i> Remove</a>
                        </div>
                        <div>
                           <a href="#" class="d-block text-body p-1 px-2"><i class="ri-star-fill text-muted align-bottom me-1"></i> Add Wishlist</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-auto">
                     <div class="d-flex align-items-center gap-2 text-muted">
                        <div>Total :&nbsp;</div>
                        <h5 class="fs-14 mb-0"> 
                            <span class="product-line-price">
                                {{ $cartItem->product->price * $cartItem->qty }} 
                            </span>
                        </h5>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end card footer -->
         </div>
        @endforeach
         <!-- end card -->
         <div class="text-end mb-4 mt-4">
            <form  method="GET" action="{{route('frontend.checkout.index')}}">
               @csrf
                 <button type="submit" class="btn btn-success btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Checkout</button>
            </form>
          
         </div>
      </div>
      <!-- end col -->
      <div class="col-xl-4">
         <div class="sticky-side-div">
            <div class="card">
               <div class="card-header border-bottom-dashed">
                  <h5 class="card-title mb-0">Order Summary</h5>
               </div>
               <div class="card-header bg-light-subtle border-bottom-dashed">
                  <div class="text-center">
                     <h6 class="mb-2">Have a <span class="fw-semibold">promo</span> code ?</h6>
                  </div>
                  <div class="hstack gap-3 px-3 mx-n3">
                     <input class="form-control me-auto" type="text" placeholder="Enter coupon code" aria-label="Add Promo Code here...">
                     <button type="button" class="btn btn-success w-xs mt-2">Apply</button>
                  </div>
               </div>
               <div class="card-body pt-2">
                  <div class="table-responsive">
                     <table class="table table-borderless mb-0">
                    @if(!$cart->isEmpty())
                        <tbody>
                           <tr>
                              <td>Sub Total :</td>
                              <td class="text-end" id="cart-subtotal">৳ {{round($subtotal)}}</td>
                           </tr>
                            <tr>
                              <td>Discount <span class="text-muted">(VELZON15)</span> : </td>
                              <td class="text-end" id="cart-discount">- ৳ 00.00</td>
                           </tr> 
                           <tr>
                              <td>Delivery Charge :</td>
                              <td class="text-end" id="cart-delivery">৳ {{round($deliveryCharge)}}</td>
                           </tr>
                           <tr>
                              <td>Estimated Tax (12.5%) : </td>
                              <td class="text-end" id="cart-tax">৳ {{round($vatTax)}}</td>
                           </tr>
                           <tr class="table-active">
                              <th>Total (BDT) :</th>
                              <td class="text-end">
                                 <span class="fw-semibold" id="cart-total">
                                 ৳ {{ round($total) }}
                                 </span>
                              </td>
                           </tr>
                        </tbody>
                    @endif
                     </table>
                  </div>
                  <!-- end table-responsive -->
               </div>
            </div>
          
         </div>
         <!-- end stickey -->
      </div>
   </div>
   <!-- end row -->
</div>
<!-- container-fluid -->
@endsection