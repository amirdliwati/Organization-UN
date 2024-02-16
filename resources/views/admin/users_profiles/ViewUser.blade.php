@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} User</title>

    <!-- Default-->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <!-- Sweet Alert-->
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    
@endsection

@section('content')
<!-- Main content -->
<form class="form-horizontal my-4" action="/EditUser/{{$User->id}}" method="POST" autocomplete="on">
  @csrf
<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <h5 class="card-header bg-primary text-white mt-0"><i class="mdi mdi-account-edit-outline mr-1"></i>  تعديل البيانات  </h5>
        <div class="card-body">
          <div class="form-group">
              <label for="name">{{ __(' الاسم الكامل  ') }}</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span>
                  </div>
                  <input id="name" type="text" type="text" placeholder="~name" class="form-control @error('name') is-invalid @enderror mx" name="name" value="{{$User->name}}" maxlength="50" required autocomplete="name" autofocus/>
                  @error('name')
                      <span class="invalid-feedback" role="alert" style="color: red;">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>                                    
          </div>

          <div class="form-group">
              <label for="email">{{ __('الايميل ') }}</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email  font-16"></i></span>
                  </div>
                  <input id="email" type="email" type="text" placeholder="mymail@mail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$User->email}}" required autocomplete="email" autofocus readonly="">
                  @error('email')
                      <span class="invalid-feedback" role="alert" style="color: red;">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>                                    
          </div>

          <div class="form-group">
              <label for="userpassword">{{ __('كلمة السر  ') }}</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-key font-16"></i></span>
                  </div>
                  <input id="password" type="password" placeholder="eg. X8df!90EO" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/> 
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>                                
          </div>

          <div class="form-group">
              <label for="mobile">{{ __(' رقم الموبايل   ') }}</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-cellphone-dock font-16"></i></span>
                  </div>
                  <input id="mobile" type="number" type="text" placeholder="~933066008" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$User->mobile}}" required autocomplete="mobile" autofocus/>
                  @error('mobile')
                      <span class="invalid-feedback" role="alert" style="color: red;">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
              </div>                                    
          </div>

        </div><!-- /.card-body -->
          <div class="card-footer">
              <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"><i class="mdi mdi-content-save-all-outline mr-1"></i>  حفظ  </button>                       
              <a href="/ViewUsers"><button type="button" class="btn btn-warning btn-rounded waves-effect waves-light"><i class="mdi mdi-backup-restore mr-1"></i>  الرجوع لقائمة المستخدمين   </button></a>
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
    <!-- Sweet Alerts js -->
    <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/pages/sweet-alerts.init.js') }}"></script>

    <script type="text/javascript">
      $('.mx').maxlength({warningClass:"badge badge-info",limitReachedClass:"badge badge-warning"});
    </script>

@endsection