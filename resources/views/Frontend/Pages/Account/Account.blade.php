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
   <!---min dashboard area-->
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
            <div class="col-md-8">
               <div class="dashboard_right">
                <form class="user_account_form">
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4"><strong>Name</strong></label>
                          <input type="text" class="form-control" id="inputEmail4" class="user_account_edit" value="{{$data->name}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputPassword4"><strong>Email Address</strong></label>
                          <input type="email" class="form-control" id="inputAddress2" value="{{$data->email}}">
                        </div>
                      </div>
                      <h4> Password Change</h4>
                      <hr/>
                      <div class="form-group">
                        <label for="inputAddress2"><strong>Current Password</strong></label>
                        <input type="password" class="form-control" id="inputAddress2" >
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2"><strong>Password</strong> </label>
                        <input type="password" class="form-control" id="inputAddress2">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2"><strong>Confirm Password</strong></label>
                        <input type="password" class="form-control" id="inputAddress2">
                      </div>
                    
                    <button type="submit" class="btn btn-primary ">Update</button>
                  </form>
               </div>
            </div>
        </div>
    </div>
   </section>
   
    <!-----Newsletter-->
    <section class="shop_newsletter">
        <div class="container">
            <div class="innter_top">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="newsLetter_text">
                            <h4>NEWSLETTER</h4>
                            <p>Subscribe to our newsletter and get 10% off your first purchase</p>
                            <form action="" method="post" class="news_letter_form">
                                <input type="email" name="email" placeholder="Enter Your Email" />
                                <button class="subscribe_btn">Subscribe</button>

                            </form>
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