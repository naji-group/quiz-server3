@extends('site.layouts.layout')

@section('content')
     <!-- المحتوى الرئيسي -->
  <div class="container-fluid content">
    <div class="row justify-content-center">
      <main role="main" class="col-12 col-lg-10 px-4">
        {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">{{$sitedataCtrlr->gettrans($home_page,'tests')}}</h1>
        </div> --}}
        <!-- محتوى الصفحة -->
        <div class="row main-content">
          <!-- تصنيفات -->
          @include('site.content.sub-categories') 
        </div>
      </main>
    </div>
  </div>

@endsection
