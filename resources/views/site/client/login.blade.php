@extends('site.layouts.layout')

@section('content')
   	    <!-- محتوى الصفحة -->
           <div class="container-fluid content">
            <div class="row justify-content-center">
              <main role="main" class="col-12 col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">{{$sitedataCtrlr->gettrans($login,'login')}}</h1>
                </div>
                
                    <!-- محتوى الصفحة -->
                <div class="row main-content justify-content-center ">
                  <div class="col-md-6">
                    <div class="card login-card">
                      <div class="card-body  bg-style">
                        <h3 class="card-title text-center">{{$sitedataCtrlr->gettrans($login,'login')}}</h3>
                        <form   action ="{{ url($lang,'login') }}" method="POST"  name="login-form"   id="login-form"
                        enctype="multipart/form-data">
                        @csrf
                          <div class="form-group">
                            <label for="email">{{$sitedataCtrlr->gettrans($login,'email')}}</label>
                            <input type="text" class="form-control" id="email"  name="email"  placeholder="{{$sitedataCtrlr->gettrans($login,'email-placeholder')}}">
                            <div  id="email-error" class="invalid-feedback"></div>
                          </div>
                          <div class="form-group">
                            <label for="password">{{$sitedataCtrlr->gettrans($login,'password')}}</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="{{$sitedataCtrlr->gettrans($login,'password-placeholder')}}">
                            <div  id="password-error" class="invalid-feedback"></div>
                          </div>
                          <button type="submit" class="btn btn-primary btn-block btn-submit">{{$sitedataCtrlr->gettrans($login,'login')}}</button>
                        </form>
                        <div class="sec">
                                    <p>
                                        {{$sitedataCtrlr->gettrans($login,'forgot-password')}}
                                        <a href="{{route('client.password.request')}}">{{$sitedataCtrlr->gettrans($login,'recovery-password')}}</a>
                                    </p>
                                    <p>
                                        {{$sitedataCtrlr->gettrans($login,'no-account')}}
                                        <a href="{{ url($lang,'register') }}">{{$sitedataCtrlr->gettrans($login,'register')}}</a>
                                    </p>
                                    </div>
                      </div>
                    </div>
                  </div>
                </div>
                 
              </main>
            </div>
          </div>
@endsection
@section('js')
<script>
var input_required= "{{$sitedataCtrlr->gettrans($login,'required')}}";
var input_email= "{{$sitedataCtrlr->gettrans($login,'input-email')}}";
var auth_failed= "{{$sitedataCtrlr->gettrans($login,'auth-failed')}}";
var fail_msg= "{{$sitedataCtrlr->gettrans($login,'fail-login')}}";
 var lang="{{ $lang }}";
</script>
<script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/site/js/validate.js') }}"></script>
<script src="{{ url('assets/site/js/login.js') }}"></script>
@endsection
