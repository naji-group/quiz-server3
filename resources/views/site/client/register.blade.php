@extends('site.layouts.layout')
@section('content')
<div class="container-fluid content">
  <div class="row justify-content-center">
    <main role="main" class="col-12 col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{$sitedataCtrlr->gettrans($register,'page-title')}}</h1>
      </div>
      
      <!-- محتوى الصفحة -->
      <div class="row main-content justify-content-center ">
        <div class="col-md-12">
          <div class="card login-card">
            <div class="card-body  bg-style">
              <h3 class="card-title text-center">{{$sitedataCtrlr->gettrans($register,'card-title')}}</h3>
              <form   action ="{{ url($lang,'register') }}" method="POST"  name="register-form"   id="register-form"
              enctype="multipart/form-data">
              @csrf
                <div class="form-group">
                  <label for="name">{{$sitedataCtrlr->gettrans($register,'user-name')}}</label>
                  <input type="text" class="form-control"   id="name" name="name"  placeholder="{{$sitedataCtrlr->gettrans($register,'name-placeholder')}}">
                  <div id="name-error" class="invalid-feedback">اسم المستخدم مطلوب.</div>
                </div>
           <div class="form-group">
                  <label for="email">{{$sitedataCtrlr->gettrans($register,'email')}}</label>
                  <input type="text" class="form-control" id="email"  name="email"  placeholder="{{$sitedataCtrlr->gettrans($register,'email-placeholder')}}">
                  <div  id="email-error" class="invalid-feedback">هذا الحقل مطلوب</div>
                </div>
                <div class="form-group">
                  <label for="password">{{$sitedataCtrlr->gettrans($register,'password')}}</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="{{$sitedataCtrlr->gettrans($register,'password-placeholder')}}">
                  <div  id="password-error" class="invalid-feedback">كلمة المرور مطلوبة.</div>
                </div>
          <div class="form-group">
                  <label for="confirm_password">{{$sitedataCtrlr->gettrans($register,'confirm-password')}}</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{$sitedataCtrlr->gettrans($register,'confirm-password-placeholder')}}">
                  <div id="confirm_password-error"  class="invalid-feedback">هذا الحقل مطلوب</div>
                </div>
            <div class="form-group">
                  <label for="image">{{$sitedataCtrlr->gettrans($register,'image')}}</label>
                  <input type="file" class="form-control" name="image" id="image" placeholder="{{$sitedataCtrlr->gettrans($register,'image-placeholder')}}">
                  <div  id="name-image" class="invalid-feedback">يجب ان يكون الملف صورة</div>
                </div>
        <div class="row">
                              <div class="col-12 mt-2 mb-2">
                                  <label for="" class="policy-form">
                                      <span class="policy">
                                        {{$sitedataCtrlr->gettrans($register,'policy')}}
                                          <a href="#" style="text-decoration:none;">{{$sitedataCtrlr->gettrans($register,'policy-privacy')}}</a>
                                          &
                                          <a href="#" style="text-decoration:none;">{{$sitedataCtrlr->gettrans($register,'policy-conditions')}}</a>
                                      </span>
                                  </label>
                              </div>
                          </div>
                <button type="submit" class="btn btn-primary btn-block btn-submit">{{$sitedataCtrlr->gettrans($register,'sign-up')}}</button>
              </form>
                          <div class="sec">
                              <p>
                                  {{$sitedataCtrlr->gettrans($register,'already-account')}}
                                  <a href="toPageLogin" style="text-decoration:none;">{{$sitedataCtrlr->gettrans($register,'login')}}</a>
                              </p>
                          </div>
          </div>
        </div>
      </div>
   
    </main>
  </div>
</div>
@endsection
@section('js')
<script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/site/js/validate.js') }}"></script>
<script src="{{ url('assets/site/js/register.js') }}"></script>
@endsection
