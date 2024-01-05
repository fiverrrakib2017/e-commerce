@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
		<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('Backend/lib/select2/css/select2.min.css')}}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">

@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.seller.index')}}">Seller</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;">
   <div class="row">
    <div class="col-md-9 m-auto">
    <div class="card">
    <div class="card-header bg-primary text-white">
      <h6>Add New Shop</h6>
    </div>
    <form  method="post" action="{{route('admin.shop.store')}}" id="productForm" enctype="multipart/form-data">
      @csrf
      <div class="card-body">

        <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Full Name</label>
                <input type="text"  class="form-control" name="fullname"  placeholder="Enter Full Name" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Slug</label>
                <input type="text"  class="form-control" name="slug"  placeholder="Enter Slug" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Seller Name</label>
                <select type="text"  class="form-control" name="seller_id">
                  <option value="">---Select---</option>
                    @foreach ($seller as $item)
                      <option value="{{$item->id}}">{{ $item->fullname }}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Logo</label>
                <input type="file"  class="form-control"  onchange="previewImage(this, 'logoPreview')" name="logo" required>
                <img id="logoPreview" src="#" alt="Logo Preview" style="max-width: 40%; max-height:50%; display: none;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Slider Image</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'sliderPreview')" name="slider" required>
                <img id="sliderPreview" src="#" alt="Slider Preview" style="max-width: 40%; display: none;">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Top Banner</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'TopBannerPreview')" name="top_banner" required>
                <img id="TopBannerPreview" src="#" style="max-width: 40%; display: none;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Full Width</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerFullWidthPreview')" name="banner_full_width" required>
                <img id="bannerFullWidthPreview" src="#" style="max-width: 40%; display: none;">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Half Width</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerHelfWidthPreview')" name="banner_half_width" required>
                <img id="bannerHelfWidthPreview" src="#" style="max-width: 40%; display: none;">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Full Width 2</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerFullWidth2Preview')" name="banner_full_width2" required>
                <img id="bannerFullWidth2Preview" src="#" style="max-width: 40%; display: none;">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Upload Limited</label>
                <input type="text"  class="form-control" name="product_upload_limit" placeholder="Enter Here" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Varification Status</label>
                <select type="file"  class="form-control" name="verification_status" >
                    <option value="">---Select---</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Varification Info</label>
                <textarea type="text"  class="form-control" name="verification_info" placeholder="Enter Varification information"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Cash On Delivery Status</label>
                <select type="file"  class="form-control" name="cash_on_delivery_status" >
                    <option value="">---Select---</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Admin To Pay</label>
                <input type="text"  class="form-control" name="admin_to_pay" placeholder="Enter Pay Amount">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Facebook Page Link</label>
                <input type="text"  class="form-control" name="facebook" placeholder="Enter Facebook Link">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Instagram</label>
                <input type="text"  class="form-control" name="instagram" placeholder="Enter Instagram Link">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Google</label>
                <input type="text"  class="form-control" name="google" placeholder="Enter Google">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Twitter</label>
                <input type="text"  class="form-control" name="twitter" placeholder="Enter Twitter Link">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Youtube</label>
                <input type="text"  class="form-control" name="youtube" placeholder="Enter Youtube">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Meta Title</label>
                <input type="text"  class="form-control" name="meta_title" placeholder="Enter Meta Title">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Meta Description</label>
                <input type="text"  class="form-control" name="meta_description" placeholder="Enter Youtube">
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Pickup Point</label>
                <select type="text"  class="form-control" name="pickup_point_id">
                <option value="">---Select---</option>
                    @foreach ($pickup_point as $item)
                      <option value="{{$item->id}}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Shipping Cost</label>
                <input type="text"  class="form-control" name="shipping_cost" placeholder="Enter Shipping Cost">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Delivery Pickup Latitude</label>
                <input type="text"  class="form-control" name="delivery_pickup_latitude" placeholder="Enter Latitude Link"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Delivery Pickup Longitude</label>
                <input type="text"  class="form-control" name="delivery_pickup_longitude" placeholder="Enter Longitude Link">
            </div>
            </div>
        </div>



      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-success">Add Now</button>
          <button onclick="history.back();" type="button" class="btn btn-danger">Back</button>
      </div>
    </form>
   </div>
    </div>
   </div>
</div><!-- br-section-wrapper -->


@endsection

@section('script')
  <script type="text/javascript">
      function previewImage(input, previewId) {
        var fileInput = input;
        var previewImage = document.getElementById(previewId);
          if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';
            };
            reader.readAsDataURL(fileInput.files[0]);
          }
      }
  </script>


@if(session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @elseif(session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
    @endif

     @if(session("errors"))
        <script>
            var errors = @json(session('errors'));
            errors.forEach(function(error) {
              toastr.error(error);
            });
        </script>
    @endif
@endsection
