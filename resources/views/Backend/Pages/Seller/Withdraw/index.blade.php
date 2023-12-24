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
          <a class="breadcrumb-item" href="{{route('admin.seller.index')}}">Seller</a>
          <a class="breadcrumb-item" href="{{route('admin.seller.withdraw.index')}}">Withdraw</a>
          <span class="breadcrumb-item active">Home</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      <div class="card-header">
        <button  type="button" class="btn btn btn-success"  data-toggle="modal" data-target="#addModal">Add Withdraw</a>
      </div>
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Seller Name</th>
          <th class="">Amount</th>
          <th class="">Withdraw Date</th>
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
            <form action="{{route('admin.seller.withdraw.delete')}}" method="post" enctype="multipart/form-data">
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
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Withdraw</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form method="post" action="{{ route('admin.seller.withdraw.add') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
        <div class="form-group">
          <label for="">Seller Name</label>
          <select type="text" name="seller_id"  class="form-control" >
            <option value="">---Select---</option>
            @foreach ($seller as $seller)
                <option value="{{ $seller->id }}">{{ $seller->fullname }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="">Amount</label>
          <input type="number" class="form-control" name="amount" placeholder="Enter Amount" >
        </div>
        <div class="form-group">
          <label for="">Withdraw Date</label>
          <input type="date" class="form-control" name="withdraw_date" >
        </div>
        <div class="form-group">
          <label for="">Status</label>
          <select type="text" class="form-control" name="status">
              <option value="">Select</option>
              <option value="1" >Approve</option>
              <option value="2" >Panding</option>
              <option value="3">Reject</option>
          </select>
        </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Add Now</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
        <!----- End Add Form ------->
        </div>
    </div>
  </div>

  

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
        ajax: {
            url: "{{ route('admin.seller.withdraw.all_data') }}",
            /** Get The Seller Name Start**/
            dataSrc: function (json) {
                for (var i = 0; i < json.data.length; i++) {
                  var sellerId = json.data[i].seller_id;
                  $.ajax({
                    url: "{{ route('admin.seller.withdraw.get_seller_name', '') }}/" + sellerId,
                    async: false, 
                    success: function (response) {
                      json.data[i].seller_name = response;
                    },
                  });
                }
              return json.data;
            },
          /** Get The Seller Name Start**/
        },
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
            "data":"seller_name"
          },
          {
            "data":"amount"
          },
          {
            "data":"withdraw_date"
          },
          {
            "data":"status",
            render:function(data,type,row){
              if (row.status==1) {
                return '<span class="badge badge-success">Approve</span>';
              }else if(row.status==2){
                return '<span class="badge badge-primary">Pending</span>';
              }
              else{
                return '<span class="badge badge-danger">Reject</span>';
              }
            }
          },
          {
            "data":"created_at"
          },
          {
            render:function(data,type,row){
              return `<a href="/admin/seller/withdraw/edit/${row.id}" class="btn btn-primary btn-sm mr-3"><i class="fa fa-edit"></i></a>

              <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>`;

            }
          },
        ],
        order:[
          [0, "desc"]
        ],

      });
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
      // $('#datatable1_filter input').unbind().bind('input', function (e) {
      //   table.search(this.value).draw();
      // });
    });
   
  /** Handle Delete button click**/
  $('#datatable1 tbody').on('click', '.delete-btn', function () {
    var id = $(this).data('id');
    $('#deleteModal').modal('show');
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
