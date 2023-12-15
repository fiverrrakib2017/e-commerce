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
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <style>
      /* dropzone.css */
.dropzone {
    border: 2px dashed #287eff !important;
    border-radius: 5px;
    padding: 6px !important;
    text-align: center;
    cursor: pointer;
}

.dz-message {
    font-size: 18px;
    color: #777;
}

#rowImg {
  margin-top: 20px;
  display: flex;
  flex-wrap: wrap-reverse;

  gap:10px;
}
.sortImage{
  height: 100px;
  max-width: 100%;
}


.invalid{
  border: 2px solid rgb(255, 47, 47) !important;
  background: rgba(255, 255, 255, 0.849) !important;
  border-radius: 4px;
}

.errText {
  color: #ff3030 !important;
  font-size: 13px !important ;
  font-weight: 400 !important;
}

.Neon {
    font-family: sans-serif;
    font-size: 14px;
    color: #494949;
    position: relative;


}
.Neon * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    
}
.Neon-input-dragDrop {
    display: block;
    width: 100%;
    margin: 15px 0;
    padding: 25px;
    color: #8d9499;
    color: #97A1A8;
    background: #fff;
    border: 2px dashed #C8CBCE;
    text-align: center;
    -webkit-transition: box-shadow 0.3s, border-color 0.3s;
    -moz-transition: box-shadow 0.3s, border-color 0.3s;
    transition: box-shadow 0.3s, border-color 0.3s;
    
}
.Neon-input-dragDrop .Neon-input-icon {
    font-size: 48px;
    margin-top: -10px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;

}
.Neon-input-text h3 {
    margin: 0;
    font-size: 18px;
    cursor: pointer;
}
.Neon-input-text span {
    font-size: 12px;
}
.Neon-input-choose-btn.blue {
    color: #008BFF;
    border: 1px solid #008BFF;
}
.Neon-input-choose-btn {
    display: inline-block;
    padding: 8px 14px;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    font-size: 12px;
    font-weight: bold;
    color: #8d9496;
    border-radius: 3px;
    border: 1px solid #c6c6c6;
    vertical-align: middle;
    background-color: #fff;
    box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    transition: all 0.2s;
}



*,
::before,
::after {
  box-sizing: border-box;
  /* 1 */
  border-width: 0;
  /* 2 */
  border-style: solid;
  /* 2 */
  border-color: #e5e7eb;
  /* 2 */
}

::before,
::after {
  --tw-content: '';
}


.textarea {
    padding: 10px;
    border: 1px solid gray;
    border-radius: 5px;
    height: 120px;
    color: black;
}

.textarea:focus{
  outline: none;
}

#scroll{
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  height: 90%;
  background-color: white;
  overflow-y: auto;
  padding: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}
    </style>
@endsection
@section('content')
      <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
          <a class="breadcrumb-item" href="{{route('admin.products.index')}}">Product</a>
          <span class="breadcrumb-item active">Create</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="" style="padding: 0px !important;"> 
   <div class="row">
    <div class="col-md-9 m-auto">
    <div class="card">
    <div class="card-header bg-info text-white text-center">
      <h6>Add New Product</h6>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Enter Brand Name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Product Slug</label>
                <input type="text" class="form-control" name="slug" placeholder="Enter Slug">
            </div>
            </div>
          </div>
         
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <input type="text" name="image_id" id="image_id" hidden>
                  <label for="image" class="label">Upload Image</label>
                  <div id="image" class="dropzone dz-clickable">
                    <div class="dz-message needsclick">    
                        <br>Drop files here or click to upload.<br><br>                                            
                    </div>
                </div>
                <div id="rowImg"></div>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <label for="">Slug</label>
            <input type="text" class="form-control" name="slug" placeholder="Enter Slug">
          </div>
          <div class="form-group">
            <label for="">Status</label>
            <select type="text" class="form-control" name="status" required>
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">Add Now</button>
          </div>
        </form>
    </div>
   </div> 
    </div>
   </div>
</div><!-- br-section-wrapper -->


@endsection

@section('script')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
  <script type="text/javascript">
      Dropzone.autoDiscover = false;    
    const dropzone = $("#image").dropzone({ 

        url:  "{{ route('temp-image.create') }}",
        maxFiles: 10,
        paramName: 'image',
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }, success: function(file, response){
            // console.log(response.message);
            // $("#image_id").val(response.image_id);
            var html = `
            <div id="image-row-${response.image_id}">
                <input type="text" name="image_array[]" value="${response.image_id}" hidden>
                <div  id="border">
                    <img src="${response.imagePath}" class="sortImage">
                    <a href="javascript:void(0)" onclick='deleteImage(${response.image_id})' class="errBtn">Remove</a>
                </div>
            </div>`;
            $('#rowImg').append(html);
        },
        complete: function(file){
            this.removeFile(file);
        },
        error: function(error){
            console.log(error);
        }
    });


    function deleteImage(id){
        $('#image-row-' +id).remove();
    }
  </script>
@endsection

