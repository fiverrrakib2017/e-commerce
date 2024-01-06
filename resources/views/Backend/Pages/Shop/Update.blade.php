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
    <form  method="post" action="{{route('admin.shop.update')}}" id="productForm" enctype="multipart/form-data">
      @csrf
      <div class="card-body">

        <div class="row">
            <div class="col-md-4">
              <div class="form-group d-none">
                <label for="">Request Id</label>
                <input type="text"  class="form-control" name="id"  placeholder="Enter Full Name" value="{{$shop->id}}" required>
              </div>

              <div class="form-group">
                <label for="">Full Name</label>
                <input type="text"  class="form-control" name="fullname"  placeholder="Enter Full Name" value="{{$shop->name}}" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Slug</label>
                <input type="text"  class="form-control" name="slug"  placeholder="Enter Slug" required  value="{{$shop->slug}}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Seller Name</label>
                <select type="text"  class="form-control" name="seller_id">
                    @foreach ($seller as $seller)
                    <option value="{{ $seller->id }}"
                        {{ $shop->seller_id == $seller->id ? 'selected' : '' }}>
                        {{ $seller->fullname }}</option>
                    @endforeach
                </select>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Logo</label>
                <input type="file"  class="form-control"  onchange="previewImage(this, 'logoPreview')" name="logo" >
                @if (!empty($shop->logo))
                <img id="logoPreview" src="{{asset('Backend/images/shop/'.$shop->logo)}}" alt="Logo Preview" style="max-width: 40%; max-height:50%; ">
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Slider Image</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'sliderPreview')" name="slider" >
                @if (!empty($shop->logo))
                <img id="sliderPreview" src="{{asset('Backend/images/shop/'.$shop->slider)}}" style="max-width: 40%; max-height:50%; ">
                @endif
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Top Banner</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'TopBannerPreview')" name="top_banner" >
                @if (!empty($shop->top_banner))
                <img id="TopBannerPreview" src="{{asset('Backend/images/shop/'.$shop->top_banner)}}" style="max-width: 40%; max-height:50%; ">
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Full Width 1</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerFullWidthPreview')" name="banner_full_width_1" >
               
                @if (!empty($shop->banner_full_width_1))
                 <img id="bannerFullWidthPreview" src="{{asset('Backend/images/shop/'.$shop->banner_full_width_1)}}" style="max-width: 40%; ">
                @endif
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Half Width</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerHelfWidthPreview')" name="banner_half_width" >
                @if (!empty($shop->banner_half_width))
                <img id="bannerHelfWidthPreview" src="{{asset('Backend/images/shop/'.$shop->banner_half_width)}}" style="max-width: 40%; ">
                @endif
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Banner Full Width 2</label>
                <input type="file"  class="form-control" onchange="previewImage(this, 'bannerFullWidth2Preview')" name="banner_full_width_2" >
                @if (!empty($shop->banner_full_width_2))
                <img id="bannerFullWidth2Preview" src="{{asset('Backend/images/shop/'.$shop->banner_full_width_2)}}" style="max-width: 40%; ">
                @endif
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Upload Limited</label>
                <input type="text"  class="form-control" name="product_upload_limit" placeholder="Enter Here" value="{{$shop->product_upload_limit}}" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Varification Status</label>
                <select class="form-control" name="verification_status">
                    <option value="">---Select---</option>
                    <option value="1" @if(isset($shop) && $shop->verification_status == 1) selected @endif>Active</option>
                    <option value="0" @if(isset($shop) && $shop->verification_status == 0) selected @endif>Inactive</option>
                </select>

            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Varification Info</label>
                <textarea type="text"  class="form-control" name="verification_info" placeholder="Enter Varification information">{{ $shop->verification_info }}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Cash On Delivery Status</label>
                <select type="file"  class="form-control" name="cash_on_delivery_status" >
                    <option value="1" @if(isset($shop) && $shop->cash_on_delivery_status == 1) selected @endif>Active</option>
                    <option value="0" @if(isset($shop) && $shop->cash_on_delivery_status == 0) selected @endif>Inactive</option>
                </select>
            </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Admin To Pay</label>
                <input type="text"  class="form-control" name="admin_to_pay" placeholder="Enter Pay Amount" value="{{$shop->admin_to_pay}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Facebook Page Link</label>
                <input type="text"  class="form-control" name="facebook" placeholder="Enter Facebook Link" value="{{$shop->facebook}}">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Instagram</label>
                <input type="text"  class="form-control" name="instagram" placeholder="Enter Instagram Link" value="{{$shop->instagram}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Google</label>
                <input type="text"  class="form-control" name="google" placeholder="Enter Google" value="{{$shop->google}}">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Twitter</label>
                <input type="text"  class="form-control" name="twitter" placeholder="Enter Twitter Link" value="{{$shop->twitter}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Youtube</label>
                <input type="text"  class="form-control" name="youtube" placeholder="Enter Youtube" value="{{$shop->youtube}}">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Meta Title</label>
                <input type="text"  class="form-control" name="meta_title" placeholder="Enter Meta Title" value="{{$shop->meta_title}}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Meta Description</label>
                <input type="text"  class="form-control" name="meta_description" placeholder="Enter Youtube" value="{{$shop->meta_description}}">
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
                    <option value="{{ $item->id }}"
                        {{ $shop->pickup_point_id == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Shipping Cost</label>
                <input type="text"  class="form-control" name="shipping_cost" placeholder="Enter Shipping Cost" value="{{$shop->shipping_cost}}">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Delivery Pickup Latitude</label>
                <input type="text"  class="form-control" name="delivery_pickup_latitude" placeholder="Enter Latitude Link" value="{{$shop->delivery_pickup_latitude}}"/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Delivery Pickup Longitude</label>
                <input type="text"  class="form-control" name="delivery_pickup_longitude" placeholder="Enter Longitude Link" value="{{$shop->delivery_pickup_longitude}}">
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
