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
        <h5 class="card-header bg-primary text-white mt-0"><i class="mdi dripicons-user mr-1"></i>  دفاتر العائلة  </h5>
        <div class="card-body">
          <div class="table-responsive mb-0" data-pattern="priority-columns">
            <table id="datatable-buttons" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>رقم الاستمارة</th>
                  <th>الاسم الأول  </th>
                  <th>الكنية  </th>
                  <th>اسم الأب  </th>
                  <th>الرقم الوطني  </th>
                  <th>رقم الدفتر  </th>
                  <th>تاريخ الميلاد  </th>
                  <th> جنس المستفيد  </th>
                  <th>اسم الزوج  </th>
                  <th> تاريخ ميلاد الزوج </th>
                  <th> الحالة الاجتماعية  </th>
                  <th> الاقامة  </th>
                  <th> ملاحظات   </th>
                  <th> العنوان  </th>
                  <th> تفاصيل العنوان  </th>
                  <th> رقم الموبايل  </th>
                  <th> رقم الهاتف </th>

                  <th> اسم الزوجة الأولى  </th>
                  <th> تاريخ الميلاد  </th>
                  <th> اسم الزوجة الثانية  </th>
                  <th> تاريخ الميلاد  </th>
                  <th> اسم الزوجة الثالثة  </th>
                  <th> تاريخ الميلاد  </th>
                  <th> اسم الزوجة الرابعة  </th>
                  <th> تاريخ الميلاد  </th>

                  <th>اسم الولد  الأول  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثاني  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثالث  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الرابع  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الخامس  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  السادس  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  السابع  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثامن  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  التاسع  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  العاشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الحادي عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثاني عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثالث عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الرابع عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الخامس عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  السادس عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  السابع عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  الثامن عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  التاسع عشر  </th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>

                  <th>اسم الولد  العشرون</th>
                  <th>ناريخ الميلاد  </th>
                  <th> العمر بالسنوات  </th>
                  <th> العمر بالأشهر  </th>
                  <th> الجنس   </th>
                  <th> حالة الولد  </th>
                  <th> ملاحظات عن الحالة  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($Family_books as $Family_book)
                  <tr>
                      <td>{{$Family_book->id}}</td>
                      <td>{{$Family_book->id2}}</td>
                      <td>{{$Family_book->first_name}}</td>
                      <td>{{$Family_book->last_name}}</td>
                      <td>{{$Family_book->father_nqme}}</td>
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
                      
                      @foreach ($Family_book->wives as $key => $Wife)
                        <td>{{$Wife->name}}</td>
                        <td>{{$Wife->birth_date}}</td>
                      @endforeach

                      @if($Family_book->wives->count() == 0)
                        @for($i = 1 ; $i < 5 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->wives->count() == 1)
                        @for($i = 1 ; $i < 4 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->wives->count() == 2)
                        @for($i = 1 ; $i < 3 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->wives->count() == 3)
                        <td>{{_('-')}}</td>
                        <td>{{_('-')}}</td>
                      @endif

                      @foreach ($Family_book->childrens as $key => $Child)
                        <td>{{$Child->name}}</td>
                        <td>{{$Child->birth_date}}</td>
                        <td>{{$Child->age_years}}</td>
                        <td>{{$Child->age_month}}</td>
                        <td>{{$Child->gender}}</td>
                        <td>{{$Child->children_statu->status}}</td>
                        <td>{{$Child->status_notes}}</td>
                      @endforeach

                      @if($Family_book->childrens->count() == 0)
                        @for($i = 1 ; $i < 21 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 1)
                        @for($i = 1 ; $i < 20 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 2)
                        @for($i = 1 ; $i < 19 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 3)
                        @for($i = 1 ; $i < 18 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 4)
                        @for($i = 1 ; $i < 17 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 5)
                        @for($i = 1 ; $i < 16 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 6)
                        @for($i = 1 ; $i < 15 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 7)
                        @for($i = 1 ; $i < 14 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 8)
                        @for($i = 1 ; $i < 13 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 9)
                        @for($i = 1 ; $i < 12 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 10)
                        @for($i = 1 ; $i < 11 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 11)
                        @for($i = 1 ; $i < 10 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 12)
                        @for($i = 1 ; $i < 9 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 13)
                        @for($i = 1 ; $i < 8 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 14)
                        @for($i = 1 ; $i < 7 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 15)
                        @for($i = 1 ; $i < 6 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 16)
                        @for($i = 1 ; $i < 5 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 17)
                        @for($i = 1 ; $i < 4 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 18)
                        @for($i = 1 ; $i < 3 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @elseif($Family_book->childrens->count() == 19)
                        @for($i = 1 ; $i < 2 ; $i++)
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                          <td>{{_('-')}}</td>
                        @endfor
                      @endif
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
        $("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","colvis"],"order": [[ 0, "desc" ]]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)")
      });
    </script>
@endsection