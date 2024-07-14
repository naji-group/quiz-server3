@extends('site.layouts.layout')

@section('content')
     <!-- المحتوى الرئيسي -->
     <div class="container-fluid content">
      <div class="row justify-content-center">
        <main role="main" class="col-12 col-lg-10 px-4">
          {{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 class="h2"><span>{{$sitedataCtrlr->gettrans($quiz,'tests')}}</span>/<span>{{ $catquis['tr_title'] }}</span></h2>   
          </div> --}}
          <!-- محتوى الصفحة -->
          <div class="row main-content">




            <!-- تصنيفات -->

            {{-- <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-4 p-1">
              <a href="#" class="category-link">
                <div class="category-card category-card-full">
                  <img src="{{ $catquis['image_path'] }}" alt="{{ $catquis['image_alt'] }}">
                  <div class="category-overlay">
                    <h6>{{ $catquis['tr_title'] }}</h6>
                  </div>          
                </div>         
              </a>
         <div class="category-details">
                    <p>{{Str::of($catquis['tr_content'])->toHtmlString()}}</p>
                  </div>
            </div>       --}}
             <!-- قسم الأسئلة -->
          <div class="row ques-row">
            <div class="col-12 text-center mb-4">
              <form   action ="{{ url($lang,'send') }}" method="POST"  name="send-form"  id="send-form" style="display: none;">
                @csrf
               <input type="hidden" name="cat" value="{{ $catquis['id'] }}">
               <input type="hidden" name="lang" value="{{ $defultlang->id }}">            
              <button id="start-button" class="btn btn-primary start-btn">{{$sitedataCtrlr->gettrans($quiz,'start')}}</button>
              </form>
            </div>

            <div class="col-12 " id="ques-div">
              <div id="question-section" class="question-sec" style="display: none">
                <h3 id="question-text" data="" class="mb-4"></h3>
                <div id="ans-container">   
                <ul id="answers-list" class="list-group ques-group">
                 <li class="list-group-item d-flex align-items-center list-group-item-default" id="1">
                    <span class="answer-indicator"></span>
                    <span class="answer-text"></span>
                  </li>
                  
                
                </ul>
              </div>
              </div>
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
<script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
 
<script src="{{ url('assets/site/js/quiz.js') }}"></script>
 
<script  >
var correct_answer= "{{$sitedataCtrlr->gettrans($quiz,'correct-answer')}}";
var wrong_answer="{{$sitedataCtrlr->gettrans($quiz,'wrong-answer')}}";
var nextlevel_msg="{{$sitedataCtrlr->gettrans($quiz,'nextlevel-msg')}}";
var no_questions="{{$sitedataCtrlr->gettrans($quiz,'no-questions')}}";

var cat={{ $catquis['id'] }};


$(document).ready(function() {
  
   
});
</script>
@endsection
