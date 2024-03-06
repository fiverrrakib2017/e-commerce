@extends('Frontend.Layout.App')
@section('title','Order Completed Page')

@section('content')
<section class="thakyou_area">
       <div class="container">
           <div class="row">
            <script>
                fbq('track', 'Purchase');
              </script>
               <div class="col-md-12 text-center">

                   <div class="thank_you">
                    <i class="fa-solid fa-check"></i>
                      <h2 class="text-uppercase">Thank you For Your Order!</h2>
                      @php
                          $order=session('order');
                      @endphp
                      <p>Order Number:{{$order->id}}-r8787</p>
                      <p>You Will Receive Confirmation call in your number Shortly</p>
                      <p>Have a Nice Day!</p>
                   </div>
               </div>
           </div>
       </div>
    </section>

@endsection
