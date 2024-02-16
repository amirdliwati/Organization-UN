@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Edit Scholarship & Aid</title>
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
        <h5 class="card-header bg-info text-white mt-0"><i class="mdi mdi-file-document-outline mr-1"></i>  تعديل  منحة   </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="table-Scholarships" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th> تعديل  </th>
                  <th>التاريخ  </th>
                  <th>رقم المنحة  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Receiving_scholarships as $Receiving_scholarship)
                  <tr>
                      <td><a href="/EditScholarships/{{$Receiving_scholarship->date}}/{{$Receiving_scholarship->number}}"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-update mr-1"></i>  تعديل   </button></a></td>
                      <td>{{$Receiving_scholarship->date}}</td>
                      <td>{{$Receiving_scholarship->number}}</td>
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

<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h5 class="card-header bg-success text-white mt-0"><i class="mdi mdi-file-document-outline mr-1"></i>  تعديل  معونة   </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="table-Aids" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th> تعديل  </th>
                  <th>التاريخ  </th>
                  <th>رقم المعونة  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Receiving_aids as $Receiving_aid)
                  <tr>
                      <td><a href="/EditAid/{{$Receiving_aid->date}}/{{$Receiving_aid->number}}"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-update mr-1"></i>  تعديل   </button></a></td>
                      <td>{{$Receiving_aid->date}}</td>
                      <td>{{$Receiving_aid->number}}</td>
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
        $("#table-Scholarships").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 2, "desc" ]]}).buttons().container().appendTo("#table-Scholarships_wrapper .col-md-6:eq(0)")
        $("#table-Aids").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 2, "desc" ]]}).buttons().container().appendTo("#table-Aids_wrapper .col-md-6:eq(0)")
      });
    </script>
@endsection