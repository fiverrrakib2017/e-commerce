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
          <a class="breadcrumb-item" href="{{route('admin.seller.withdraw.index')}}">Withdraw</a>
          <span class="breadcrumb-item active">Update</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;">
   <div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
    <div class="card-header bg-info text-white">
      <h6>Update Withdraw</h6>
    </div>
        <form method="post" action="{{ route('admin.seller.withdraw.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
            <div class="form-group d-none">
          <label for="">Category Id</label>
          <input type="text" class="form-control" name="id" value="{{$data->id}}">
        </div>
        <div class="form-group">
          <label for="">Seller Name</label>
          <select type="text" name="seller_id"  class="form-control" >
            @foreach ($seller as $seller)
                <option value="{{ $data->seller_id }}"
                    {{ $data->seller_id == $seller->id ? 'selected' : '' }}>
                    {{ $seller->fullname }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="">Amount</label>
          <input type="number" class="form-control" name="amount" placeholder="Enter Amount" value="{{$data->amount}}">
        </div>
        <div class="form-group">
          <label for="">Withdraw Date</label>
          <input type="date" class="form-control" name="withdraw_date" value="{{$data->withdraw_date}}">
        </div>
        <div class="form-group">
          <label for="">Status</label>
          <select type="text" class="form-control" name="status">
              <option value="">Select</option>
              <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Approve</option>
              <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Pending</option>
              <option value="3" {{ $data->status == 3 ? 'selected' : '' }}>Reject</option>
          </select>
        </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Update Now</button>
                <button type="button" onclick="history.back();" class="btn btn-danger">Back</button>
            </div>
        </form>
   </div>
    </div>
   </div>
</div><!-- br-section-wrapper -->


@endsection

@section('script')
  <script type="text/javascript">
      $(document).ready(function(){
        imageInput.onchange = evt => {
          const [file] = imageInput.files
          if (file) {
            showImage.src = URL.createObjectURL(file)
          }
        }
      });
  </script>
@endsection
