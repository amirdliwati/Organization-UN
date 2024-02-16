@extends('layouts.app')
@section('css')
    <title>{{ config('app.name') }} Edit Scholarsip</title>
    <!-- Default-->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Main content -->
<form class="form-horizontal my-4" action="/EditScholarships/{{ $Receiving_scholarship->date }}/{{ $Receiving_scholarship->number }}" method="POST" autocomplete="on">
  @csrf
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <h5 class="card-header bg-info text-white mt-0"><i class="mdi mdi-file-document-outline mr-1"></i> تعديل بيانات معونة  </h5>
            <div class="card-body">
                <div class="row form-material">
                    <div class="col-md-6">
                        <label for="date" class="col-form-label text-right"> التاريخ  </label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $Receiving_scholarship->date }}" autocomplete="date"  autofocus required="">
                            @error('date')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <label for="employee_name" class="col-form-label text-right"> اسم أمين المستودع  </label>
                            <input type="text" class="form-control @error('employee_name') is-invalid @enderror mx" id="employee_name" name="employee_name" value="{{ $Receiving_scholarship->employee_name }}" autocomplete="employee_name" placeholder="~" maxlength="100" autofocus required="">
                            @error('employee_name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-12">
                        <div class="repeater">
                            <div data-repeater-list="items">
                            @foreach ($Receiving_scholarship->receiving_scholarship_details as $item_scholarship)
                                <div data-repeater-item class="row">
                                    <div class="col-md-6">
                                        <label for="item" class="col-form-label text-right"> المواد المسلمة  </label>
                                            <input type="text" class="form-control @error('item') is-invalid @enderror mx" id="item" name="item" value="{{ $item_scholarship->item }}" autocomplete="item" placeholder="~" maxlength="100" autofocus required="">
                                            @error('item')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->
                                    <div class="col-md-3">
                                      <label for="measuring_unit_id" class="col-form-label text-right"> الوحدة  </label>
                                        <select class="form-control mb-3 @error('measuring_unit_id') is-invalid @enderror" style="width: 100%; height:36px;" id="measuring_unit_id" name="measuring_unit_id" autocomplete="measuring_unit_id" autofocus required >
                                            <option selected="selected" value="{{$item_scholarship->measuring_unit->id}}">{{$item_scholarship->measuring_unit->name}}</option>
                                            @foreach($Measuring_units as $Measuring_unit)
                                            <option value="{{$Measuring_unit->id}}">{{$Measuring_unit->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('measuring_unit_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> <!-- end col -->
                                    <div class="col-md-2">
                                        <label for="quantity" class="col-form-label text-right"> الكمية  </label>
                                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ $item_scholarship->quantity }}" autocomplete="quantity" placeholder="~" autofocus required="">
                                            @error('quantity')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->
                                    <div class="col-lg-1 align-self-center">
                                        <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="حذف " onclick="fundel()">
                                    </div>
                                </div>
                            @endforeach
                                <script type="text/javascript">
                                    function fundel(){
                                    var x =  document.getElementById("count_item").value = parseInt( document.getElementById("count_item").value ) - 1 ;
                                    console.log(document.getElementById("count_item").value);}
                                </script>
                                <input type="hidden" id="count_item" name="count_item" value="{{ $Receiving_scholarship->receiving_scholarship_details->count() }}">
                            </div>
                            <div id="additem" class="form-group row mb-0">
                                <div class="col-md-3" >
                                    <span data-repeater-create="" class="btn btn-light btn-md" onclick="funaddwife()">
                                        <span class="fa fa-plus"></span> اضافة   </span>
                                    <script type="text/javascript">
                                        function funaddwife(){
                                          var x =  document.getElementById("count_item").value = parseInt( document.getElementById("count_item").value )+ 1 ;
                                            console.log(document.getElementById("count_item").value);}
                                    </script>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"><i class="mdi mdi-content-save-all-outline mr-1"></i>  حفظ  </button>                        
                <a href="/EditScholarshipsAid"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-backup-restore mr-1"></i>  رجوع  </button></a>
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

    <!-- form repeater js -->
    <script src="{{ asset('libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <!-- form repeater init -->
    <script src="{{ asset('js/pages/form-repeater.init.js') }}"></script>

    <script type="text/javascript">
      $('.mx').maxlength({warningClass:"badge badge-info",limitReachedClass:"badge badge-warning"});
    </script>
@endsection 