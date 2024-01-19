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
                                <li><a href="mainDashboard.html">Order</a></li>
                                <li><a href="myaccount.html">Account</a></li>
                                <li><a href="customerAddress.html">Address</a></li>
                                 <li><a href="vouchers.html">Vouchers</a></li>
                                <li><a href="userpayement.html">Payment Methods</a></li>
                                <li><a href="returnproduct.html">Returns</a></li>
                                <li><a href="cancellations.html">Cancellations</a></li>
                                <li><a href="{{route('frontend.wish_list')}}">WishList</a></li>
                                <li><a href="subscription.html">Subscriptions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="user_main_content">
                        <h2 class="user_top_heading">My WishList</h2>
                        

                        
                        <!--product wish list table-->
                        <div class="product_wishlist">
                           
                        <table class="table table-striped">
                            <tbody>
                            @forelse($data as $wishlistItem)
                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/product/' . $wishlistItem->product->product_image->first()->image) }}" class="float-left" width="150" height="150"/>
                                        <p class="ml-3">{{ $wishlistItem->product->title }}</p>
                                        <p class="ml-3">Size:{{ $wishlistItem->product->size }}, Color: {{ $wishlistItem->product->color }}</p>
                                        <a href="{{ route('frontend.delete_wishlist', ['deleteId' => $wishlistItem->id]) }}">
                                            <i class="fa fa-trash ml-1 fa-1x text-danger"></i>
                                        </a>
                                    </td>
                                    <td>${{ $wishlistItem->product->price }}</td>
                                    <td>
                                        <a href="{{ route('frontend.wish_list_to_cart', ['id' => $wishlistItem->product->id, 'qty' => $wishlistItem->qty]) }}">
                                            <i class="fa-solid fa-cart-arrow-down fa-1x text-dark"></i>
                                        </a> 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No items in the wishlist</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        </div>

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