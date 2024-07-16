@extends('site.layouts.layout')

@section('content')
     <!-- المحتوى الرئيسي -->
     <div class="container-fluid content">
      <div class="row justify-content-center">
        <main role="main" class="col-12 col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2"> <span>{{ $page['tr_title'] }}</span></h2>   
          </div>
          <!-- محتوى الصفحة -->
          <div class="row main-content">
            <!-- تصنيفات -->

            <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 p-1">
              {{-- <a href="#" class="category-link">
                <div class="category-card category-card-full">
                  <img src="{{ $catquis['image_path'] }}" alt="{{ $catquis['image_alt'] }}">
                  <div class="category-overlay">
                    <h6>{{ $catquis['tr_title'] }}</h6>
                  </div>          
                </div>         
              </a> --}}
         <div class="category-details">
                    <p>{{Str::of($page['tr_content'])->toHtmlString()}}</p>
                  </div>
            </div>      
          
      
          </div>
        </main>
      </div>
    </div>
    <form   action ="{{ url($lang,'checkans') }}" method="POST"  name="check-form"   id="check-form">
      @csrf
       
    </form>
@endsection
@section('js')
 
 
 
<script  >
 

 


$(document).ready(function() {
  
   
});
</script>
@endsection
