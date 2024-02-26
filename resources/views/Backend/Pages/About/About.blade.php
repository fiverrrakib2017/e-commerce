@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<!-- vendor css -->
<link href="{{asset('Backend/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
<link href="{{asset('Backend/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{asset('Backend/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<!-- Bracket CSS -->
<link rel="stylesheet" href="{{asset('Backend/css/bracket.css')}}">
@endsection
@section('content')
<div class="br-pageheader">
	<nav class="breadcrumb pd-0 mg-0 tx-12">
		<a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
		<a class="breadcrumb-item" href="{{route('admin.home_page.about.index')}}">About</a>
		<span class="breadcrumb-item active">List All</span>
	</nav>
</div>
<!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
	<div class="table-wrapper">
		<div class="card">
			<div class="card-header">
				<button  type="button" class="btn btn btn-success"  data-toggle="modal" data-target="#addModal">
					Add New </a>
			</div>
			<div class="card-body">
			<table id="datatable1" class="table display responsive nowrap">
			<thead>
			<tr>
			<th class="">No.</th>
			<th class="">Title</th>
			<th class="">Description</th>
			<th class="">Image</th>
			<th class="">Status</th>
			<th class="">Create Date</th>
			<th class="">Action</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			</table>
			</div>
		</div>
	</div>
	<!-- table-wrapper -->
</div>
<!-- br-section-wrapper -->
<!--Start Delete MODAL ---->
<div id="deleteModal" class="modal fade">
  <div class="modal-dialog modal-dialog-top" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-body tx-center pd-y-20 pd-x-20">
        <form action="{{route('admin.home_page.about.delete')}}" method="post" enctype="multipart/form-data">
        @csrf
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        <i class="icon icon ion-ios-close-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
        <h4 class="tx-danger  tx-semibold mg-b-20 mt-2">Are you sure! you want to delete this?</h4>
        <input type="hidden" name="id" value="">
        <button type="submit" class="btn btn-danger mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
        yes
        </button>
        <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
        No
        </button>
        </form>
      </div><!-- modal-body -->
    </div><!-- modal-content -->
  </div>
</div>
<!--End Delete MODAL ---->
<div id="addModal" class="modal fade effect-scale">
	<div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-header pd-x-20">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add About Section</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!----- Start Add  Form ------->
			<form id="form_data">
				<div class="modal-body ">
					<!----- Start Add  Form input ------->
					<div class="col-xl-12">
						<div class="form-layout form-layout-4">
            <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <textarea type="text" name="description" class="form-control" placeholder="Enter Description" style="height: 281px;" required></textarea>
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Image: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                      <input type="file" name="photo" class="form-control"  required >
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label"><span class="tx-danger"></span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <img src="{{asset('Backend/images/default.jpg')}}" alt="" class="img-fluid img-responsive " id="addImagePreview">
                    </div>
                </div><!-- row -->

                <div class="row mb-4 mt-4">
                    <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <select class="form-control " name="status" required>
                          <option value="">---Select---</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>
                </div><!-- row -->
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success tx-size-xs">Save changes</button>
					<button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
				</div>
			</form>
			<!----- End Add Form ------->
		</div>
	</div>
</div>
<!----- Edit Modal ------->
<div id="editModal" class="modal fade effect-scale">
	<div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
		<div class="modal-content tx-size-sm">
			<div class="modal-header pd-x-20">
				<h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Update About Section</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<!----- Start Add  Form ------->
			<form id="editModal_data">
				<div class="modal-body ">
					<!----- Start Add  Form input ------->
					<div class="col-xl-12">
						<div class="form-layout form-layout-4">
              
                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Title: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <input type="text" name="id" class="d-none" required>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <textarea type="text" name="description" class="form-control" placeholder="Enter Description" style="height: 281px;" required></textarea>
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label">Image: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                      <input type="file" name="photo" class="form-control">
                    </div>
                </div><!-- row -->

                <div class="row mb-4">
                    <label class="col-sm-3 form-control-label"><span class="tx-danger"></span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                    <img src="{{asset('Backend/images/default.jpg')}}" alt="" class="img-fluid img-responsive " id="editImagePreview">
                    </div>
                </div><!-- row -->

                <div class="row mb-4 mt-4">
                    <label class="col-sm-3 form-control-label">Status: <span class="tx-danger">*</span></label>
                    <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <select class="form-control " name="status" required>
                          <option value="">---Select---</option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>
                </div><!-- row -->

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success tx-size-xs">Update Now</button>
					<button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
				</div>
			</form>
			<!----- End Add Form ------->
		</div>
	</div>
</div>
<!----- Edit Modal ------->
@endsection
@section('script')
<script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script type="text/javascript">	
	$(document).ready(function(){

    $('#addModal input[name="photo"]').on('change', function(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = $('#addImagePreview');
        output.attr('src', reader.result);
      }
      reader.readAsDataURL(event.target.files[0]);
    });
    $('#editModal input[name="photo"]').on('change', function(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = $('#editImagePreview');
        output.attr('src', reader.result);
      }
      reader.readAsDataURL(event.target.files[0]);
    });

	  var table=$("#datatable1").DataTable({
	     "processing":true,
	    "responsive": true,
	    "serverSide":true,
	    beforeSend: function () {
	    },
	    ajax: "{{ route('admin.home_page.about.all_data') }}",
	    language: {
	      searchPlaceholder: 'Search...',
	      sSearch: '',
	      lengthMenu: '_MENU_ items/page',
	    },
	    "columns":[
	      {
	        "data":"id"
	      },
	      {
	        "data":"title"
	      },
	      {
	        "data":"description",
	        render:function (data,type,row){
	          var max_length=50;
	          if (data.length > max_length) {
	            return data.substr(0,max_length)+'.....';
	          }
	          return data;
	        }
	      },
	      {
	        "data":null,
          render:function(data,type,row){
            return '<img src="'+row.photo+'" class="img-fluid img-responsive"/>'
          }
	      },
	      {
	        "data":"status",
	        render:function(data,type,row){
	          if (row.status==1) {
	            return '<span class="badge badge-success">Active</span>';
	          }else{
	            return '<span class="badge badge-danger">Inactive</span>';
	          }
	        }
	      },
	      {
	        "data":"created_at",
	        render: function (data, type, row) {
	            var formattedDate = moment(row.created_at).format('DD MMM YYYY');
	            return formattedDate;
	        }
	      },
	      {
	        render:function(data,type,row){
	          return `<button class="btn btn-primary btn-sm mr-3 edit-btn" data-id="${row.id}"><i class="fa fa-edit"></i></button>
	            <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>`
	        }
	      },
	    ],
	    order:[
	      [0, "desc"]
	    ],
	
	  });
	  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
	});
	
	
	
	/** Handle edit button click**/
	$('#datatable1 tbody').on('click', '.edit-btn', function () {
	  var id = $(this).data('id');
	  $.ajax({
	      type: 'GET',
	      url: '/admin/home_page/about/edit/' + id,
	      success: function (response) {
	          if (response.success) {
	            $('#editModal').modal('show');
	            $('#editModal input[name="id"]').val(response.data.id);
	            $('#editModal input[name="title"]').val(response.data.title);
	            $('#editModal textarea[name="description"]').val(response.data.description);
	            $('#editModal img').attr('src',response.data.photo);
	            $('#editModal select[name="status"]').val(response.data.status);
	          } else {
	            toastr.error("Error fetching data for edit!");
	          }
	      },
	      error: function (xhr, status, error) {
			if(xhr.responseJSON && xhr.responseJSON.errors) {
                // Loop through validation errors and display them
                $.each(xhr.responseJSON.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
	        toastr.error("Error fetching data for edit!");
	      }
	  });
	});

	/** Update The data from the database table **/
	$('#editModal_data').submit(function(e){
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    formData.append('_token', '{{ csrf_token() }}');
    /** Use Ajax to send request **/
      $.ajax({
          url: '{{ route("admin.home_page.about.update") }}',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            if (response.success) {
              toastr.success(response.success);
              $('#datatable1').DataTable().ajax.reload( null , false);
              $('#editModal').modal('hide');
              $('#editModal_data')[0].reset();
            }
          },
          error: function(xhr, status, error) {
            if(xhr.responseJSON && xhr.responseJSON.errors) {
                // Loop through validation errors and display them
                $.each(xhr.responseJSON.errors, function (key, value) {
                    toastr.error(value[0]);
                });
            }
          }
      });
	});
	
	
	
	/** Handle Delete button click**/
	$('#datatable1 tbody').on('click', '.delete-btn', function () {
	var id = $(this).data('id');
	$('#deleteModal').modal('show');
	console.log("Delete ID: " + id);
	var value_input = $("input[name*='id']").val(id);
	});
	
	
	
	/** Handle form submission for delete **/
	$('#deleteModal form').submit(function(e){
		e.preventDefault();
		
		var form = $(this);
		var url = form.attr('action');
		var formData = form.serialize();
			/** Use Ajax to send the delete request **/
			$.ajax({
			type:'POST',
			'url':url,
			data: formData,
			success: function (response) {
				$('#deleteModal').modal('hide');
				if (response.success) {
				toastr.success(response.success);
				$('#datatable1').DataTable().ajax.reload( null , false);
				}
			},
		
			error: function (xhr, status, error) {
					if(xhr.responseJSON && xhr.responseJSON.errors) {
						// Loop through validation errors and display them
						$.each(xhr.responseJSON.errors, function (key, value) {
							toastr.error(value[0]);
						});
					}
				toastr.error(xhr.responseText);
			}
		});
	});
	
	
	
	
	/** Store The data from the database table **/
	$('#form_data').submit(function(e){
	e.preventDefault();
	var formData = new FormData($(this)[0]);
	formData.append('_token', '{{ csrf_token() }}');
	/** Use Ajax to send request **/
	  $.ajax({
	      url: '{{ route("admin.home_page.about.store") }}',
	      type: 'POST',
	      data: formData,
	      processData: false,
	      contentType: false,
	      success: function(response) {
	          if (response.success) {
	            toastr.success(response.success);
	            $('#datatable1').DataTable().ajax.reload( null , false);
	            $('#addModal').modal('hide');
	            $('#form_data')[0].reset();
	          }
	      },
	      error: function(xhr, status, error) {
	          // Handle error response
	          console.error(xhr.responseText);
	      }
	  });
	});
	
	
	
	
	/** Update The data from the database table **/
	$('#editModal form').submit(function(e){
	e.preventDefault();
	
	var form = $(this);
	var url = form.attr('action');
	var formData = form.serialize();
	/** Use Ajax to send the delete request **/
	$.ajax({
	  type:'POST',
	  'url':url,
	  data: formData,
	  beforeSend: function () {
	    form.find(':input').prop('disabled', true);
	  },
	  success: function (response) {
	    $('#editModal').modal('hide');
	    $('#editModal form')[0].reset();
	    if (response.success) {
	      toastr.success(response.success);
	      $('#datatable1').DataTable().ajax.reload( null , false);
	    } else {
	       /** Handle validation errors **/
	      if (response.errors) {
	          var errorMessages = response.errors.join('<br>');
	          toastr.error(errorMessages);
	      }else {
	        toastr.error("Error!!!");
	      }
	    }
	  },
	
	  error: function (xhr, status, error) {
	    console.error(xhr.responseText);
	  },
	  complete: function () {
	      form.find(':input').prop('disabled', false);
	    }
	});
	});
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
@endsection