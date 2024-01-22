<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <link rel="stylesheet" href="{{asset('Frontend/css/responsive.css')}}"/>
    <link rel="stylesheet" href="{{asset('Frontend/css/style.css')}}"/>
    <link href="{{asset('Frontend/css/toastr.min.css')}}" rel="stylesheet">
</head>
<body>
   <!---Header Section-->
    @include('Frontend.include.Header')
    <!---Header Section-->


     <!---Hero section-->
     <!-- @include('Frontend.include.Hero_Section') -->
    <!---Hero section-->
   
    @yield('content');
    
    
    
    <!--footer-->
    @include('Frontend.include.Footer')
    

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" ></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" ></script>
<script type="text/javascript" src="{{asset('Frontend/js/toastr.min.js')}}"></script>
<script type="text/javascript">
   
var owl = $('.owl-carousel');
owl.owlCarousel({
    loop:false,
    nav:true,
    margin:10,
    
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },            
        960:{
            items:5
        },
        1300:{
            items:6
        }
    }
});
owl.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});

</script>
@yield('script');
</body>
</html>