@extends('Frontend.Layout.App')
@section('title','Welcome To Our Shop | Admin Panel')

@section('content')
<!--single_product_page_tittle-->
    <section class="products_breadcumbs_area">
        <div class="container custom_breadcumbs">
            <div class="row">
                <div class="col-md-12">
                    <div class="products_breadcumbs">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ $product->category->category_name }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $product->brand->brand_name }}</a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $product->title }}</a></li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>
     <!---Product Content Section-->
    <section class="single_product_area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="single_product_content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product_image mb-3">
                                @php 
                                    $productImage = $product->product_image->first();
                                @endphp
                                @if (!empty($productImage->image))
                                    <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" srcset="" class="image-fluid w-100">
                                @else
                                    <img src="" alt="No Image Found" class="image-fluid w-100">
                                @endif

                                </div>
                                <div class="product_image_group mb-5">
                                    <div class="small-img-col">
                                        <img src="{{asset('Frontend/images/1.jpg')}}" width="100%" class="small-img">
                                    </div>
                                    <div class="small-img-col ml-1">
                                        <img src="{{asset('Frontend/images/24.jpg')}}" width="100%" class="small-img">
                                    </div>
                                    <div class="small-img-col ml-1">
                                        <img src="{{asset('Frontend/images/25.jpg')}}" width="100%" class="small-img">
                                    </div>
                                    <div class="small-img-col ml-1">
                                        <img src="{{asset('Frontend/images/26.jpg')}}" width="100%" class="small-img">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product_content">
                                    <h2>{{ $product->title }}</h2>

                                </div>
                                <div class="product_rating">
                                    <ul>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star-half-o checked star"></i></span>
                                        <span><i class="fa fa-star  star"></i></span>
                                    </ul>
                                </div> 
                                <h2 class="product_price">৳{{ $product->price }}</h2>
                                <div class="product_size">
                                    <h6>Select Size</h6>
                                    <select class="form-control w-50">
                                        <option>Black</option>
                                        <option>White</option>
                                        <option>Green</option>
                                        <option>Blue</option>
                                        <option>Red</option>
                                    </select>
                                </div>
                                <div class="product_quantity mt-3">
                                    <h6>Quantity</h6>
                                    <input type="number" value="1" class="quantity">
                                    <!-----modal start-->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-dark" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Add To Cart
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog custom_modal_design">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="cart_product_image">
                                                                <img src="images/1.jpg" class="w-100" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="cart_product_text">
                                                                <p>Men's T-shirt</p>
                                                                <p>$100.00</p>
                                                                <p>Size:L</p>
                                                                <p>Color:Black</p>
                                                                <input type="number" value="1" class="w-25" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr />
                                                <div class="cart_subtotal">
                                                    <h2 class="m-3">Sub Total<span class="checkout_amount">333</span>
                                                    </h2>
                                                </div>
                                                <div class="modal-footer">

                                                    <a href="checkout.html" class="btn btn-info w-100">Check Out</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!----modal end-->
                                </div>
                                <div class="product_share_button mt-1">
                                    <ul>
                                        <a href="" class="mr-3"><i class="fa fa-heart"></i> Add to Wish Lists</a>
                                        <a href=""><i class="fa fa-share"></i>Share</a>
                                    </ul>


                                </div>
                                <div class="single_product_category">
                                    <h6>Seller:<b></b></h6>
                                     <p>Shanti fashon LTD</p>
                                </div>
                                <div class="single_product_category">
                                    <h6>Fabric:<b></b></h6>
                                     <p>99% Cotton</p>
                                </div>
                                <div class="single_product_category">
                                    <h6>Category:<b></b></h6>
                                     <p>{{$product->category->category_name}}</p>
                                </div>
                                <div class="single_product_category">
                                    <h6><b>Brand:</b></h6>
                                    <p>{{$product->brand->brand_name}}</p>
                                </div>
                                <div class="product_share">
                                    <h6 class="d-inline-block">Share:</h6>
                                    <span><a href="" class="social_icon_fackbook"><i class="fa-brands fa-facebook fa-2x"></i></a></span>
                                    <span><a href="" class="social_icon_twitter"><i class="fa-brands fa-twitter fa-2x"></i></a></span>
                                    <span><a href="" class="social_icon_linkdin"><i class="fa-brands fa-linkedin fa-2x"></i></a></span>
                                    <span><a href="" class="social_icon_instgram"><i class="fa-brands fa-instagram fa-2x"></i></a></span>
                                    <span><a href="" class="social_icon_whatsup"> <i class="fa-brands fa-whatsapp fa-2x"></i></i></a></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="single_product_sidebar">
                        <ul class="">
                            <span class="d-block pt-3"><i
                                    class="fa-solid fa-location-dot mr-3"></i>Mymensingh,Phulpur,Amuankanda Road 12 -
                                19</span>
                            <span class="d-block pt-3"><i class="fa-solid fa-house mr-3"></i>Home Delivery</span>
                            <span class="d-block pt-3"><i class="fa-solid fa-money-bills mr-3"></i>Cash On Delivery
                                Available</span>
                            <span>Services</span>
                            <span class="d-block pt-3"><i class="fa-solid fa-arrow-rotate-left mr-3"></i>7 days
                                retrun</span>
                            <span class="d-block pt-3"><i class="fa-brands fa-servicestack mr-3"></i>Warntity
                                Available</span>
                        </ul>
                    </div>
                    <div class="single_product_sidebar mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product_sidebar_bottom">
                                    <div class="card mb-sm-3">
                                        <div class="card-body">
                                            <h5 class="sidebar_avarage_count">Positive rating</h5>
                                            <p class="card-text">97%</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product_sidebar_bottom">
                                    <div class="card mb-sm-3">
                                        <div class="card-body">
                                            <h5 class="sidebar_avarage_count">Ship on time</h5>
                                            <p class="card-text">99%</p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
     <!----single product tab-->
     <section class="product_tab_area mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product_tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                    role="tab" aria-controls="nav-home" aria-selected="true">Product Short Description</a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">Additional Info</a>
                                <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                    role="tab" aria-controls="nav-contact" aria-selected="false">Customer Review</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <p>{{$product->short_description}}</p>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                    unknown printer took a galley of type and scrambled it to make a type specimen book.
                                </p>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <p>Very Good Product</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!---product_long_description-->
        <section class="product_long_description">
      <div class="container">
          <div class="row ">
              <div class="col-md-10 long_description_area">
                  <div class="product_long_description">
                    <h3>Product Details here</h3>
                     <hr/>
                     <h3>{{$product->description}}</h3>
                  </div>

              </div>
              <div class="col-md-2 bg-white ">
                  <div class="long_description_sidebar">
                      <h6>Form the Same Store</h6>
                      <div class="card">
                        <img class="card-img-top" src="images/26.jpg" alt="Card image cap">
                        <div class="card-body">
                          <h5 class="card-title">Stylelish Coton T-shirt</h5>
                          <h5 class="card-title">$70.00</h5>
                          
                        </div>
                      </div>
                  </div>

              </div>
          </div>
      </div>
    </section>
     <!----related product area-->
     <section class="related_product_area mb-5">
        <div class="container">
            <h2>Related Products</h2>
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="related_product">
                        <a href="productCategory.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/t1.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
    
                                    <p><span class="product-tittle-color">$55</span></p>
                                    <p><del>$25</del>-40%</p>
                                </div>
                            </div>
                        </a>
                        
                    </div>

                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="related_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/t3.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
    
                                    <p><span class="product-tittle-color">$55</span></p>
                                    <p><del>$25</del>-40%</p>
                                </div>
                            </div>
                        </a>
                        
                    </div>

                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="related_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark"> 
                            <div class="card">
                                <img src="{{asset('Frontend/images/t2.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
    
                                    <p><span class="product-tittle-color">$55</span></p>
                                    <p><del>$25</del>-40%</p>
                                </div>
                            </div>
                        </a>
                        
                    </div>

                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="related_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark"> 
                            <div class="card">
                                <img src="{{asset('Frontend/images/t1.jpg')}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
    
                                    <p><span class="product-tittle-color">$55</span></p>
                                    <p><del>$25</del>-40%</p>
                                </div>
                            </div>
                        </a>
                       
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection