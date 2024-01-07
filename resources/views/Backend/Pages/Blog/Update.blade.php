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
          <a class="breadcrumb-item" href="{{route('admin.blog.index')}}">Blog</a>
          <span class="breadcrumb-item active">Update</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;"> 
   <div class="row">
    <div class="col-md-6 m-auto">
    <div class="card">
        <div class="card-header bg-info text-white"> <h6>Update Blog</h6>  </div>
        <form action="{{ route('admin.blog.update') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="card-body">
                <div class="col-xl-12">
                    <div class="form-layout form-layout-4">

                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">

                                <input class="form-control d-none" name="id" value="{{$blog->id}}" required>

                                <input class="form-control " name="title" placeholder="Enter Your Title" value="{{$blog->title}}" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label class="col-sm-3 form-control-label">Cateogry Name: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select type="text" name="category_id" class="form-control" required>
                                <option value="">---Select----</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}" @if ($blog->category_id == $item->id) selected @endif>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div><!-- row -->
                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Slug: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <input type="text" class="form-control " name="slug" value="{{$blog->slug}}" required>
                            </div>
                        </div>
                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Short Description: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <textarea class="form-control " name="short_description" placeholder="Enter Your Short Description">{{ $blog->short_description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <textarea class="form-control " name="description" placeholder="Enter Your  Description">{{ $blog->description }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Image: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <input type="file" class="form-control " name="image" id="imageInput" /><br>
                            
                            @if (!empty($blog->image))
                            <img class="img-fluid rounded" width="100px" height="50px" id="showImage" src="{{asset('Backend/images/blog/'.$blog->image)}}" alt="">
                            @endif
                            </div>
                        </div>

                        

                        <div class="row mb-4 mt-4">
                            <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                            <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                                <select class="form-control " name="status" required>
                                    <option value="">---Select---</option>
                                    <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ $blog->status == 2 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                    </div>
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


@if(session('errors'))
    <script>
      var errors = @json(session('errors'));
      errors.forEach(function(error) {
          toastr.error(error);
      });
    </script>
  @endif
@endsection

