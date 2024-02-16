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

    <!-- Text Area -->
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Roboto);
            @import url(https://fonts.googleapis.com/css?family=Handlee);

            .paper {position: relative;width: 100%;max-width: 900px;min-width: 400px;height: 200px;margin: 0 auto;background: #fafafa;border-radius: 10px;box-shadow: 0 2px 8px rgba(0,0,0,.3);overflow: hidden;}
            .paper:before {content: '';position: absolute;top: 0; bottom: 0; left: 0;width: 60px;background: radial-gradient(#575450 6px, transparent 7px) repeat-y;background-size: 30px 30px;border-right: 3px solid #D44147;box-sizing: border-box;}

            .paper-content {position: absolute;top: 30px; right: 0; bottom: 30px; left: 60px;background: linear-gradient(transparent, transparent 28px, #91D1D3 28px);background-size: 30px 30px;}

            .paper-content textarea {width: 100%;max-width: 100%;height: 100%;max-height: 100%;line-height: 30px;padding: 0 10px;border: 0;outline: 0;background: transparent;color: mediumblue;font-family: 'Handlee', cursive;font-weight: bold;font-size: 15px;box-sizing: border-box;z-index: 1;}
        </style>
@endsection

@section('content')
<!-- Main content -->
<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h5 class="card-header bg-success text-white mt-0"><i class="mdi dripicons-user mr-1"></i>  تعديل حالة دفاتر العائلة  </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th> مقبول  </th>
                  <th> مرفوض  </th>
                  <th> ايقاف  </th>
                  <th> ملاحظات  </th>
                  <th>ID</th>
                  <th> حالة الدفتر  </th>
                  <th> ملاحظات عن الحالة  </th>
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
                      <td><button type="button" class="btn btn-success btn-rounded waves-effect waves-light" onclick="AcceptFB('{{$Family_book->id}}')">  مقبول </button></td>
                      <td><button type="button" class="btn btn-danger btn-rounded waves-effect waves-light" onclick="RejecttFB('{{$Family_book->id}}')"> مرفوض </button></td>
                      <td><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light" onclick="PauseFB('{{$Family_book->id}}')"> ايقاف </button></td>
                      <td><button type="button" class="btn btn-info btn-rounded waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalNotes{{$Family_book->id}}"> ملاحظات </button></td>
                      <td>{{$Family_book->id}}</td>
                      <td>{{$Family_book->status_from_organization}}</td>
                      <td>{{$Family_book->status_from_organization_notes}}</td>
                      <td>{{$Family_book->first_name}}</td>
                      <td>{{$Family_book->last_name}}</td>
                      <td>{{$Family_book->national_id}}</td>
                      <td>{{$Family_book->book_id}}</td>
                      <td>{{$Family_book->birth_date}}</td>
                      <td>{{$Family_book->gender_participant}}</td>
                      <td>{{$Family_book->husband_name}}</td>
                      <td>{{$Family_book->birth_date_اhusband}}</td>
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
@foreach ($Family_books as $Family_book)
<!-- Large modal Reject -->
<!--  Modal content for the above example -->
<form method="POST" action="/NotesFamilyBook/{{$Family_book->id}}">
    @csrf
    <div class="modal fade bs-example-modal-lg" id="modalNotes{{$Family_book->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">اضافة ملاحظات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">                      
                    <div class="row form-material">
                        <div class="col-md-12">
                            <label for="status_from_organization_notes" class="col-form-label text-right">ملاحظات </label>
                              <div class="paper">
                                  <div class="paper-content">
                                      <textarea type="text" class=" @error('status_from_organization_notes') is-invalid @enderror mx" id="status_from_organization_notes" name="status_from_organization_notes" value="{{ old('status_from_organization_notes') }}" autocomplete="address" placeholder="~ملاحظات" autofocus rows="7" maxlength="2000" data-toggle="tooltip" data-placement="left" title="ملاحظات" required></textarea>
                                      @error('status_from_organization_notes')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                        </span>
                                      @enderror
                                  </div> <!-- paper-content -->
                              </div> <!-- paper -->
                        </div> <!-- end col -->    
                    </div> <!-- end row -->
                </div><!-- end modal-body -->
                    </br>                       
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">حفظ</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
@endforeach 
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
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 4, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>

    <script type="text/javascript">
        function AcceptFB(id) {
            swal({
                title: 'تحذير  ',
                text: '   هل تريد تغيير حالة دفتر العائلة ؟ ',
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
                            swal({title: 'نجاح العملية !',text: 'تم تغيير حالة دفتر العائلة بنجاح  ',type: 'success',
                                    preConfirm: function (){location.reload();}
                                  })

                        }
                    };
                    
                    xmlhttp.open("GET", "{{url('accept-family-book')}}?id_FB="+id, true);
                    xmlhttp.send();
                }
            })
        };
    </script>

    <script type="text/javascript">
        function PauseFB(id) {
            swal({
                title: 'تحذير  ',
                text: '   هل تريد تغيير حالة دفتر العائلة ؟ ',
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
                            swal({title: 'نجاح العملية !',text: 'تم تغيير حالة دفتر العائلة بنجاح  ',type: 'success',
                                    preConfirm: function (){location.reload();}
                                  })

                        }
                    };
                    
                    xmlhttp.open("GET", "{{url('pause-family-book')}}?id_FB="+id, true);
                    xmlhttp.send();
                }
            })
        };
    </script>

    <script type="text/javascript">
        function RejecttFB(id) {
            swal({
                title: 'تحذير  ',
                text: '   هل تريد تغيير حالة دفتر العائلة ؟ ',
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
                            swal({title: 'نجاح العملية !',text: 'تم تغيير حالة دفتر العائلة بنجاح  ',type: 'success',
                                    preConfirm: function (){location.reload();}
                                  })

                        }
                    };
                    
                    xmlhttp.open("GET", "{{url('reject-family-book')}}?id_FB="+id, true);
                    xmlhttp.send();
                }
            })
        };
    </script>
@endsection