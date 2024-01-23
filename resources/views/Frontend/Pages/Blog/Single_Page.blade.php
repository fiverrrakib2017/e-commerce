@extends('Frontend.Layout.App')
@section('title','Welcome To Our Shop | Admin Panel')

@section('content')
  <!---Single Blog main area-->
  <section class="single_blog_area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 pt-5 pb-5">
                <div class="card custom_card">
                    <img src="{{asset('Backend/images/blog/'.$blog->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{$blog->title}}</h5>
                      <p class="card-text">{{ $blog->short_description }}

                        <br/>
                        {{ $blog->description }}
                        </p>
                    <div class="social_share">
                        <p>Please share this post</p>
                        <a href=""><i class="fa-brands fa-facebook fa-2x fb_icon"></i></a>
                        <a href=""><i class="fa-brands fa-linkedin fa-2x ld_icon"></i></a>
                        <a href=""><i class="fa-brands fa-twitter fa-2x twi_icon"></i></a>
                        <a href=""><i class="fa-brands fa-pinterest fa-2x pin_icon"></i></a>
                        <a href=""><i class="fa-brands fa-quora fa-2x quo_icon"></i></a>
                        
                    </div>
                      
                    </div>
                  </div>
            </div>
            <div class="col-md-2"></div>
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