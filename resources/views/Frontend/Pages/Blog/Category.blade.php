@extends('Frontend.Layout.App')
@section('title','Welcome To Our Shop | Admin Panel')

@section('content')
  <!---blog tittle_area-->
  <section class="blog_tittle_area">
       <div class="container">
           <div class="blog_inner text-center">
               <div class="row">
                   <div class="col-md-12">
                     <div class="blog_tittle_text">
                         <h2>Lead Your Business To success</h2>
                         <p>Pointsoft.com Blog</p>
                     </div>
                   </div>
               </div>
           </div>
       </div>

   </section>
   <!---Blog main area-->
   <section class="main_blog_area">
       <div class="container">
           <div class="row">
               <div class="col-md-2">
                   <div class="blog_left_category">
                       <h2>All Category</h2>
                       <ul>
                        @foreach ($blog_category as $item)
                        <li><a href="{{route('frontend.category_blog',$item->id)}}">{{  $item->name  }}</a></li>
                        @endforeach
                          
                       </ul>
                   </div>
                   <!-- <div class="blog_left_tags">
                    <h2>Popular Tags</h2>
                    <ul>
                        <li><a href="">Men Cloths</a></li>
                        <li><a href="">Women Cloths</a></li>
                        <li><a href="">Electronic</a></li>
                        <li><a href="">Baby Cloths</a></li>
                        <li><a href="">Lifestyle</a></li>
                        <li><a href="">Men Cloths</a></li>
                        <li><a href="">Women Cloths</a></li>
                        <li><a href="">Electronic</a></li>
                        <li><a href="">Baby Cloths</a></li>
                        <li><a href="">Lifestyle</a></li>
                    </ul>
                </div> -->

               </div>
               <div class="col-md-10">
                   <div class="row ">
                    @foreach ($data as $item)
                       <div class="col-md-4  mb-3 col-sm-6">
                            <a href="singleBlog.html" class="text-decoration-none text-dark">
                                <div class="card h-100">
                                    <img src="{{asset('Backend/images/blog/'.$item->image)}}" class="blog_post_image" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $item->title }}</h5>
                                      <p class="card-text">{{ substr($item->description, 0, 100) }} </p>
                                      <a href="{{route('frontend.single_blog_page',$item->id)}}" class="btn btn-primary mt-3">Read More</a>
                                    </div>
                                </div>
                            </a>
                       </div>
                    @endforeach
                   </div>
                   <div class="row">
                    <!---bootstrap pagination-->
                       <div class="blog_pagination">
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
               </div><!---main col-->
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