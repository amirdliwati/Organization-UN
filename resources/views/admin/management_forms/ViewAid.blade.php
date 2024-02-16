@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Export Aid</title>
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
          <h5 class="card-header bg-success text-white mt-0"><i class="mdi mdi mdi-file-document-box-search-outline mr-1"></i>  بحث في المعونات   </h5>
          <div class="card-body">
            <div class="row form-material">
              <div class="col-md-3">
                <label for="Receiving_aid_id" class="col-form-label text-right"> تاريخ و رقم المعونة  </label>
                  <select class="select2 form-control mb-3 @error('Receiving_aid_id') is-invalid @enderror" style="width: 100%; height:36px;" id="Receiving_aid_id" name="Receiving_aid_id" autocomplete="Receiving_aid_id" autofocus required >
                      @foreach($Receiving_aids as $Receiving_aid)
                      <option value="{{$Receiving_aid->id}}">{{$Receiving_aid->date}}{{_(' -> ')}}{{$Receiving_aid->number}}</option>
                      @endforeach
                  </select>
                  @error('Receiving_aid_id')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div> <!-- end col -->
            </div> <!-- end col -->
          </div><!-- /.card-body --> 
      </div><!-- /.card -->
    </div><!-- end col -->
  </div><!-- end row -->
  <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <h5 class="card-header bg-info text-white mt-0"><i class="mdi mdi-file-document-outline mr-1"></i>  تصدير المعونات  </h5>
          <div class="card-body">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
              <table  class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th> تحديد  </th>
                    <th>ID</th>
                    <th>الاسم الأول  </th>
                    <th>الكنية  </th>
                    <th>الرقم الوطني  </th>
                    <th>رقم الدفتر  </th>
                    <th>تاريخ الميلاد  </th>
                    <th>اسم الزوج  </th>
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
                        <td>
                          <input type="checkbox" id="status{{$Family_book->id}}" name="status{{$Family_book->id}}" switch="bool" checked="">
                          <label for="status{{$Family_book->id}}" data-on-label="نعم" data-off-label="لا"></label>
                        </td>
                        <td>{{$Family_book->id}}</td>
                        <td>{{$Family_book->first_name}}</td>
                        <td>{{$Family_book->last_name}}</td>
                        <td>{{$Family_book->national_id}}</td>
                        <td>{{$Family_book->book_id}}</td>
                        <td>{{$Family_book->birth_date}}</td>
                        <td>{{$Family_book->husband_name}}</td>
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
                <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"><i class="mdi mdi-content-save-all-outline mr-1"></i>  تصدير  </button>                        
                <a href="/"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-backup-restore mr-1"></i>  الرجوع للقائمة الرئيسية  </button></a>
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
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 1, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>
@endsection