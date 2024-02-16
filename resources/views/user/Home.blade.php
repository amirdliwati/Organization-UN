@extends('layouts.app')
@section('css')
<title>{{ config('app.name') }} Home</title>
@endsection

@section('content')
<!-- Main content -->
<div class="row">
    <div class="col-lg-12 p-0 d-flex justify-content-center">
        <div class="account-title text-white text-center">
            <img src="{{ asset('images/logo-sm.png') }}" height="260">  
            <h4 class="mt-3" style="color: black">  أهلاً بعودتك من جديد     {{Auth::User()->name}} </h4>
            <h1 class="" style="color: black">  دعنا نبدأ بالعمل الآن  </h1>
        </div>
    </div>
</div><!-- end row --> 
@endsection
@section('javascript')
    <!-- apexcharts -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
@endsection 