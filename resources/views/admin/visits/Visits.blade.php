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
                  <th> حذف  </th>
                  <th>ID</th>
                  <th> رقم المستفيد  </th>
                  <th> اسم المستفيد  </th>
                  <th>تاريخ الزيارة   </th>
                  <th>عدد المشارب   </th>
                  <th>عدد الدجاج  </th>
                  <th>صحة الدجاج  </th>
                  <th> حالة المكان   </th>
                  <th> عدد البيض </th>
                  <th> المنزل  </th>
                  <th> يباع  </th>
                  <th> السعر</th>
                  <th> كمية العلف  </th>
                  <th> اسم الكاشف الميداني   </th>
                  <th> نصائح  </th>
                  <th> ملاحظات  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Visits as $Visit)
                  <tr>
                    <td><button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="DeleteVisit('{{$Visit->id}}')"><i class="mdi dripicons-trash mr-2"></i>  حذف  </button></td>
                      <td>{{$Visit->id}}</td>
                      <td>{{$Visit->family_book->id2}}</td>
                      <td>{{$Visit->family_book->first_name}}{{__(' ')}}{{$Visit->family_book->father_nqme}}{{__(' ')}}{{$Visit->family_book->last_name}}</td>
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

    <script type="text/javascript">
            function DeleteVisit(id) {
                swal({
                    title: 'تحذير  ',
                    text: '   هل تريد حذف الزيارة ؟ ',
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
                                swal({title: 'نجاح العملية !',text: 'تم حذف الزيارة بنجاح  ',type: 'success',
                                        preConfirm: function (){location.reload();}
                                      })

                            }
                        };
                        
                        xmlhttp.open("GET", "{{url('delete-visit')}}?id_visit="+id, true);
                        xmlhttp.send();
                    }
                })
            };
        </script>
@endsection