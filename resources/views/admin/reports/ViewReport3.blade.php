@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Visits</title>
    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<!-- Main content -->
<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h5 class="card-header bg-success text-white mt-0"><i class="mdi mdi-file-document-box-search-outline  mr-1"></i>  سجل زيارات   </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Beneficiary Of Code Number</th>
                  <th>Visit Date </th>
                  <th>The Amount Remaining of Fodder(sack 50 k.g)</th>
                  <th>Number of chicken</th>
                  <th>Helth Status</th>
                  <th>Place of breeding chicks</th>
                  <th>The Average Number of Eggs</th>
                  <th>Household</th>
                  <th>Selling</th>
                  <th>Selling Price</th>
                  <th>Quantity Feed</th>
                  <th>The representative's name from Directorate of Agriculture</th>
                  <th>Advise</th>
                  <th>Notes</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Visits as $Visit)
                  <tr>
                      <td>{{$Visit->family_books_id}}</td>
                      <td>{{$Visit->date}}</td>
                      <td>{{$Visit->fodder}}</td>
                      <td>{{$Visit->chicken}}</td>
                      <td>{{$Visit->status}}</td>
                      <td>{{$Visit->breeding}}</td>
                      <td>{{$Visit->eggs}}</td>
                      <td>{{$Visit->household}}</td>
                      <td>{{$Visit->selling}}</td>
                      <td>{{$Visit->selling_price}}</td>
                      <td>{{$Visit->quantity_feed}}</td>
                      <td>{{$Visit->name}}</td>
                      <td>{{$Visit->advise}}</td>
                      <td>{{$Visit->notes}}</td>
                    </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div><!-- /.card-body -->
          <div class="card-footer">                       
              <a href="/"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-backup-restore mr-1"></i>  الرجوع للقائمة الرئيسية  </button></a>
          </div> 
      </div><!-- /.card -->
    </div><!-- end col -->
</div><!-- end row -->
@endsection
@section('javascript')
    <!-- Required datatable js -->
    <script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/pages/sweet-alerts.init.js') }}"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#datatable").DataTable();
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 1, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>
@endsection