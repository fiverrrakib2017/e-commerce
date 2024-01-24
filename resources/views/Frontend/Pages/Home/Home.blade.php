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
            <div class="row" id="items_container">
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
            <div class="load_more text-center">
            <button type="button" class="btn btn-warning mt-3" id="load_more_button" data-page="{{ $product->currentPage() + 1 }}">Load More</button>
            </div>
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
                    <a href="{{route('frontend.product.brand',$item->id)}}" class="text-decoration-none text-dark">
                        <div class="card h-100" >
                            <img src="{{asset('Backend/images/brands/'.$item->brand_image)}}" class="card-img-top brand_image" alt="...">
                            <div class="card-body text-center">
                              <a href="{{route('frontend.product.brand',$item->id)}}" class="btn btn-dark ">{{$item->brand_name}}</a>
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
                            <a href="{{ route('frontend.product.category',$item->id)}}" class="text-decoration-none text-dark">
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

@section('script')
<script>
  $(document).ready(function() {
    var start = 8;

    $('#load_more_button').click(function() {
        $.ajax({
            url: "{{ route('frontend.load-more') }}",
            method: "GET",
            data: {
                start: start
            },
            dataType: "json",
            beforeSend: function() {
                $('#load_more_button').html(`<div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden"></span>
                    </div>
                </div>`);
                $('#load_more_button').attr('disabled', true);
            },
            success: function(data) {
                if (data.data.length > 0) {
                    var html = '';
                    for (var i = 0; i < data.data.length; i++) {
                        var item = data.data[i];
                        var productImage = item.product_image; 
                        var productDetailsUrl = "{{ route('frontend.product.details', ':id') }}".replace(':id', item.id);

                        html += `
                        <div class="col-md-3 col-sm-6 mb-3">
                            <div class="features_product">
                                <a href="${productDetailsUrl}" class="text-decoration-none text-dark">
                                    <div class="card h-100">
                                    @if ($productImage && !empty($productImage->image))
                                        <img src="{{ asset('uploads/product/'.$productImage->image.'') }}" alt="" class="card-img-top product_image">
                                    @else
                                        <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="card-img-top product_image">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="product_tittle">${item.title}</h5>
                                        <p><span class="product-tittle-color">${item.price}</span></p>
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
                        `;
                    }

                    // Append data with fade-in effect
                    $('#items_container').append($(html).hide().fadeIn(1000));
                    $('#load_more_button').html('Load More');
                    $('#load_more_button').attr('disabled', false);
                    start = data.next;
                } else {
                    $('#load_more_button').html('No More Data Available');
                    $('#load_more_button').attr('disabled', true);
                }
            }
        });
    });
});

</script>

@endsection