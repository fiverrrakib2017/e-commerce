@extends('Frontend.Layout.App')
@section('title','Category Product')

@section('content')
   <!---Product Category Breadcumbs-->
   <section class="category_breadcumb_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="category_breadcumbs">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Fashon</li>
                              <li class="breadcrumb-item active" aria-current="page">Man</li>
                              <li class="breadcrumb-item active" aria-current="page">Clothing</li>
                            </ol>
                          </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <!---main category-->
     <section class="main_category_area">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                   <div class="left_sidebar_categry">
                       <h3>Categories</h3>
                       <hr/>
                       <ul>
                        @foreach ($category as $item)
                            <li><a href="{{route('frontend.product.category',$item->id)}}">{{ $item->category_name }}</a></li> 
                        @endforeach
                       </ul>
                   </div>
                   <!---category price range-->
                   <div class="category_price_rang mb-3">
                       <h3>Price</h3>
                       <input type="number" placeholder="Min"/> -
                       <input type="number"placeholder="Max"/><a href=""><i class="fa-solid fa-caret-right"></i></a>
                   </div>
                   <!---category sidebar brand---->
                   <div class="category_sidebar_brand">
                       <div class="single_sidebar">
                        <h3>Brand</h3>
                        <ul>
                            @foreach ($brand as $item)
                               <li> 
                                <label class="checkbox-inline" for="1"><input name="brand_name" type="checkbox"><a href="#">{{ $item->brand_name }}</a>
                                </label>
                         
                            </li> 
                            @endforeach
                            
                        </ul>
                       </div>
                       
                   </div>
                   <!---category sidebar color-->
                   <div class="category_sidebar_brand">
                       <div class="single_sidebar">
                        <h3>Color</h3>
                        <ul>
                            <li> 
                      
                                <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">Black</a>
                               </label>
                            
                            </li>
                            <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">white</a>
                            </label>
                         
                         </li>
                         <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">Green</a>
                            </label>
                         
                         </li>
                         <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">Gray</a>
                            </label>
                         
                         </li>
                         <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">Red</a>
                            </label>
                         
                         </li>
                        </ul>
                       </div>
                      
                   </div>
                   <!---category sidebar size-->
                   <div class="category_sidebar_sizes">
                       <div class="single_sidebar">
                        <h3>Size</h3>
                        <ul>
                            <li> 
                      
                                <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">M</a>
                               </label>
                            
                            </li>
                            <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">L</a>
                            </label>
                         
                         </li>
                         <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">XL</a>
                            </label>
                         
                         </li>
                         <li> 
                      
                             <label class="checkbox-inline" for="1"><input name="news" id="1" type="checkbox"><a href="">XXL</a>
                            </label>
                         
                         </li>
                         
                        </ul>
                       </div>
                       
                   </div>
                   
                </div>
                <div class="col-md-9">
                    <div class="category_single_product">
                        <div class="row">
                        @if ($data->isEmpty())
                            <div class="col-md-12 mt-5">
                                <div class="alert alert-warning" role="alert">
                                    Sorry! There are no products in this category.
                                </div>
                            </div>
                        @else
                        
                            @foreach ($data as $item)
                                <div class="col-md-4 mb-3 col-sm-6">
                                    @php 
                                        $productImage = $item->product_image->first();
                                    @endphp
                                    <a href="{{route('frontend.product.details',$item->id)}}"> 
                                    <div class="card h-100">
                                        @if (!empty($productImage->image))
                                        <img src="{{ $productImage->image }}" alt="" class="card-img-top product_image">
                                        
                                        @else
                                            <img src="https://dummyimage.com/250/ffffff/000000" alt="" srcset="" class="card-img-top product_image">
                                            
                                        @endif

                                        <div class="card-body">
                                        <h5 class="product_tittle">{{$item->title}}</h5>
                                        
                                        <p><span class="product-tittle-color">${{ $item->price }}</span></p>
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
                            @endforeach
                            @endif
                        </div>
                    </div>
                     <!---category product pagination-->
                    <nav aria-label="..." class="mt-5 float-right">
                        <ul class="pagination">
                            @if ($data->onFirstPage())
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                                </li>
                            @endif

                            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                                @if ($page == $data->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }} <span class="sr-only">(current)</span></span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            @if ($data->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $data->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                                    <span class="page-link" aria-hidden="true">&rsaquo;</span>
                                </li>
                            @endif
                        </ul>
                    </nav>


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
 
<script type="text/javascript">
    $(document).ready(function(){
       
    });
</script>

@endsection