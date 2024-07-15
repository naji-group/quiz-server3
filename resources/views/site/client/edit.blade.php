@extends('site.layouts.layout')
@section('content')
    <div class="container-fluid content">
        <div class="row justify-content-center">
            <main role="main" class="col-12 col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">{{$sitedataCtrlr->gettrans($profile,'modify-account')}}</h1>
                </div>

              
    <!--  تغيير كلمة المرور  -->
                <div class="row main-content main-content-sec justify-content-center ">
                    <div class="col-md-12">

                        <div class="card login-card">
                            <div class="card-body  bg-style">
                                <h3 class="card-title text-center">{{$sitedataCtrlr->gettrans($profile,'change-password')}}</h3>
                                <form action ="{{ route('client.updatepass',$lang) }}" method="POST" name="pass-form"
                                    id="pass-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="old_password">{{$sitedataCtrlr->gettrans($profile,'old-password')}}</label>
                                        <input type="password" class="form-control" name="old_password" id="old_password"
                                            placeholder="{{$sitedataCtrlr->gettrans($profile,'old-password-placeholder')}}">
                                        <div id="old_password-error" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{$sitedataCtrlr->gettrans($profile,'new-password')}}</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="{{$sitedataCtrlr->gettrans($profile,'new-password-placeholder')}}">
                                        <div id="password-error" class="invalid-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">{{$sitedataCtrlr->gettrans($profile,'confirm-password')}}</label>
                                        <input type="password" class="form-control" name="confirm_password"
                                            id="confirm_password" placeholder="{{$sitedataCtrlr->gettrans($profile,'confirm-password-placeholder')}}">
                                        <div id="confirm_password-error" class="invalid-feedback"></div>
                                    </div>
                                    <button type="submit" id="btn-pass" class="btn btn-primary btn-block">{{$sitedataCtrlr->gettrans($profile,'change-btn')}}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- المعلومات الشخصية  -->
                <div class="row main-content main-content-sec justify-content-center ">
                    <div class="col-md-12">
                        <div class="card login-card">
                            <div class="card-body  bg-style">
                                <h3 class="card-title text-center">{{$sitedataCtrlr->gettrans($profile,'modify-personal')}}</h3>
                                <form action ="{{ route('client.update',$lang) }}" method="POST" name="update-form"
                                    id="update-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">{{ $sitedataCtrlr->gettrans($profile, 'user-name') }}</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $client->name }}"
                                            placeholder="{{ $sitedataCtrlr->gettrans($profile, 'name-placeholder') }}">
                                        <div id="name-error" class="invalid-feedback"> .</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="country">{{ $sitedataCtrlr->gettrans($profile, 'country') }}</label>
                                        <select style="width:100%;overflow-y: scroll; padding:5px;" class="form-control"
                                            id="country" name="country">

                                        </select>
                                        <div id="country-error" class="invalid-feedback"> .</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">{{ $sitedataCtrlr->gettrans($profile, 'gender') }}</label>

                                        <select style="width:100%;overflow-y: scroll; padding:5px;" class="form-control"
                                            id="gender" name="gender">
                                            <option value="0">{{ $sitedataCtrlr->gettrans($profile, 'choose') }}</option>
                                            <option value="male"
                                                @if ($client->gender == 'male') @selected(true) @endif>{{ $sitedataCtrlr->gettrans($profile, 'male') }}
                                            </option>
                                            <option value="female"
                                                @if ($client->gender == 'female') @selected(true) @endif>{{ $sitedataCtrlr->gettrans($profile, 'female') }}
                                            </option>
                                        </select>

                                        <div id="gender-error" class="invalid-feedback">.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">{{ $sitedataCtrlr->gettrans($profile, 'image') }}</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            placeholder="{{ $sitedataCtrlr->gettrans($profile, 'image-placeholder') }}">
                                        <div id="name-image" class="invalid-feedback">{{ $sitedataCtrlr->gettrans($profile, 'image-message') }}</div>
                                    </div>

                                    <button type="submit" id="btn-update" class="btn btn-primary btn-block">{{ $sitedataCtrlr->gettrans($profile, 'update-btn') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                  <!-- سحب رصيد   -->
                  <div class="row main-content main-content-sec justify-content-center ">
                    <div class="col-md-12">
                        <div class="card login-card">
                            <div class="card-body  bg-style ">
                                <h3 class="card-title text-center">{{ $sitedataCtrlr->gettrans($profile, 'balance') }}</h3>
                                <form action ="{{ url($lang,'pull') }}" method="POST" name="pull-form" style="display: none;"
                                    id="pull-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="points">{{ $sitedataCtrlr->gettrans($profile, 'points') }}</label>
                                        <input type="text" class="form-control" id="points" name="points" value=""
                                            placeholder="{{ $sitedataCtrlr->gettrans($profile, 'points-number') }}">
                                        <div id="points-error" class="invalid-feedback"> .</div>
                                        <div id="pointbalance"><span>{{ $sitedataCtrlr->gettrans($profile, 'your-balance') }}</span><span id="pointbalance-value" ></span><span></span></div>
                                        <div id="coin"  ><span>{{ $sitedataCtrlr->gettrans($profile, 'value') }}</span><span id="coin-value" ></span><span></span></div>
                                    </div> 
                                    <button type="submit" id="btn-pull" class="btn btn-primary btn-block">{{ $sitedataCtrlr->gettrans($profile, 'pull') }}</button>
                                </form>
<p id="balance-msg" class="text-center" style="display: none;">{{ $sitedataCtrlr->gettrans($profile, 'not-enough') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

  <!--  حذف الحساب -->
  <div class="row main-content main-content-sec justify-content-center ">
    <div class="col-md-12">
        <div class="card login-card">
            <div class="card-body  bg-style">
                <h3 class="card-title text-center">{{ $sitedataCtrlr->gettrans($profile, 'delete-account') }}</h3>
                <form action ="{{ url('u/delete') }}" method="POST" name="del-form" id="del-form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="txt-sec ">
                        <span style="color:Red;">{{ $sitedataCtrlr->gettrans($profile, 'warning') }}</span>
                    </div>
                    <button type="submit" id="btn-delete"
                        class="btn btn-primary btn-block btn-delete">{{ $sitedataCtrlr->gettrans($profile, 'delete-btn') }}</button>
                </form>

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
    var countryurl = "{{ URL::asset('assets/site/js/countries/' . $lang . '/countries.json') }}";
    var selcntry = "{{ $client->country }}";
     var urlval = "{{ url('balanceinfo') }}";
    var arrdata;
    var input_required= "{{$sitedataCtrlr->gettrans($profile,'required')}}";
    var input_email= "{{$sitedataCtrlr->gettrans($profile,'input-email')}}";
    var success_msg= "{{$sitedataCtrlr->gettrans($profile,'success-process')}}";
    var fail_msg= "{{$sitedataCtrlr->gettrans($profile,'fail-process')}}";
    var delmsg="{{$sitedataCtrlr->gettrans($profile,'account-deleted')}}";
    var choose_country="{{$sitedataCtrlr->gettrans($profile,'choose-country')}}";
     
</script>
    <script src="{{ URL::asset('assets/site/js/country.js') }}"></script>

    <script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/site/js/validate.js') }}"></script>
    <script src="{{ url('assets/site/js/profile.js') }}"></script>

@endsection
