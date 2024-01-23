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
 <section class="position_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="our_position">
                         <h2>our Position</h2>
                         <p>While our positions are carefully considered and deeply held, there is much room for healthy debate and differing opinions. We hope being clear about our positions is helpful.
                            While our positions are carefully considered and deeply held, there is much room for healthy debate and differing opinions. We hope being clear about our positions is helpful.
                         </p>
                    </div>

                </div>
                <div class="col-md-6">
                   <div class="our_position_image">
                     <img src="{{asset('Frontend/images/our_position.jpg')}}" class="img-fluid w-100"/>
                   </div>
                </div>
            </div>
        </div>
    </section>
    <!---our story-->
    <section class="our_story_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="our_position_image">
                      <img src="{{asset('Frontend/images/about_us2.png')}}" class="img-fluid w-100"/>
                    </div>
                 </div>
                <div class="col-md-6">
                    <div class="our_position">
                         <h2>our Story</h2>
                         <p>point soft is the first-ever cross border e-commerce marketplace from Bangladesh. Being the pioneer in cross border b2c ecommerce, aadi focuses on promoting Bangladesh and its strength in various industries at a global level. Beta launched in December 2018, aadi is currently focused on removing all the barriers of international selling for the local fashion retailers. Any retailer manufacturing in Bangladesh can reach and test the market with a few clicks now without any additional cost. 


                         </p>
                    </div>

                </div>
                
            </div>
        </div>
    </section>
@endsection