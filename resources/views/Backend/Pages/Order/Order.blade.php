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
          <span class="breadcrumb-item active">All Order</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">Invoice No.</th>
          <th class="">Full Name</th>
          <th class="">Phone Number</th>
          <th class="">Sub Total</th>
          <th class="">Discount</th>
          <th class="">Grand Total</th>
          <th class="">Order Status</th>
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

<!--Start Order Confirm MODAL ---->
  <div id="orderConfirmModal" class="modal fade">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <form action="{{route('admin.order.confirm_order')}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-checkmark-outline tx-60 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success  tx-semibold mg-b-20 mt-2">Are you sure! you want to Confirm this?</h4>
                <input type="hidden" name="id" value="">
                <button type="submit" class="btn btn-success mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                    yes
                </button>
                <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    No
                </button>
            </form>
        </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div>
  </div>
<!--Start Order Restart MODAL ---->
  <div id="orderRestartModal" class="modal fade">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <form action="{{route('admin.order.restart_order')}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-refresh-outline tx-60 tx-primary lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-primary  tx-semibold mg-b-20 mt-2">Are you sure! you want to Restart this?</h4>
                <input type="hidden" name="id" value="">
                <button type="submit" class="btn btn-primary mr-2 text-white tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20">
                    yes
                </button>
                <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    No
                </button>
            </form>
        </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div>
  </div>
<!--Start Delete MODAL ---->
  <div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content tx-size-sm">
        <div class="modal-body tx-center pd-y-20 pd-x-20">
            <form action="{{route('admin.order.delete')}}" method="post" enctype="multipart/form-data">
                @csrf
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="icon icon ion-ios-trash-outline tx-60 tx-danger lh-1 mg-t-20 d-inline-block"></i>
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
<!---------Add Note Modal----------->
  <div id="addNoteModal" class="modal fade effect-scale">
        <div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
            <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Note</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form action="{{route('admin.order.note.store')}}" method="post">
        @csrf

        <div class="modal-body ">
            <!----- Start Add  Form input ------->
            <div class="col-xl-12">
                <div class="form-layout form-layout-4">

                    <div class="row mb-4">
                        <label class="col-sm-3 form-control-label">Note : <span class="tx-danger">*</span></label>
                        <div class="col-sm-9 mg-t-10 mg-sm-t-0">
                          <input type="text" name="id" value="" class="d-none">
                        <textarea type="text" name="note" class="form-control" placeholder="Enter Your Note" required></textarea>
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
  <!---------Note View Modal----------->
  <div id="NoteViewModal" class="modal fade effect-scale">
        <div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
            <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">View Note</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
             <!-----  Add Form Start------->
              <form action="#" method="post">
                <div class="modal-body ">
                    <!----- Start Add  Form input ------->
                    <div class="col-xl-12">
                        <div class="form-layout form-layout-4">

                        <div class="table-responsive" id="note_table">
                          <table class="table">
                            <thead>
                              <tr>
                                <th class="wd-10p">No.</th>
                                <th class="tx-center">Accounts Title</th>
                                <th class="tx-right">Date</th>
                              </tr>
                            </thead>
                            <tbody id="note_tbody"> </tbody>
                          
                          </table>
                        </div><!-- table-responsive -->

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger tx-size-xs" data-dismiss="modal">Close</button>
                </div>

              </form>
             <!----- End Add Form ------->
        </div>
    </div>
  </div>
<!----- View Invoice Modal ------->
  <div id="invoiceModal" class="modal fade effect-scale">
        <div class="modal-dialog modal-lg modal-dialog-top mt-4" role="document">
            <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
               <button class="btn btn-primary">Print</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <!----- Start Add  Form ------->
        <form action="#">

        <div class="modal-body ">
        <div class="card bd-0 shadow-base">
          <div class="card-body pd-30 pd-md-60">
            <div class="d-md-flex justify-content-between flex-row-reverse">
              <h1 class="mg-b-0 tx-uppercase tx-gray-400 tx-mont tx-bold">Invoice</h1>
              <div class="mg-t-25 mg-md-t-0">
                <h6 class="tx-primary">Pointssoft.com</h6>
                <p class="lh-7">Mohakhali DOSH Road No:1 Office No:435 Dhaka, Bangladesh<br>
                Tel No: 324 445-4544<br>
                Email: admin@pointssoft.com</p>
              </div>
            </div><!-- d-flex -->

            <div class="row mg-t-20">
              <div class="col-md">
                <label class="tx-uppercase tx-13 tx-bold mg-b-20">Billed To</label>
                <h6 class="tx-inverse" id="bill_name">Juan Dela Cruz</h6>
                <p class="lh-7" id="bill_address">4033 Patterson Road, Staten Island, NY 10301</p> 
                <p >Mobile No: <span id="bill_phone_number"></span></p> 
                <p > Email: <span id="bill_email"></span></p>
              </div><!-- col -->
              <div class="col-md" id="invoice_information">
                <label class="tx-uppercase tx-13 tx-bold mg-b-20">Invoice Information</label>
                <p class="d-flex justify-content-between mg-b-5">
                  <span>Invoice No</span>
                  <span>GHT-673-00</span>
                </p>
                <p class="d-flex justify-content-between mg-b-5">
                  <span>Project ID</span>
                  <span>32334300</span>
                </p>
                <p class="d-flex justify-content-between mg-b-5">
                  <span>Issue Date:</span>
                  <span>November 21, 2017</span>
                </p>
                <p class="d-flex justify-content-between mg-b-5">
                  <span>Due Date:</span>
                  <span>November 30, 2017</span>
                </p>
              </div><!-- col -->
            </div><!-- row -->

            <div class="table-responsive mg-t-40" id="invoice_table">
              <table class="table">
                <thead>
                  <tr>
                    <th class="wd-40p">Product Name</th>
                    <th class="tx-center">Quantity</th>
                    <th class="tx-right">Amount</th>
                  </tr>
                </thead>
                <tbody id="invoice_tbody"> </tbody>
                <tfooter id="invoice_tfooter">
                  <tr>
                    <td class="tx-right">Sub-Total</td>
                    <td colspan="3" class="tx-right"><span id="bill_sub_total"></span></td>
                  </tr>
                  <tr>
                    <td class="tx-right">Tax (5%)</td>
                    <td colspan="3"  class="tx-right" id="bill_tax_amount">$287.50</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Delivery Charge</td>
                    <td colspan="3"  class="tx-right" id="bill_delivery_charge">$287.50</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Discount</td>
                    <td colspan="3" class="tx-right" id="bill_discount">-$287.50</td>
                  </tr>
                  <tr>
                    <td class="tx-right tx-uppercase tx-bold tx-inverse">Grand Total</td>
                    <td colspan="3" class="tx-right"><h4 class="tx-teal tx-bold tx-lato" id="bill_grand_total">$287.50</h4></td>
                  </tr>
                </tfooter>
              </table>
            </div><!-- table-responsive -->

          </div><!-- card-body -->
        </div>
        <!-- card-footer start -->
        <!-- card-footer end -->
        </form>
        <!----- End Add Form ------->
        </div>
      </div>
  </div>
<!----- View Invoice Modal ------->
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
        ajax: "{{ route('admin.order.get_all_data') }}",
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
            "data":"fullname"
          },
          {
            "data":"phone_number"
          },
          {
            "data":"sub_total"
          },
          {
            "data":"discount"
          },
          {
            "data":"grand_total"
          },
          {
            "data":"order_status",
            render:function(data,type,row){
              if (row.order_status==0) {
                return '<span class="badge badge-primary">Processing</span>';
              }else if (row.order_status==1){
                return '<span class="badge badge-success">Confirm</span>';
              }else{
                return '<span class="badge badge-danger">Success</span>';
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
              let __common_button=`
              <button class="btn btn-secondary btn-sm mr-3 add-note-btn" data-id="${row.id}">Add Note</button>

              <button class="btn btn-success btn-sm mr-3 note-view-btn" data-id="${row.id}">View Note</button>

              <button class="btn btn-primary btn-sm mr-3 invoice-btn" data-id="${row.id}"><i class="fa fa-eye"></i></button>
              
              <button class="btn btn-danger btn-sm mr-3 delete-btn" data-toggle="modal" data-target="#deleteModal" data-id="${row.id}"><i class="fa fa-trash"></i></button>
              `; 
              if (row.order_status == 0) {
                return `
                <button class="btn btn-success btn-sm mr-3 confirm-btn" data-id="${row.id}">Confirm</button>
                ${__common_button}
              `;
              } 
              if (row.order_status == 1) {
                return `
                <button class="btn btn-primary btn-sm mr-3 restart-btn" data-id="${row.id}">Restart</button>
                 ${__common_button}
              `;
              }
            }
          },
        ],
        order:[
          [0, "desc"]
        ],

      });
      $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    });

  /** Handle Order Confrim button click**/
  $('#datatable1 tbody').on('click', '.confirm-btn', function () {
    var id = $(this).data('id');
    $('#orderConfirmModal').modal('show');
    var value_input = $("input[name*='id']").val(id);
  });
  /** Handle Order Restart button click**/
  $('#datatable1 tbody').on('click', '.restart-btn', function () {
    var id = $(this).data('id');
    $('#orderRestartModal').modal('show');
    var value_input = $("input[name*='id']").val(id);
  });
  /** Handle Delete button click**/
  $('#datatable1 tbody').on('click', '.delete-btn', function () {
    var id = $(this).data('id');
    $('#deleteModal').modal('show');
    var value_input = $("input[name*='id']").val(id);
  });

  /** Handle Add Note button click**/
  $('#datatable1 tbody').on('click', '.add-note-btn', function () {
    var id = $(this).data('id');
    $('#addNoteModal').modal('show');
    var id = $("input[name*='id']").val(id);
  });
    
    /** Handle form submission for delete **/
    $('#addNoteModal form').submit(function(e){
      e.preventDefault();

      var form = $(this);
      var url = form.attr('action');
      var formData = form.serialize();
      /** Use Ajax to send the  request **/
      $.ajax({
        type:'POST',
        'url':url,
        data: formData,
        success: function (response) {
          if (response.success==true) {
            form.trigger('reset');
            $('#addNoteModal').modal('hide');
            toastr.success(response.message);
            $('#datatable1').DataTable().ajax.reload( null , false);
          } 
        },

        error: function (xhr, status, error) {
          /** Handle  errors **/
          toastr.error(xhr.responseText);
        }
      });
    });
    /** Handle View Note button click**/
    $('#datatable1 tbody').on('click', '.note-view-btn', function () {
      var id = $(this).data('id');
      $.ajax({
          type: 'GET',
          url: '/admin/order/get_note/' + id,
            success: function (response) {
              if (response.success==true) {
                $('#NoteViewModal').modal('show');
                var output='';
                var Counter = 1; // Initialize ID counter
                response.data.forEach(function(item){
                  
                  output += '<tr>';
                  output += '<td class="tx-12">' +  Counter++ + '</td>';

                    if (item.note=='Order Created') {
                      output += '<td class="tx-center text-success">' +  item.note + '</td>';
                    }else if(item.note=='Order Cancle'){
                      output += '<td class="tx-center text-danger">' +  item.note + '</td>';
                    }else if(item.note=='Order Processing'){
                      output += '<td class="tx-center text-primary">' +  item.note + '</td>';
                    }else{
                       output += '<td class="tx-center">' +  item.note + '</td>';
                    }
                 
                    
                    // Format the date
                    var formattedDate = new Date(item.created_at);
                    var options = { year: 'numeric', month: 'long', day: 'numeric' };
                    var formattedDateString = formattedDate.toLocaleDateString('en-GB', options);
                    
                    output += '<td class="tx-right">' +  formattedDateString + '</td>';
                    output += '</tr>';
                });
                $("#note_tbody").html(output);
              } else if(response.success==false){
                toastr.error("Error fetching data for edit!");
              }
            },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
      });
    });

    /** Handle view invoice button click**/
    $('#datatable1 tbody').on('click', '.invoice-btn', function () {
      var id = $(this).data('id');
      $.ajax({
          type: 'GET',
          url: '/admin/order/get_order/' + id,
          success: function (response) {
              if (response.success) {
                $('#invoiceModal').modal('show');
                var order=response.data; 
                 $("#bill_name").text(order.first_name +' '+ order.last_name);
                 $("#bill_address").text(order.address);
                 $("#bill_phone_number").text(order.phone_number);
                 $("#bill_email").text(order.email_address);
                 $("#bill_sub_total").text(order.sub_total);
                 $("#bill_discount").text(order.discount);
                 $("#bill_tax_amount").text(order.tax_amount);
                 $("#bill_delivery_charge").text(order.delivery_charge);
                 $("#bill_grand_total").text(order.grand_total);
                 var tbodyHtml='';
                 order.order_details.forEach(function(orderDetail){
                    tbodyHtml += '<tr>';
                    tbodyHtml += '<td class="tx-12">' + __short_title_name(orderDetail.product.title)  + '</td>';
                    tbodyHtml += '<td class="tx-center">' + orderDetail.qty + '</td>';
                    tbodyHtml += '<td class="tx-right">' + orderDetail.product.price + '</td>';
                    tbodyHtml += '</tr>';
                 });
                 $("#invoice_tbody").html(tbodyHtml);



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
          if (response.success==true) {
            toastr.success(response.message);
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
    /** Handle form submission for Order Confirm **/
    $('#orderConfirmModal form').submit(function(e){
      e.preventDefault();

      var form = $(this);
      var url = form.attr('action');
      var formData = form.serialize();
      /** Use Ajax to send the  request **/
      $.ajax({
        type:'POST',
        'url':url,
        data: formData,
        success: function (response) {
          if (response.success==true) { 
            $('#orderConfirmModal').modal('hide');
            toastr.success(response.message);
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
    /** Handle form submission for Order Restart **/
    $('#orderRestartModal form').submit(function(e){
      e.preventDefault();

      var form = $(this);
      var url = form.attr('action');
      var formData = form.serialize();
      /** Use Ajax to send the  request **/
      $.ajax({
        type:'POST',
        'url':url,
        data: formData,
        success: function (response) {
          if (response.success==true) { 
            $('#orderRestartModal').modal('hide');
            toastr.success(response.message);
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

  function __short_title_name(title){
    var max_length=50; 
    if (title.length > max_length) {
      return title.substring(0, max_length - 3) + '...';
    }else{
      return title;
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
  
@endsection
