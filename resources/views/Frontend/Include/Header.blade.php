<section class="top_header">
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-sm-3">
                    <div class="header_logo">
                        <img src="{{asset('Frontend/images/header_logo.png')}}" width="150px" href="{{url('/')}}"/>
                    </div>

                </div>
                <div class="col-md-6">
                   <div class="product_search">
                       <input type="text" placeholder="search Product" class="product_search"/><i class="fa fa-search search_icon "></i>
                   </div>
                </div>
                <div class="col-md-2">
                    <div class="header_right_area">
                        <div class="single_icon_area">
                            <a href="{{route('frontend.wish_list')}}" class="single-icon"><i class="fa fa-heart"></i></a>
                        </div>
                        <div class="single_icon_area">
                            <a href="{{route('frontend.user_account')}}" class="single-icon"><i class="fa fa-user"></i></a>
                        </div>

                        @if(auth()->check())
                          <div class="single_icon_area">
                            <a href="{{ route('frontend.cart.index') }}" class="single-icon"><i class="fa-solid fa-cart-arrow-down"></i> <span class="total-count">{{ auth()->user()->cartItems->count() }}</span></a>
                          </div>
                        @else
                        <div class="single_icon_area">
                            <a href="#" class="single-icon"><i class="fa-solid fa-cart-arrow-down"></i> <span class="total-count">0</span></a>
                          </div>
                        @endif
                       
                        

                        
                    </div>
                    
                    

                </div>
                <div class="col-md-2">
                    <div class="btn-group" role="group" aria-label="Basic example">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{route('login')}}" class="btn btn-warning header_login_button">Login</a>
                        @endif
                        @if (Route::has('register'))
                            <a href="{{route('register')}}" class="btn btn-success">Register</a>
                        @endif
                        @else
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">@csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                    @endguest


                      </div>
                </div>
            </div>
        </div>
    </section>
    <!---main header-->
    <section class="main_header">
        <div class="container">
            <div class="cat-menu">
                <div class="row">
                    <div class="col-md-3">
                      
                    </div>
                    <div class="col-md-9">
                        <div class="menu_area">
                            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                               
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                  <span class="navbar-toggler-icon custom_toggle"></span>
                                  
                                </button>
                              
                                <div class="collapse navbar-collapse main_navbar" id="navbarSupportedContent">
                                  <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                      <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('frontend.product.all')}}">Shop</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="{{route('frontend.product.all')}}">Product</a>
                                      </li>
                                    <li class="nav-item">
                                      <a class="nav-link" href="{{route('frontend.show_about')}}">About</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                      <a class="nav-link" href="#">Service</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('frontend.blog')}}">Blog</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" href="{{route('frontend.show_contact')}}">Contact</a>
                                      </li>
                                  </ul>
                                  
                                </div>
                              </nav>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>