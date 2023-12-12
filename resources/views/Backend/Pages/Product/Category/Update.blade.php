@extends('Backend.Layout.App')
@section('title',' Admin - Category Edit')
@section('style')
 <!-- vendor css -->
 <link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
	<link href="{{asset('Backend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
	<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="br-section-wrapper">
  <h6 class="br-section-label text-center mb-4">Update Category</h6>

  <!----- Start Add Category Form input ------->
  <div class="col-xl-7 mx-auto">
      <div class="form-layout form-layout-4 py-5">

          <form action="{{ route('admin.update_category', $category->id) }}" method="post">
              @csrf
              <div class="row">
                  <label class="col-sm-3 form-control-label">Category Name: <span class="tx-danger">*</span></label>
                  <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                  <input type="text" name="cat_name" class="form-control" value="{{ $category->cat_name}}" required>
                  </div>
              </div><!-- row -->

              <div class="row mt-4">
                <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                  <select class="form-control select2" name="status">
                    <option @if($category->status == 1) @selected(true) @endif value="1">Active</option>
                    <option @if($category->status == 0) @selected(true) @endif value="0">Inactive</option>
                </select>
                </div>
              </div><!-- row -->

              <div class="row mt-4">
                <div class="col-sm-12 mg-t-10 mg-sm-t-0 text-right">
                  <a href="{{route('admin.all_category')}}" type="button" class="btn btn-secondary text-white mr-2" >Close</a>
                  <button type="submit" class="btn btn-info ">Update changes</button>
                </div>
              </div>
          </form>

      </div><!-- form-layout -->
  </div><!-- col-6 -->
  <!----- Start Add Category Form input ------->
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

@section('script')
    @if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
    @elseif(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
    @endif



    @if(session('errors'))
        <script>
            var errors = @json(session('errors'));
            errors.forEach(function(error) {
              alert(error);
            });
        </script>
    @endif


@endsection