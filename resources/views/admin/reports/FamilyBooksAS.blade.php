@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Family Books</title>
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
        <h5 class="card-header bg-success text-white mt-0"><i class="mdi dripicons-user mr-1"></i>  عرض بيانات المنح و المعونات  </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th> المعونات  </th>
                  <th> المنح  </th>
                  <th>ID</th>
                  <th> رقم الاستمارة  </th>
                  <th>الاسم الأول  </th>
                  <th>الكنية  </th>
                  <th>الرقم الوطني  </th>
                  <th>رقم الدفتر  </th>
                  <th>تاريخ الميلاد  </th>
                  <th> جنس المستفيد  </th>
                  <th>اسم الزوج  </th>
                  <th> تاريخ ميلاد الزوج  </th>
                  <th> الحالة الاجتماعية  </th>
                  <th> الاقامة  </th>
                  <th> ملاحظات   </th>
                  <th> العنوان  </th>
                  <th> تفاصيل العنوان  </th>
                  <th> رقم الموبايل  </th>
                  <th> رقم الهاتف </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Family_books as $Family_book)
                  <tr>
                      <td><a href="/ViewAid/{{$Family_book->id}}"><button type="button" class="btn btn-info btn-rounded waves-effect waves-light"> عرض  </button></a></td>
                      <td><a href="/ViewScholarship/{{$Family_book->id}}"><button type="button" class="btn btn-success btn-rounded waves-effect waves-light"> عرض  </button></a></td>
                      <td>{{$Family_book->id}}</td>
                      <td>{{$Family_book->id2}}</td>
                      <td>{{$Family_book->first_name}}</td>
                      <td>{{$Family_book->last_name}}</td>
                      <td>{{$Family_book->national_id}}</td>
                      <td>{{$Family_book->book_id}}</td>
                      <td>{{$Family_book->birth_date}}</td>
                      <td>{{$Family_book->gender_participant}}</td>
                      <td>{{$Family_book->husband_name}}</td>
                      <td>{{$Family_book->birth_date_husband}}</td>
                      <td>{{$Family_book->marital_statu->status}}</td>
                      <td>{{$Family_book->residence_statu->status}}</td>
                      <td>{{$Family_book->notes}}</td>
                      <td>{{$Family_book->addresse->address}}</td>
                      <td>{{$Family_book->address_details}}</td>
                      <td>{{$Family_book->mobile}}</td>
                      <td>{{$Family_book->phone}}</td>
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
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 2, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>

    <script type="text/javascript">
            function DeleteFB(id) {
                swal({
                    title: 'تحذير  ',
                    text: '   هل تريد حذف دفتر العائلة ؟ ',
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
                                swal({title: 'نجاح العملية !',text: 'تم حذف دفتر العائلة بنجاح  ',type: 'success',
                                        preConfirm: function (){location.reload();}
                                      })

                            }
                        };
                        
                        xmlhttp.open("GET", "{{url('delete-family-book')}}?id_FB="+id, true);
                        xmlhttp.send();
                    }
                })
            };
        </script>
@endsection