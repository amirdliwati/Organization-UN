@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} View Aid</title>
    <!-- Default-->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
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
<form class="form-horizontal my-4" action="/ExportAid" method="POST" autocomplete="on">
  @csrf
  <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <h5 class="card-header bg-info text-white mt-0"><i class="mdi mdi-file-document-outline mr-1"></i>  تصدير المعونات  </h5>
          <div class="card-body">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
              <table id="datatable-buttons" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th> التاريخ   </th>
                    <th> الرقم التسلسي  </th>
                    <th>رقم المعونة  </th>
                    <th> الجهة المسلمة  </th>
                    <th> حذف  </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($Aids as $Aid)
                    <tr>
                        <td>{{$Aid->id}}</td>
                        <td>{{$Aid->date}}</td>
                        <td>{{$Aid->serial_number}}</td>
                        <td>{{$Aid->number}}</td>
                        <td>{{$Aid->employee_name}}</td>
                        <td><button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="Delete('{{$Aid->serial_number}}')"><i class="mdi dripicons-trash mr-2"></i>  حذف  </button></td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div><!-- /.card-body -->
            <div class="card-footer">                      
                <a href="/FamilyBooksAS"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-backup-restore mr-1"></i>  لرجوع لقائمة دفاتر العائلة  </button></a>
            </div> 
        </div><!-- /.card -->
      </div><!-- end col -->
  </div><!-- end row -->
</form>
@endsection
@section('javascript')
    <!-- Default-->
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <!-- form Default init -->
    <script src="{{ asset('js/pages/form-advanced.init.js') }}"></script>

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
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 0, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>

    <script type="text/javascript">
            function Delete(id) {
                swal({
                    title: 'تحذير  ',
                    text: '   هل تريد حذف  المعونة  ؟ ',
                    type: 'warning',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-primary',
                    cancelButtonClass: 'btn btn-danger ml-2',
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> نعم',
                    cancelButtonText: '<i class="fa fa-thumbs-down"></i> لا',
                        preConfirm: function (){
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                swal({title: 'نجاح العملية !',text: 'تم حذف  المعونة  بنجاح  ',type: 'success',
                                        preConfirm: function (){location.reload();}
                                      })

                            }
                        };
                        
                        xmlhttp.open("GET", "{{url('delete-aid')}}?id="+id, true);
                        xmlhttp.send();
                    }
                })
            };
        </script>
@endsection