@extends('Frontend.Layout.App')
@section('title','About Page||Welcome To Our Shop | Admin Panel')

@section('content')
<section class="about_us_area">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 text-center">
                    <div class="about_us">
                        <h2>About us</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
                    </div>
                   
                </div>
            </div>
        </div>
</section>
 <!---our position-->
    @if ($data->isEmpty())
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 m-auto">
                 <div class="alert alert-warning text-danger text-center">Data Not Found</div>
            </div>
        </div>
    </div>
   
    @else
        @foreach ( $data as $index=>$item)
            @if($index % 2 == 0)
            <section class="position_area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="our_position">
                                <h2>{{ $item->title }}</h2>
                                <p>{{ $item->description }}</p>
                            </div>

                        </div>
                        <div class="col-md-6">
                        <div class="our_position_image">
                            <img src="{{$item->photo}}" class="img-fluid w-100"/>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            @else
            <section class="our_story_area">
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="our_position_image">
                            <img src="{{$item->photo}}" class="img-fluid w-100"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="our_position">
                                <h2>{{ $item->title }}</h2>
                                <p>{{ $item->description }}</p>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </section>

        @endif
        @endforeach
    @endif
    
    
    
@endsection