@extends('Backend.Layout.App')
@section('title','Dashboard | Admin Panel')
@section('style')
<link href="{{asset('Backend/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="br-pageheader">
   <nav class="breadcrumb pd-0 mg-0 tx-12">
      <a class="breadcrumb-item" href="{{route('admin.dashboard')}}">Dashboard</a>
      <a class="breadcrumb-item" href="{{route('admin.customer.index')}}">Customer</a>
      <a class="breadcrumb-item" href="{{route('admin.customer.invoice.show_invoice')}}">Invoice</a>
      <span class="breadcrumb-item active">View</span>
   </nav>
</div>
<!-- br-pageheader -->
<div class="row">
   <div class="col-md-6 m-auto">
   <div class="card bd-0 shadow-base">
      <div class="card-header">
        <button id="printButton" class="btn-sm btn btn-success">Print</button>
      </div>
          <div class="card-body ">
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
            @foreach ($data as $invoice)
               <div class="col-md">
                  <label class="tx-uppercase tx-13 tx-bold mg-b-20">Billed To</label>
                  <h6 class="tx-inverse">{{ $invoice->customer->fullname }}</h6>
                  <p class="lh-7">{{ $invoice->customer->address }}</p> 
                  <p>Mobile No: <span>{{ $invoice->customer->phone_number }}</span></p> 
                  <p>Email: <span>{{ $invoice->customer->email_address }}</span></p>
               </div>
            @endforeach
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
                <tbody id="invoice_tbody">
                @foreach ($data as $invoice)
                              @foreach ($invoice->items as $item)
                                 <tr>
                                    <td class="tx-12">
                                    @foreach ($product as $productItem)
                                       @if ($productItem->id == $item->product_id)
                                          @php
                                             $title = strlen($productItem->title) > 50 ? substr($productItem->title, 0, 50) . '...' : $productItem->title;
                                          @endphp
                                          {{ $title }}
                                       @endif
                                    @endforeach
                                    </td>
                                    <td class="tx-center">
                                        {{ intval($item->qty) }} 
                                    </td>
                                    <td class="tx-right">
                                        {{  intval($item->price)  }} 
                                    </td>
                                 </tr>
                              @endforeach
                        @endforeach
                </tbody>
                <tfooter id="invoice_tfooter">
                @foreach ($data as $data)
                  <tr>
                    <td class="tx-right">Total Amount</td>
                    <td colspan="3" class="tx-right">{{intval($data -> total_amount)}}</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Paid Amount</td>
                    <td colspan="3"  class="tx-right">{{intval($data -> paid_amount)}}</td>
                  </tr>
                  <tr>
                    <td class="tx-right">Due Amount</td>
                    <td colspan="3" class="tx-right">{{intval($data -> due_amount)}}</td>
                  </tr>
                  <!-- <tr>
                    <td class="tx-right tx-uppercase tx-bold tx-inverse">Grand Total</td>
                    <td colspan="3" class="tx-right"><h4 class="tx-teal tx-bold tx-lato" id="bill_grand_total">$287.50</h4></td>
                  </tr> -->
                  @endforeach
                </tfooter>
              </table>
            </div><!-- table-responsive -->

          </div><!-- card-body -->
        </div>
   </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
   document.getElementById("printButton").addEventListener("click", function() {
        window.print();
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
@if(session("errors"))
<script>
   var errors = @json(session('errors'));
   errors.forEach(function(error) {
     toastr.error(error);
   });
</script>
@endif  
@endsection