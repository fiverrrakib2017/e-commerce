@extends('Frontend.Layout.App')
@section('title','Welcome To Our Shop | Admin Panel')

@section('content')
<section class="page_tittle_area">
        <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="page_tittle">
                       <h2 class="text-uppercase ">My Account</h2>
                   </div>
               </div>
           </div>
        </div>
      </section>
    <!---user info area-->
    <section class="user_dashboard_area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    
                    <div class="dashboard_left">
                        <div class="user_image_area">
                            @if(auth()->check())
                                <img src="{{ asset('Frontend/images/user-image.jpg') }}"/>
                                <p>{{ auth()->user()->name }}</p>
                            @endif
                            
                        </div>
                        <div class="user_sidebar_menu">
                            <ul>
                                <li><a href="{{route('frontend.order_list')}}">Order</a></li>
                                <li><a href="{{route('frontend.user_account')}}">Account</a></li>
                                <li><a href="customerAddress.html">Address</a></li>
                                 <li><a href="vouchers.html">Vouchers</a></li>
                                <li><a href="userpayement.html">Payment Methods</a></li>
                                <li><a href="{{route('frontend.return_order_list')}}">Returns</a></li>
                                <li><a href="{{route('frontend.order_cancle')}}">Cancellations</a></li>
                                <li><a href="{{route('frontend.wish_list')}}">WishList</a></li>
                                <li><a href="subscription.html">Subscriptions</a></li>
                            </ul>
                        </div>
                    </div>
                  
                </div>
                <div class="col-md-8 mb-5">
                    <div class="user_main_content">
                       <!--recent order table-->
                        <div class="recent_order mt-5">
                            <h2>Recent Order</h2>
                            <table class="table table-striped">
                                <thead>
                                    <th>#Order No</th>
                                    <th>Placed on</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                @foreach($data as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('m/d/Y') }}</td>
                                        <td>
                                            @if($order->orderDetails)
                                                @foreach($order->orderDetails as $orderDetail)
                                                    <img src="{{ asset('uploads/product/' . $orderDetail->product->product_image->first()->image) }}" width="100" height="100" />
                                                @endforeach
                                            @else
                                                No items
                                            @endif
                                        </td>
                                        <td>${{ $order->grand_total }}</td>
                                        <td>
                                           
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    @if(session('success'))
        <script>
            toastr.success('{{ session("success") }}');
        </script>
        @elseif(session('error'))
        <script>
            toastr.error('{{ session("error") }}');
        </script>
    @endif
 


@endsection