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
          <a class="breadcrumb-item" href="{{route('admin.products.index')}}">Product</a>
          <span class="breadcrumb-item active">Discount Coupon</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
        <button  type="button" class="btn btn btn-success"  data-toggle="modal" data-target="#addModal">Add Discount Coupon</a>
      </div>
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Code</th>
          <th class="">Name</th>
          <th class="">Maximum Use</th>
          <th class="">Discount Amount</th>
          <th class="">Minimum Amount</th>
          <th class="">Expire Date</th>
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
    
  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->

<!--Start Delete MODAL ---->
<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <form action="{{route('admin.discount.delete')}}" method="post" enctype="multipart/form-data">
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
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Discount Coupon</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form action="{{route('admin.discount.store')}}" method="post">
        @csrf

        <div class="modal-body ">
            <!----- Start Add  Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">

                    <div class="row mb-4 mt-4">
                        <label class="col-sm-3 form-control-label">Code <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="text" name="code" class="form-control" placeholder="Enter Code" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="text" name="name" class="form-control" placeholder="Enter  Name" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <textarea type="text" name="description" class="form-control" placeholder="Enter  Name" ></textarea>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Maximum Usage: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="max_use" class="form-control" placeholder="Enter  Maximum Usage" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4 mt-4">
                        <label class="col-sm-3 form-control-label">Type: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control " name="type" required>
                                <option value="">---Select---</option>
                                <option value="fixed">Fixed</option>
                                <option value="parcent">Parcent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Discount Amount: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="discount_amount" class="form-control" placeholder="Enter Discount Amount" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Minimum Amount: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="min_amount" class="form-control" placeholder="Enter Minimum Amount" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Start Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="date" name="start_date" class="form-control" />
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Expire Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="date" name="expire_date" class="form-control" />
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
                    </div>

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
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Discount Coupon</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form action="{{route('admin.discount.update')}}" method="post">
        @csrf

        <div class="modal-body ">
            <!----- Start Add  Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">

                    <div class="row mb-4 mt-4">
                        <label class="col-sm-3 form-control-label">Code <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="text" name="code" class="form-control" placeholder="Enter Code" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Name: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="text" name="id" class="d-none">
                        <input type="text" name="name" class="form-control" placeholder="Enter  Name" required>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Description: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <textarea type="text" name="description" class="form-control" placeholder="Enter  Name" ></textarea>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Maximum Usage: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="max_use" class="form-control" placeholder="Enter  Maximum Usage" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4 mt-4">
                        <label class="col-sm-3 form-control-label">Type: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                            <select class="form-control " name="type" required>
                                <option value="">---Select---</option>
                                <option value="fixed">Fixed</option>
                                <option value="parcent">Parcent</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Discount Amount: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="discount_amount" class="form-control" placeholder="Enter Discount Amount" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Minimum Amount: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="number" name="min_amount" class="form-control" placeholder="Enter Minimum Amount" required/>
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Start Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="date" name="start_date" class="form-control" />
                        </div>
                    </div><!-- row -->

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Expire Date: <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                        <input type="date" name="expire_date" class="form-control" />
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
                    </div>

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
     
      var table=$("#datatable1").DataTable({
         "processing":true,
        "responsive": true,
        "serverSide":true,
        beforeSend: function () {
        },
        ajax: "{{ route('admin.discount.all_data') }}",
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
            "data":"code"
          },
          {
            "data":"name"
          },
          {
            "data":"max_use"
          },
          {
            "data":"discount_amount"
          },
          {
            "data":"min_amount"
          },
          {
            "data":"expires_at"
          },
          {
            "data":"status",
            render:function(data,type,row){
              if (row.status==1) {
                return '<span class="badge badge-success">Active</span>';
              }else{
                return '<span class="badge badge-secondary">Inactive</span>';
              }
            }
          },
          {
            "data":"created_at"
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
          url: '/admin/discount/edit/' + id,
          success: function (response) {
              if (response.success) {
                $('#editModal').modal('show');
                $('#editModal input[name="id"]').val(response.data.id);
                $('#editModal input[name="code"]').val(response.data.code);
                $('#editModal input[name="name"]').val(response.data.name);
                $('#editModal textarea[name="description"]').val(response.data.description);
                $('#editModal input[name="max_use"]').val(response.data.max_use);
                $('#editModal select[name="type"]').val(response.data.type);
                $('#editModal input[name="discount_amount"]').val(response.data.discount_amount);
                $('#editModal input[name="min_amount"]').val(response.data.min_amount);
                var startDate = new Date(response.data.starts_at);
                var expireDate = new Date(response.data.expires_at);
                $('#editModal input[name="start_date"]').val(startDate.toISOString().split('T')[0]);
                $('#editModal input[name="expire_date"]').val(expireDate.toISOString().split('T')[0]);
                $('#editModal select[name="status"]').val(response.data.status);
              } else {
                toastr.error("Error fetching data for edit!");
              }
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
            toastr.error("Error fetching data for edit!");
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
          //table.ajax.reload();
          $('#datatable1').DataTable().ajax.reload( null , false);
        } else {
           /** Handle  errors **/
          toastr.error("Error!!!");
        }
      },

      error: function (xhr, status, error) {
         /** Handle  errors **/
        console.error(xhr.responseText);
      }
    });
  });




  /** Store The data from the database table **/
  $('#addModal form').submit(function(e){
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
        $('#addModal').modal('hide');
        $('#addModal form')[0].reset();
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
         /** Handle  errors **/
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
