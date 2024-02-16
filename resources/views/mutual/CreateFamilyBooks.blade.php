@extends('layouts.app')
@section('css')
    <title>{{ config('app.name') }} Create Family Book</title>
    <!-- Default-->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Main content -->
<form class="form-horizontal my-4" action="/CreateFamilyBooks" method="POST" autocomplete="on">
  @csrf
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <h5 class="card-header bg-info text-white mt-0"><i class="mdi dripicons-user mr-1"></i> ادخال بيانات دفتر عائلة  </h5>
            <div class="card-body">
                <div class="row form-material">
                    <div class="col-md-3">
                        <label for="id2" class="col-form-label text-right"> رقم الأستمارة </label>
                            <input type="number" class="form-control @error('id2') is-invalid @enderror" id="id2" name="id2" value="{{ old('id2') }}" autocomplete="id2" placeholder="0" autofocus required="">
                            @error('id2')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="first_name" class="col-form-label text-right"> اسم المستفيد / ة </label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror mx" id="first_name" name="first_name" value="{{ old('first_name') }}" autocomplete="first_name" placeholder="~" maxlength="25" autofocus required="">
                            @error('first_name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="last_name" class="col-form-label text-right"> كنية المستفيد / ة </label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror mx" id="last_name" name="last_name" value="{{ old('last_name') }}" autocomplete="last_name" placeholder="~" maxlength="25" autofocus required="">
                            @error('last_name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="father_nqme" class="col-form-label text-right"> اسم الأب  المستفيد / ة </label>
                            <input type="text" class="form-control @error('father_nqme') is-invalid @enderror mx" id="father_nqme" name="father_nqme" value="{{ old('father_nqme') }}" autocomplete="father_nqme" placeholder="~" maxlength="25" autofocus required="">
                            @error('father_nqme')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-4">
                        <label for="national_id" class="col-form-label text-right"> الرقم الوطني للمستفيد  / ة </label>
                            <input type="number" class="form-control @error('national_id') is-invalid @enderror" id="national_id" name="national_id" value="{{ old('national_id') }}" autocomplete="national_id" placeholder="~" autofocus required="">
                            @error('national_id')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="book_id" class="col-form-label text-right"> رقم دفتر العائلة  </label>
                            <input type="number" class="form-control @error('book_id') is-invalid @enderror" id="book_id" name="book_id" value="{{ old('book_id') }}" autocomplete="book_id" placeholder="~" autofocus required="">
                            @error('book_id')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="birth_date" class="col-form-label text-right">  تاريخ ميلاد   المستفيد / ة </label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" autocomplete="birth_date"  autofocus required="">
                            @error('birth_date')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-2">
                      <label for="gender_participant" class="col-form-label text-right">  جنس المستفيد   </label>
                        <select class="form-control mb-3 @error('gender_participant') is-invalid @enderror" style="width: 100%; height:36px;" id="gender_participant" name="gender_participant" autocomplete="gender_participant" autofocus required >
                            <option selected="selected" value="ذكر"> ذكر  </option>
                            <option value="أنثى">أنثى</option>
                        </select>
                        @error('gender_participant')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-4">
                      <label for="address_id" class="col-form-label text-right"> اختر العنوان   </label>
                        <select class="select2 form-control mb-3 custom-select @error('address_id') is-invalid @enderror" style="width: 100%; height:36px;" id="address_id" name="address_id" autocomplete="address_id" autofocus required >
                            <option selected="selected" value="">
                                @if( old('address_id') == "" )
                                
                                @endif
                            </option>
                          @foreach($Addresses as $Address)
                            <option value="{{$Address->id}}">{{$Address->address}}</option>
                          @endforeach
                        </select>
                        @error('address_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                    <div class="col-md-8">
                        <label for="address_details" class="col-form-label text-right"> العنوان بالتفصيل  </label>
                            <input type="text" class="form-control @error('address_details') is-invalid @enderror mx" id="address_details" name="address_details" value="{{ old('address_details') }}" autocomplete="address_details" placeholder="~" maxlength="100" autofocus required="">
                            @error('address_details')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-6">
                        <label for="mobile" class="col-form-label text-right"> رقم الموبايل  </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-cellphone-android font-16"></i></span>
                            </div>
                                <input type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}" autocomplete="mobile" placeholder="~" autofocus required=>
                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <label for="phone" class="col-form-label text-right"> رقم الهاتف   </label>
                            <input type="number" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="phone" placeholder="~" autofocus>
                            @error('phone')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-3">
                        <label for="husband_name" class="col-form-label text-right"> اسم الزوج  </label>
                            <input type="text" class="form-control @error('husband_name') is-invalid @enderror mx" id="husband_name" name="husband_name" value="{{ old('husband_name') }}" autocomplete="husband_name" placeholder="~" maxlength="30" autofocus required="">
                            @error('husband_name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                      <label for="marital_status_id" class="col-form-label text-right"> الحالة الاجتماعية  </label>
                        <select class="select2 form-control custom-select mb-3 @error('marital_status_id') is-invalid @enderror" style="width: 100%; height:36px;" id="marital_status_id" name="marital_status_id" autocomplete="marital_status_id" autofocus required >
                            @foreach($Marital_status as $Marital_statu)
                            <option value="{{$Marital_statu->id}}">{{$Marital_statu->status}}</option>
                            @endforeach
                        </select>
                        @error('marital_status_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="birth_date_husband" class="col-form-label text-right"> تاريخ ميلاد الزوج  </label>
                            <input type="date" class="form-control @error('birth_date_husband') is-invalid @enderror" id="birth_date_husband" name="birth_date_husband" value="{{ old('birth_date_husband') }}" autocomplete="birth_date_husband"  autofocus required="">
                            @error('birth_date_husband')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                      <label for="residence_status_id" class="col-form-label text-right">  حالة الاقامة   </label>
                        <select class="select2 form-control custom-select mb-3 @error('residence_status_id') is-invalid @enderror" style="width: 100%; height:36px;" id="residence_status_id" name="residence_status_id" autocomplete="residence_status_id" autofocus required >
                            @foreach($Residence_status as $Residence_statu)
                            <option value="{{$Residence_statu->id}}">{{$Residence_statu->status}}</option>
                            @endforeach
                        </select>
                        @error('residence_status_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-12">
                        <label for="notes" class="col-form-label text-right"> ملاحظات   </label>
                            <input type="text" class="form-control @error('notes') is-invalid @enderror mx" id="notes" name="notes" value="{{ old('notes') }}" autocomplete="notes" placeholder="~" maxlength="100" autofocus required="">
                            @error('notes')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                    <br>
                <div class="row form-material">
                    <div class="col-md-12">
                        <div class="repeater">
                            <div data-repeater-list="wives">
                                <div data-repeater-item class="row">
                                    <div class="col-md-5">
                                        <label for="wife_name" class="col-form-label text-right"> اسم الزوجة   </label>
                                            <input type="text" class="form-control @error('wife_name') is-invalid @enderror mx" id="wife_name" name="wife_name" value="{{ old('wife_name') }}" autocomplete="wife_name" placeholder="~" maxlength="30" autofocus required="">
                                            @error('wife_name')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->

                                    <div class="col-md-4">
                                        <label for="wife_birth_date" class="col-form-label text-right">  تاريخ ميلاد الزوجة  </label>
                                            <input type="date" class="form-control @error('wife_birth_date') is-invalid @enderror" id="wife_birth_date" name="wife_birth_date" value="{{ old('wife_birth_date') }}" autocomplete="wife_birth_date"  autofocus required="">
                                            @error('wife_birth_date')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->

                                    <div class="col-lg-3 align-self-center">
                                        <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="حذف " onclick="fundelwife()">
                                    </div>
                                    <script type="text/javascript">
                                        function fundelwife(){
                                        var x =  document.getElementById("count_wife").value = parseInt( document.getElementById("count_wife").value ) - 1 ;
                                        console.log(document.getElementById("count_wife").value);
                                        if (document.getElementById("count_wife").value < 4)
                                                        {document.getElementById("addwife").style.display = "block";}}
                                    </script>
                                </div>
                                <input type="hidden" id="count_wife" name="count_wife" value="1">
                            </div>
                            <div id="addwife" class="form-group row mb-0">
                                <div class="col-md-3" >
                                    <span data-repeater-create="" class="btn btn-light btn-md" onclick="funaddwife()">
                                        <span class="fa fa-plus"></span> اضافة زوجة  </span>
                                    <script type="text/javascript">
                                        function funaddwife(){
                                          var x =  document.getElementById("count_wife").value = parseInt( document.getElementById("count_wife").value )+ 1 ;
                                            console.log(document.getElementById("count_wife").value);
                                            if (document.getElementById("count_wife").value >= 4)
                                                        {document.getElementById("addwife").style.display = "none";}
                                            }
                                    </script>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                    <br>
                <div class="row form-material">
                    <div class="col-md-12">
                        <div class="repeater">
                            <div data-repeater-list="children">
                                <div data-repeater-item class="row">
                                    <div class="col-md-2">
                                        <label for="childe_name" class="col-form-label text-right"> اسم الولد   </label>
                                            <input type="text" class="form-control @error('childe_name') is-invalid @enderror mx" id="childe_name" name="childe_name" value="{{ old('childe_name') }}" autocomplete="childe_name" placeholder="~" maxlength="30" autofocus required="">
                                            @error('childe_name')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->

                                    <div class="col-md-3">
                                        <label for="childe_birth_date" class="col-form-label text-right"> مواليد الولد  </label>
                                            <input type="date" class="form-control @error('childe_birth_date') is-invalid @enderror" id="childe_birth_date" name="childe_birth_date" value="{{ old('childe_birth_date') }}" autocomplete="childe_birth_date"  autofocus required="">
                                            @error('childe_birth_date')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->

                                    <div class="col-md-2">
                                      <label for="gender" class="col-form-label text-right">  جنس الولد   </label>
                                        <select class="form-control mb-3 @error('gender') is-invalid @enderror" style="width: 100%; height:36px;" id="gender" name="gender" autocomplete="gender" autofocus required >
                                            <option selected="selected" value="ذكر"> ذكر  </option>
                                            <option value="أنثى">أنثى</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> <!-- end col -->

                                    <div class="col-md-2">
                                      <label for="childe_status_id" class="col-form-label text-right">  الحالة  الصحية   </label>
                                        <select class="form-control mb-3 @error('childe_status_id') is-invalid @enderror" style="width: 100%; height:36px;" id="childe_status_id" name="childe_status_id" autocomplete="childe_status_id" autofocus required >
                                            @foreach($Children_status as $Children_statu)
                                            <option value="{{$Children_statu->id}}">{{$Children_statu->status}}</option>
                                            @endforeach
                                        </select>
                                        @error('childe_status_id')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> <!-- end col -->

                                    <div class="col-md-2">
                                        <label for="status_notes" class="col-form-label text-right"> ملاحظات  </label>
                                            <input type="text" class="form-control @error('status_notes') is-invalid @enderror mx" id="status_notes" name="status_notes" value="{{ old('status_notes') }}" autocomplete="status_notes" placeholder="~" maxlength="30" autofocus>
                                            @error('status_notes')
                                              <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                    </div> <!-- end col -->

                                    <div class="col-lg-1 align-self-center">
                                        <input data-repeater-delete type="button" class="btn btn-danger btn-block" value="حذف " onclick="fundelchild()">
                                    </div>
                                    <script type="text/javascript">
                                        function fundelchild(){
                                        var x =  document.getElementById("count_childe").value = parseInt( document.getElementById("count_childe").value ) - 1 ;
                                        console.log(document.getElementById("count_childe").value);
                                        if (document.getElementById("count_childe").value < 20)
                                                        {document.getElementById("addchilde").style.display = "block";}}
                                    </script>
                                </div>
                                <input type="hidden" id="count_childe" name="count_childe" value="1">
                            </div>
                            <div id="addchilde" class="form-group row mb-0">
                                <div class="col-md-3" >
                                    <span data-repeater-create="" class="btn btn-light btn-md" onclick="funaddchild()">
                                        <span class="fa fa-plus"></span> اضافة ولد   </span>
                                    <script type="text/javascript">
                                        function funaddchild(){
                                          var x =  document.getElementById("count_childe").value = parseInt( document.getElementById("count_childe").value )+ 1 ;
                                            console.log(document.getElementById("count_childe").value);
                                            if (document.getElementById("count_childe").value >= 20)
                                                        {document.getElementById("addchilde").style.display = "none";}
                                            }
                                    </script>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div><!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"><i class="mdi mdi-content-save-all-outline mr-1"></i>  حفظ  </button>                        
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

    <!-- form repeater js -->
    <script src="{{ asset('libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

    <!-- form repeater init -->
    <script src="{{ asset('js/pages/form-repeater.init.js') }}"></script>

    <script type="text/javascript">
      $('.mx').maxlength({warningClass:"badge badge-info",limitReachedClass:"badge badge-warning"});
    </script>
@endsection 