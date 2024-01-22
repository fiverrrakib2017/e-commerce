@extends('Frontend.Layout.App')
@section('title','Welcome To Our Shop | Admin Panel')

@section('content')
<section class="hero_area">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('Frontend/images/hero-image1.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('Frontend/images/heroimage2.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('Frontend/images/hero-image3.jpg')}}" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </button>
          </div>
    </section>
<!---Features products-->
    <section class="features_area section_padding">
        <div class="container">
            <h2>Features products</h2>
            <hr/>
            <div class="row">
               @foreach ($product as $item)
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="features_product">
                        <a href="{{route('frontend.product.details',$item->id)}}" class="text-decoration-none text-dark">
                            <div class="card h-100">
                            @php 
                                $productImage = $item->product_image->first();
                            @endphp
                            @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" class=" card-img-top product_image">
                                
                            @else
                                <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="card-img-top product_image">
                                
                            @endif


                            <div class="card-body">
                              <h5 class="product_tittle">{{$item->title}}</h5>
                              
                              <p><span class="product-tittle-color">{{ $item->price }}</span></p>
                              <p><del>$25</del>-40%</p>
                              <div class="product_rating">
                                <ul>
                                    <span><i class="fa fa-star checked star"></i></span>
                                    <span><i class="fa fa-star checked star"></i></span>
                                    <span><i class="fa fa-star checked star"></i></span>
                                    <span><i class="fa fa-star checked star"></i></span>
                                    <span><i class="fa fa-star checked star"></i></span>
                                    
                                    
                                </ul>
                            </div>
                            </div>
                          </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row mt-3">
               
                <div class="col-md-3 col-sm-6  mb-3">
                    <div class="popular_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/popular-products1.jpg')}}" class="card-img-top product_image" alt="...">
                                <div class="card-body">
                                  <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                  <p><span class="product-tittle-color">$55</span></p>
                                  <p><del>$25</del>-40%</p>
                                  <div class="product_rating">
                                    <ul>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                      
                                        
                                        
                                    </ul>
                                </div>
                                </div>
                              </div>
                            </a>
                       
                    </div>
                </div>
                <div class="col-md-3 col-sm-6  mb-3">
                    <div class="popular_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/popular-products2.png')}}" class="card-img-top product_image" alt="...">
                                <div class="card-body">
                                  <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                  <p><span class="product-tittle-color">$55</span></p>
                                  <p><del>$25</del>-40%</p>
                                  <div class="product_rating">
                                    <ul>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                       
                                        
                                        
                                    </ul>
                                </div>
                                </div>
                              </div>
                        </a>
                        
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="popular_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/popular-products3.jpg')}}" class="card-img-top product_image" alt="...">
                                <div class="card-body">
                                  <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                  <p><span class="product-tittle-color">$55</span></p>
                                  <p><del>$25</del>-40%</p>
                                  <div class="product_rating">
                                    <ul>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                       
                                        
                                        
                                    </ul>
                                </div>
                                </div>
                              </div>
                        </a>
                        
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="popular_product">
                        <a href="singleProduct.html" class="text-decoration-none text-dark">
                            <div class="card">
                                <img src="{{asset('Frontend/images/popular-products4.jpg')}}" class="card-img-top product_image" alt="...">
                                <div class="card-body">
                                  <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  <p><span class="product-tittle-color">$55</span></p>
                                  <p><del>$25</del>-40%</p>
                                  <div class="product_rating">
                                    <ul>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                        <span><i class="fa fa-star checked star"></i></span>
                                       
                                        
                                        
                                    </ul>
                                </div>
                                </div>
                              </div>
                            </a>
                       
                    </div>
                </div>
            </div>
            <div class="load_more text-center">
                <button type="button" class="btn btn-warning mt-3 ">Load More</button>
            </div>
        </div>

    </section>
    <!---popular products-->
    <section class="popular_area">
        <div class="container">
            <h2>Popular products</h2>
            <hr/>
            <div class="row">
               
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/26.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                   
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/ladygown3.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                   
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/lady4.jpg')}}" class="card-img-top product_image " alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                        </a>
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/25.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
            </div>
            <div class="row mt-3">
               
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/24.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                   
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/popular-products5.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                   
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/popular-products2.png')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                   
                   
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/popular-products1.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                    
                </div>
            </div>
            <div class="load_more text-center">
                <button type="button" class="btn btn-warning mt-3">Load More</button>
            </div>
        </div>

    </section>
    <!---new products-->
    <section class="newProducts_area section_padding">
        <div class="container">
            <h2>New products</h2>
            <hr/>
            <div class="row">
               
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/kidscat.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/shirt3.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/newproducts5.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/newproduct4.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
            </div>
            <div class="row mt-3">
               
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/newproducts3.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6 mb-3">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/1.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/newproducts2.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="singleProduct.html" class="text-decoration-none text-dark">
                        <div class="card h-100">
                            <img src="{{asset('Frontend/images/newproducts1.jpg')}}" class="card-img-top product_image" alt="...">
                            <div class="card-body">
                                <h5 class="product_tittle">Video lamp with Tripod for Smartphone</h5>
                                  
                                <p><span class="product-tittle-color">$55</span></p>
                                <p><del>$25</del>-40%</p>
                                <div class="product_rating">
                                  <ul>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      <span><i class="fa fa-star checked star"></i></span>
                                      
                                      
                                  </ul>
                              </div>
                            </div>
                          </div> 
                    </a>
                    
                </div>
            </div>
            <div class="load_more text-center">
                <button type="button" class="btn btn-warning mt-3">Load More</button>
            </div>
        </hr>
        </div>

    </section>
    
    <!---shop by brands-->
    <section class="shopBy_brand mb-5">
        <div class="container">
            <h2 class="text-center text-white brand_tittle">Shop By Popular Brand</h2>
            <hr class="brand_hr_design"/>
            
            <div class="row">
                @foreach ($brand as $item)               
                <div class="col-md-2 col-sm-6 mb-3">
                    <a href="productCategory.html" class="text-decoration-none text-dark">
                        <div class="card h-100" >
                            <img src="{{asset('Backend/images/brands/'.$item->brand_image)}}" class="card-img-top brand_image" alt="...">
                            <div class="card-body text-center">
                              <a href="productCategory.html" class="btn btn-dark ">{{$item->brand_name}}</a>
                            </div>
                        </div> 
                    </a>
                </div>
                @endforeach
             </div>
             <!---SECOND ROW-->
            
        </div>

    </section>
    <!---shop by category-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="category_top_heading">Shop By Popular  Category</h2>
                    <hr class="hr_design"/>
                    <div class="owl-carousel owl-theme">
                        @foreach ($category as $item)
                        <div class="item">
                            <a href="#" class="text-decoration-none text-dark">
                                <div class="card h-100" >
                                    <img src="{{asset('Backend/images/category/'.$item->category_image)}}" class="card-img-top category_slider_image" alt="...">
                                    <div class="card-body text-center">
                                      <a href="{{ route('frontend.product.category',$item->id)}}" class="btn btn-dark category_slider_tittle">{{ $item->category_name  }}</a>
                                    </div>
                                  </div> 
                            </a>
                        </div>
                        @endforeach
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
                               <input type="email" name="email" placeholder="Enter Your Email"/>
                               <button class="subscribe_btn">Subscribe</button>

                           </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>

   </section>
@endsection