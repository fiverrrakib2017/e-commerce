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
          <a class="breadcrumb-item" href="{{route('admin.seller.review.index')}}">Review</a>
          <span class="breadcrumb-item active">All Review</span>
        </nav>
      </div><!-- br-pageheader -->
<div class="br-section-wrapper" style="padding: 0px !important;"> 
  <div class="table-wrapper">
    <div class="card">
      
      <div class="card-body">
      <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="">No.</th>
          <th class="">Seller Name</th>
          <th class="">Photo</th>
          <th class="">Comment</th>
          <th class="">Rating</th>
          <th class="">Status</th>
          <th class="">Create Date</th>
        </tr>
      </thead>
      <tbody>
        @php
            $key=0;
        @endphp
         @foreach ($data as $item)
         <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->seller->fullname }}</td>
                <td>{{ $item->photo}}</td>
                <td>{{ $item->comment}}</td>
                <td>{{ $item->rating}}</td>
                <td>
                    @if ($item->status==1)
                         <span class="badge badge-success">Approved</span>
                    @else
                    <span class="badge badge-danger">Pending</span>
                    @endif
                   
                </td>
                 <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td> 
               
            </tr>
         @endforeach
      </tbody>
    </table>
      </div>
    </div>
    
  </div><!-- table-wrapper -->
</div><!-- br-section-wrapper -->

  

@endsection

@section('script')
    <script src="{{asset('Backend/lib/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-dt/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('Backend/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js')}}"></script>
  <script type="text/javascript">
    $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

       

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
  </script>
  
@endsection
