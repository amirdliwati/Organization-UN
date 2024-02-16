@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Logs</title>
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
        <h5 class="card-header bg-primary text-white mt-0"><i class="mdi mdi-file-document-box-search mr-1"></i>  السجلات   </h5>
        <div class="card-body">
          <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th> الأسم </th>
                            <th> المهمة </th>
                            <th>  رقم العملية   </th>
                            <th>  رمز العملية </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($logs as $log)
                        <tr>
                            <td>{{$log->user->created_at}}</td>
                            <td>{{$log->user->name}}</td>
                            <td>{{$log->title}}</td>
                            <td>{{$log->operating_name}}</td>
                            <td>{{$log->operating_code}}</td>
                        </tr>
                        @endforeach

                        </tbody>
                    </table>
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
        function StatusUser(id) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  swal({title: 'نجاح العملية !',text: ' تم تغييرحالة المستخدم بنجاح  ',type: 'success',})
              }
          };
          
          xmlhttp.open("GET", "{{url('status-user')}}?id_user="+id, true);
          xmlhttp.send();
        };
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $("#datatable").DataTable();
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"],"order": [[ 0, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>
@endsection