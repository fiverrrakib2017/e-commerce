@extends('Frontend.Layout.App')
@section('title','Checkout Page')
@section('content')
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Checkout</h4>
           
         </div>
      </div>
   </div>
   <!-- end page title -->
   <div class="row">
      <div class="col-xl-8">
         <div class="card">
            <div class="card-body checkout-tab">
               <form method="POST" action="{{route('frontend.cart.checkout')}}">@csrf
                  <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                    
                  </div>
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                        <div>
                           <h5 class="mb-1">Billing Information</h5>
                           <p class="text-muted mb-4">Please fill all information below</p>
                        </div>
                        <div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="mb-3">
                                    <label for="" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter first name" value="" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Enter last name" value="" required>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-6">
                                 <div class="mb-3">
                                    <label for="billinginfo-email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="mb-3">
                                    <label for="billinginfo-phone" class="form-label">Phone</label>
                                    <input type="number" class="form-control" name="phone" placeholder="Enter phone no." required>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <label for="" class="form-label">Address</label>
                              <textarea class="form-control" name="address" placeholder="Enter address" rows="3" required></textarea>
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-control" name="country" required>
                                       <option value="">Select Country...</option>
                                       <option value="Bangladesh">Bangladesh</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="" class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter City" required>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="" class="form-label">Area</label>
                                    <input type="text" class="form-control" name="area" placeholder="Enter Area" required>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label for="zip" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" name="zip_code" placeholder="Enter zip code" required>
                                 </div>
                              </div>
                              <div class="col-md-4 d-none">
                                    <input type="text" class="form-control"  name="sub_total" value="{{round($subtotal) }}">
                                    <input type="text" class="form-control"  name="delivery_charge" value="{{round($deliveryCharge)}}">
                                    <input type="text" class="form-control" name="tax_amount" value="{{ round($vatTax) }}">
                                    <input type="text" class="form-control" name="total" value="{{round($total)}}">
                              </div>
                           </div>
                           <div class="d-flex align-items-start gap-3 mt-3">
                              <button type="submit" class="btn btn-primary btn-label right ms-auto " > Proceed to Shipping
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- end tab content -->
               </form>
            </div>
            <!-- end card body -->
         </div>
         <!-- end card -->
      </div>
      <!-- end col -->
      <div class="col-xl-4">
         <div class="card">
            <div class="card-header">
               <div class="d-flex">
                  <div class="flex-grow-1">
                     <h5 class="card-title mb-0">Order Summary</h5>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="table-responsive table-card">
                  <table class="table table-borderless align-middle mb-0">
                     <thead class="table-light text-muted">
                        <tr>
                           <th style="width: 70px;" scope="col">Product</th>
                           <th scope="col">Product Info</th>
                           <th scope="col" class="text-end">Price</th>
                        </tr>
                     </thead>
                     <tbody>
                     @foreach($cart as $cartItem)
                        @php 
                            $productImage = $cartItem->product->product_image->first();
                        @endphp
                        <tr>
                           <td>
                              <div class="avatar-md bg-light rounded p-1">
                                 <img src="{{ $productImage ? $productImage->image : '' }}" alt="" class="img-fluid d-block">
                              </div>
                           </td>
                           <td>
                              <h6 class="fs-14"><a href="{{route('frontend.product.details',$cartItem->product->id)}}" class="text-body">{{ $cartItem->product->title }}</a></h6>
                              <p class="text-muted mb-0">৳{{ $cartItem->product->price }} x {{ $cartItem->qty }}</p>
                           </td>
                           <td class="text-end">৳ {{ $cartItem->product->price * $cartItem->qty }} </td>
                        </tr>
                        @endforeach

                        @if(!$cart->isEmpty())
                        <tr>
                           <td class="fw-semibold" colspan="2">Sub Total :</td>
                           <td class="fw-semibold text-end">৳ {{round($subtotal)}}</td>
                        </tr>
                        <tr>
                           <td colspan="2">Discount <span class="text-muted">(VELZON15)</span> : </td>
                           <td class="text-end">- ৳ 00</td>
                        </tr>
                        <tr>
                           <td colspan="2">Shipping Charge :</td>
                           <td class="text-end">৳ {{ round($deliveryCharge) }}</td>
                        </tr>
                        <tr>
                           <td colspan="2">Estimated Tax (12%): </td>
                           <td class="text-end">৳ {{round($vatTax)}}</td>
                        </tr>
                        <tr class="table-active">
                           <th colspan="2">Total (BDT) :</th>
                           <td class="text-end">
                              <span class="fw-semibold">
                              ৳ {{ round($total) }}
                              </span>
                           </td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- end card body -->
         </div>
         <!-- end card -->
      </div>
      <!-- end col -->
   </div>
   <!-- end row -->
</div>
<!-- container-fluid -->
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