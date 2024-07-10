@extends('site.layouts.layout')
 

@section('content')
<section class="section">
    <div class="container">
        <div class="box-main-foo">
    <section class="section-about mb-4 mt-3">
        
       
        <div class="box-about-unviersity p-2">
           

          
            <div class="container main-about-box">
  <!-- Section atRight -->
                <div class="box-serach-about-university p-3 m">
                     
 
                    <div class="mapp">
                        <div class="mapouter">
                           
                                <div class="gmap_canvas">
                                    <h4>{{ Auth::guard('client')->user()->name }}</h4>
                                </div>
                          
                        </div>
                    </div>
                    <hr>
                    <div class="info-more">
                        <p><a href="{{ $client_url['link_client'] }}">{{ $client_url['href_client'] }}</a></p>
                        <h5>لكي تستقبل الرسائل</h5>
                        <div class="box-right d-flex align-items-flex-start flex-column">
                           
                           
                                   
                                        <div class="locationn d-flex">
                                            <i class="fa fa-facebook-f"></i>
                                            <p> شارك حسابك على  
                                                <span> فايسبوك  </span>                                              
                                            </p>
                                        </div>   
                                        

                                
                           
                        </div>
                    </div>
                </div>
                <!-- End Section atRight -->
                <!-- Section atLeft -->
                <div class="background-about mm">
                    {{-- <div class="name-university-underLogo">
                        
                            <h1> حسابي  </h1>
                       

                      
                    </div> --}}
                   
                 
                    <div class="about-detials mb-3 socaill">
                      
                                 <h4 class="mb-4  " style="margin-bottom: 0px"  >حذف الحساب <hr style="margin-bottom: 0px"></h4>
                                 <span id="ctl00_body_Label1" style="color:Red;">ستفقد جميع أنواع المحتوى والبيانات الواردة في هذا الحساب، مثل الرسائل الواردة والصور</span>
                                 <div class="col-md-offset-2 col-md-2" style="margin-bottom: 50px" >
                                 <form action="{{ url('u/delete') }}" method="POST"  name="register-form" class="form-sign"
                                 autocomplete="off" enctype="multipart/form-data">
                                 @csrf
                                  
                                     <button type="submit" name="btn-register" class="theme-btn primary-btn btn-sign w-100">حذف</button>
         
                             </form></div>
 
                                <h4 class="mb-4  " style="margin-bottom: 0px"  >تغيير كلمة المرور<hr style="margin-bottom: 0px"></h4>
                                @if ($errors->any())
                                <ul>                  
                                  @foreach ($errors->all() as $error)
                                  <li class="text-danger">{{ $error }}</li>
                                  @endforeach                     
                              </ul>
                              @endif
                                <form action="{{ route('client.updatepass') }}" method="POST"   name="register-form" class="account-form"
                                autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                 <div class="row  ">         
                                    <div class="row " style="margin-bottom: 10px;">                                       
                                        <label for="old_password" class="col-md-3 control-label">كلمة المرور القديمة</label>
                                        <div class="col-md-9">
                                        <input type="password" class="form-control" name="old_password" id="old_password"  placeholder=""
                                            aria-label="old_password">
                                        </div>
                                    </div>

                                    <div class="row form-group " style="margin-bottom: 10px;">                                
                                        <label for="password" class="col-md-3 control-label">كلمة المرور الجديدة</label>
                                        <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" id="password" placeholder=""
                                            aria-label="password">
                                        </div> 
                                   
                                </div>

                                <div class="row form-group" style="margin-bottom: 10px;">
                                   
                                        <label for="" class="col-md-3 control-label">تأكيد كلمة السر</label>
                                        <div class="col-md-9">
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="" aria-label="confirm_password">
                                     
                                </div>
                                </div>

                                <div class="row form-group" style="margin-bottom: 10px;">
                                   
                                    <label for="" class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" name="btn-register"  class="theme-btn primary-btn btn-sign w-100">تغيير</button>
        
                                 
                            </div>
                            </div>
                              
                                    
                                </div>
                            </form>
                         
                            <h4 class="mb-4  " style="margin-bottom: 0px"  >تعديل المعلومات الشخصية<hr style="margin-bottom: 0px"></h4>
                            
                           {{-- @if ($errors->any() )     --}}
                            {{-- @if ( $errors->hasBag('infoform') )                   --}}
                            <ul id="info-form-error">                  
                              @foreach ( $errors->infoform as $error)
                              <li class="text-danger">{{ $error }}-</li>
                              @endforeach  
                                              
                          </ul>
                          
                         
                       
                            <form action="{{ route('client.update') }}" method="POST"   name="info-form" id="info-form"class="account-form"
                            autocomplete="off" enctype="multipart/form-data">
                            @csrf
                             <div class="row ">
                                 
     
                                <div class="row " style="margin-bottom: 10px;">
                                   
                                    <label for="name" class="col-md-3 control-label">الاسم</label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="" value="{{ $client->name }}"
                                        aria-label="name">
                                    </div>
                                </div>

                                <div class="row form-group " style="margin-bottom: 10px;">                            
                                    <label for="desc" class="col-md-3 control-label">نبذة مختصرة</label>
                                    <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="desc" placeholder="">{{ $client->desc }}</textarea>
                                    </div>
                               
                            </div>
                            <div class="row " style="margin-bottom: 10px;">
                                   
                                <label for="country" class="col-md-3 control-label">الدولة</label>
                                <div class="col-md-9">
                                     
                                    <select style="width:100%;overflow-y: scroll; padding:5px;" class="form-cdontrol" id="country" name="country">
                                       
                                        </select>
                                </div>
                            </div>
                            <div class="row " style="margin-bottom: 10px;">
                                   
                                <label for="gender" class="col-md-3 control-label">الجنس</label>
                                <div class="col-md-9">
                                    <select style="width:100%;overflow-y: scroll; padding:5px;" class="form-cdontrol" id="gender" name="gender">
                                        <option value="">أختر</option>
                                        <option value="male" @if( $client->gender=='male' )@selected(true)@endif>ذكر</option>
                                        <option value="female" @if( $client->gender=='female' )@selected(true)@endif>أنثى</option>
                                        </select>
                            </div>
                        </div>

                        <div class="row " style="margin-bottom: 10px;">                                   
                            <label for="birthdate" class="col-md-3 control-label">تاريخ الميلاد</label>
            
                            <div class="col-md-9">
                                <input type="date" id="birthdate" name="birthdate" class="form-control" style="text-align: right;" min="1900-03" value="{{ $client->birthdateStr }}"  />
                        </div>
                         </div>
                    <div class="row " style="margin-bottom: 10px;">
                                   
                        <label for="name" class="col-md-3 control-label">الصورة الشخصية</label>
                        <div class="col-md-9">
                        <input type="file" class="form-control" name="image"  id="image" 
                            aria-label="name">
                        </div>
                    </div>

                            <div class="row form-group" style="margin-bottom: 10px;">
                               
                                <label for="" class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <button type="submit" name="btn-save-info"  id="btn-save-info"  class="theme-btn primary-btn btn-sign w-100">حفظ</button>
    
                             
                        </div>
                        </div>
                          
                                
                            </div>
                        </form>

                        <h4 class="mb-4  " style="margin-bottom: 0px"  > حسابي على مواقع التواصل الإجتماعي <hr style="margin-bottom: 0px"></h4>
                       <p>روابط التواصل الإجتماعي الخاصة بك ستظهر في حسابك</p>
                        <form action="{{ route('client.updatesocial') }}" method="POST"   name="social-form"  id="social-form" class="account-form"
                        autocomplete="off" enctype="multipart/form-data">
                        @csrf
                         <div class="row">                  
@if(@isset($socials))
    @foreach ($socials as $social)

    <div class="row " style="margin-bottom: 10px;">
                               
        <label for="" class="col-md-3 control-label">{{ $social->name }}</label>
        <div class="col-md-9">
        <input type="text" class="form-control" name="social[{{ $social->id }}]" placeholder=""
         value="@if($social->clientsocials->first()){{ $social->clientsocials->first()->link}} @endif"
            aria-label="{{ $social->code }}">
        </div>
    </div>
    @endforeach
 @endif   
 <div class="row form-group" style="margin-bottom: 10px;">
                           
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-9">
                                <button type="submit" name="btn-social" id="btn-social"  class="theme-btn primary-btn btn-sign w-100">حفظ</button>
                    </div>
                    </div>
                </div>
                    </form>
                </div>
            </div>
            <!-- End Section atLeft -->
            </div>
        </div>
    </section>
</div></div>
</section>
@endsection
@section('css')
<link rel="stylesheet" href="{{ url('assets/site/assets/css/custom.css') }}" />
@endsection
@section('js') 
<script src="{{URL::asset('assets/site/assets/js/country.js')}}"></script>
<script src="{{URL::asset('assets/site/assets/js/account.js')}}"></script>
<script  >   
var countryurl = "{{URL::asset('assets/site/assets/js/countries.json')}}";
var selcntry="{{ $client->country }}";
</script>
@endsection
