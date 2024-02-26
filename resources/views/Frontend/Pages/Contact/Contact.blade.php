@extends('Frontend.Layout.App')
@section('title','Contract Page | Welcome To Our Shop ')

@section('content')
<section class="contact_us_tittle">
       <div class="container">
           <div class="conatct_inner text-center">
               <div class="row">
                   <div class="col-md-12">
                     <div class="contact_tittle_text">
                         <h2>Hi,how i can help you</h2>
                         <p>Please fill out the form and discuss your problem. We will contact you very soon</p>
                     </div>
                   </div>
               </div>
           </div>
       </div>

   </section>
 <!---conatct us area-->
 <section class="contactUs_area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="contact_us">
                        <form class="conatct_form"  action="{{route('frontend.contract.send_data')}}" method="post">@csrf
                            <div class="row">
                              <div class="col">
                                <label for="exampleInputEmail1">Your Name<span class="conatct_required" style="color:red;font-weight:800">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                              </div>
                              <div class="col">
                                <label for="exampleInputEmail1">Your Tropics<span class="conatct_required" style="color:red;font-weight:800">*</span></label>
                                <input type="text" class="form-control" name="subject" placeholder="Enter Your Tropics">
                              </div>
                              </div>
                              <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">Your Email<span class="conatct_required" style="color:red;font-weight:800">*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email">
                                  </div>
                                  <div class="col">
                                    <label for="exampleInputEmail1">Your Phone<span class="conatct_required" style="color:red;font-weight:800">*</span></label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone">
                                  </div>
                              </div>
                               <div class="row">
                                <div class="col">
                                    <textarea id="form10" class="md-textarea form-control mt-3" rows="3" name="comment" placeholder="Enter Your Comment"></textarea>
                                  </div>
                              </div> 
                              <div class="contact_btn">
                                  <button type="submit" id="submitBtn" class="btn btn-dark mt-3 w-100">Send</button>
                              </div>
                            </div>
                          </form>
                     </div>
                
                <div class="col-md-4  text-center">
                    <div class="contact_address">
                        <i class="fa-solid fa-phone"></i>
                         <h2>Call Us Now</h2>
                         <p>+88019873118</p>
                         <p>+090001222</p>

                    </div>
                    <div class="contact_address">
                        <i class="fa-solid fa-home"></i>
                         <h2>Our Address</h2>
                         <p>Amuakanda,Phulpur,Mymensingh,</p>
                     

                    </div>
                    <div class="contact_address">
                        <i class="fa-solid fa-envelope-open"></i>
                         <h2>Our Mail</h2>
                         <p>pointsoft@gmail.com</p>
                         <p>malak123@gmail.com</p>

                    </div>

                </div>
            </div>
        </div>
        
    </section>
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
      $('.conatct_form').submit(function(e){
      e.preventDefault();

      var form = $(this);
      var url = form.attr('action');
      var formData = form.serialize();
      /** Use Ajax to send the  request **/
      $.ajax({
        type:'POST',
        'url':url,
        data: formData,
          beforeSend: function() {
              $('#submitBtn').html(`<div class="text-center">
                  <div class="spinner-border" role="status">
                      <span class="visually-hidden"></span>
                  </div>
              </div>`);
              $('#submitBtn').attr('disabled', true);
          },
        success: function (response) {
          if (response.success==true ) {
          $('#submitBtn').html('Send');
          $('#submitBtn').attr('disabled', false);
          $(".conatct_form  input[name='name']").val('');
          $(".conatct_form  input[name='subject']").val('');
          $(".conatct_form  input[name='email']").val('');
          $(".conatct_form  input[name='phone']").val('');
          $(".conatct_form  textarea[name='comment']").val('');
            toastr.success(response.message);
          }
        },

        error: function (xhr, status, error) {
              if(xhr.responseJSON && xhr.responseJSON.errors) {
                  // Loop through validation errors and display them
                  $.each(xhr.responseJSON.errors, function (key, value) {
                      toastr.error(value[0]);
                  });
              } else {
                  toastr.error('An error occurred.');
              }

              $('#submitBtn').html('Send');
              $('#submitBtn').attr('disabled', false);
          }
      });
    });
  });
</script>
@endsection