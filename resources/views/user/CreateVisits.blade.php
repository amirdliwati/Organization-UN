@extends('layouts.app')
@section('css')
    <title>{{ config('app.name') }} Create Visits</title>
    <!-- Default-->
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<!-- Main content -->
<form class="form-horizontal my-4" action="/CreateVisit" method="POST" autocomplete="on">
  @csrf
    <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <h5 class="card-header bg-info text-white mt-0"><i class="mdi mdi-file-document-box-plus-outline  mr-1"></i> ادخال بيانات زيارة  </h5>
            <div class="card-body">
                <div class="row form-material">
                    <div class="col-md-8">
                      <label for="family_books_id" class="col-form-label text-right"> Beneficiary Of Name </label>
                        <select class="select2 form-control mb-3 @error('family_books_id') is-invalid @enderror" style="width: 100%; height:36px;" id="family_books_id" name="family_books_id" autocomplete="family_books_id" autofocus required >
                            @foreach($Family_books as $Family_book)
                            <option value="{{$Family_book->id}}">{{$Family_book->first_name}}{{_(' ')}}{{$Family_book->father_nqme}}{{_(' ')}}{{$Family_book->last_name}}</option>
                            @endforeach
                        </select>
                        @error('family_books_id')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-3">
                        <label for="date" class="col-form-label text-right"> Visit Date </label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" autocomplete="date"  autofocus required="">
                            @error('date')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-4">
                        <label for="fodder" class="col-form-label text-right">The Amount Remaining of Fodder(sack 50 k.g)</label>
                            <input type="number" class="form-control @error('fodder') is-invalid @enderror" id="fodder" name="fodder" value="{{ old('fodder') }}" autocomplete="fodder" placeholder="0" autofocus required="">
                            @error('fodder')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-2">
                        <label for="chicken" class="col-form-label text-right">Number of chicken</label>
                            <input type="number" class="form-control @error('chicken') is-invalid @enderror" id="chicken" name="chicken" value="{{ old('chicken') }}" autocomplete="chicken" placeholder="0"  autofocus required="">
                            @error('chicken')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="helth_status" class="col-form-label text-right">Helth Status </label>
                            <select class="form-control mb-3 @error('helth_status') is-invalid @enderror" style="width: 100%; height:36px;" id="helth_status" name="helth_status" autocomplete="helth_status" autofocus required >
                            <option value="good" selected="">good</option>
                            <option value="mediocre">mediocre</option>
                            <option value="bad">bad</option>
                        </select>
                        @error('helth_status')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-3">
                        <label for="breeding" class="col-form-label text-right">Place of breeding chicks </label>
                            <select class="form-control mb-3 @error('breeding') is-invalid @enderror" style="width: 100%; height:36px;" id="breeding" name="breeding" autocomplete="breeding" autofocus required >
                            <option value="good" selected="">good</option>
                            <option value="mediocre">mediocre</option>
                            <option value="bad">bad</option>
                        </select>
                        @error('breeding')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> <!-- end col -->
                    <div class="col-md-3">
                        <label for="eggs" class="col-form-label text-right">The Average Number of Eggs</label>
                            <input type="number" class="form-control @error('eggs') is-invalid @enderror" id="eggs" name="eggs" value="{{ old('eggs') }}" autocomplete="eggs" placeholder="0"  autofocus required="">
                            @error('eggs')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-2">
                        <label for="household" class="col-form-label text-right">Household</label>
                            <input type="text" class="form-control @error('household') is-invalid @enderror mx" id="household" name="household" value="{{ old('household') }}" autocomplete="household" placeholder="~" maxlength="5" autofocus>
                            @error('household')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-2">
                        <label for="selling" class="col-form-label text-right">Selling</label>
                            <input type="text" class="form-control @error('selling') is-invalid @enderror mx" id="selling" name="selling" value="{{ old('selling') }}" autocomplete="selling" placeholder="~" maxlength="5" autofocus>
                            @error('selling')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-2">
                        <label for="selling_price" class="col-form-label text-right">Selling Price</label>
                            <input type="number" step="0.01" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" autocomplete="selling_price" placeholder="0"  autofocus>
                            @error('selling_price')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-4">
                        <label for="quantity_feed" class="col-form-label text-right">Quantity Feed</label>
                            <input type="text" class="form-control @error('quantity_feed') is-invalid @enderror mx" id="quantity_feed" name="quantity_feed" value="{{ old('quantity_feed') }}" autocomplete="quantity_feed" placeholder="~" maxlength="25" autofocus>
                            @error('quantity_feed')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-8">
                        <label for="name" class="col-form-label text-right">The representative's name from Directorate of Agriculture</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror mx" id="name" name="name" value="{{ old('name') }}" autocomplete="name" placeholder="~" maxlength="100" autofocus required="">
                            @error('name')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <div class="row form-material">
                    <div class="col-md-6">
                        <label for="advise" class="col-form-label text-right">Advise</label>
                            <input type="text" class="form-control @error('advise') is-invalid @enderror mx" id="advise" name="advise" value="{{ old('advise') }}" autocomplete="advise" placeholder="~" maxlength="300" autofocus>
                            @error('advise')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <label for="notes" class="col-form-label text-right">Notes</label>
                            <input type="text" class="form-control @error('notes') is-invalid @enderror mx" id="notes" name="notes" value="{{ old('notes') }}" autocomplete="notes" placeholder="~" maxlength="300" autofocus>
                            @error('notes')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
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