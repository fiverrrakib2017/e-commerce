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
		<a class="breadcrumb-item" href="{{route('admin.home_page.contract.index')}}">Contract</a>
		<span class="breadcrumb-item active">List All</span>
	</nav>
</div>
<!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;">
	<div class="table-wrapper">
		<div class="card">
			
			<div class="card-body">
			<table id="datatable1" class="table display responsive nowrap">
			<thead>
			<tr>
			<th class="">No.</th>
			<th class="">Name</th>
			<th class="">Email</th>
			<th class="">Phone</th>
			<th class="">Subject</th>
			<th class="">Comment</th>
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
        <form action="{{route('admin.home_page.contract.delete')}}" method="post" enctype="multipart/form-data">
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
@endsection
@section('script')
<script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
<script type="text/javascript">	
	$(document).ready(function(){

	  var table=$("#datatable1").DataTable({
	     "processing":true,
	    "responsive": true,
	    "serverSide":true,
	    beforeSend: function () {
	    },
	    ajax: "{{ route('admin.home_page.contract.all_data') }}",
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
	        "data":"name"
	      },
	      {
	        "data":"email"
	      },
	      {
	        "data":"phone_number"
	      },
	      {
	        "data":"subject"
	      },
	      {
	        "data":"comment",
	        render:function (data,type,row){
	          var max_length=50;
	          if (data.length > max_length) {
	            return data.substr(0,max_length)+'.....';
	          }
	          return data;
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
	          return ` <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>`
	        }
	      },
	    ],
	    order:[
	      [0, "desc"]
	    ],
	
	  });
	  $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
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