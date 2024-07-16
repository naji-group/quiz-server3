<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}"/> 
  @foreach ( $mainarr['headerlist'] as $headrow )
  {{ Str::of($headrow['value1'])->toHtmlString()}}    
@endforeach
<link href="{{ $mainarr['favicon']}}" rel="icon">  
<title>
  {{$mainarr['title']}} @yield('page-title')
</title> 
 
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <!-- Custom styles -->
   
  <link rel="stylesheet" href="{{ url('assets/site/css/styles.css') }}" />
  
</head>

<body>
   	    <!-- محتوى الصفحة -->
           <div class="container-fluid content">
            <div class="row justify-content-center">
              <main role="main" class="col-12 col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                  <h1 class="h2">استرجاع كلمة المرور</h1>
                </div>
                
                    <!-- محتوى الصفحة -->
                <div class="row main-content justify-content-center ">
                  <div class="col-md-6">
                    <div class="card login-card">
                      <div class="card-body  bg-style">
                        <h3 class="card-title text-center"></h3>
                        <div class="sec">
                          <p>
                              إعادة تعيين كلمة السر
                           
                          </p>
                          <p>{{ session('status') }}</p>
                          </div>
                        <form   action ="{{  route('client.password.update') }}" method="POST"  name="login-form"   id="login-form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="lang" value="{{ $lang }}">
                          <div class="form-group">
                            <label for="email">{{$sitedataCtrlr->gettrans($login,'email')}}</label>
                            <input type="text" class="form-control" id="email"  name="email" value="{{ request('email') }}" placeholder="{{$sitedataCtrlr->gettrans($login,'email-placeholder')}}">
                            <div  id="email-error" class="invalid-feedback">@if (isset($errors))
                             
                            @endif</div>
                          </div>
                          <div class="form-group">
                            <label for="password">{{ $sitedataCtrlr->gettrans($login, 'password') }}</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="{{ $sitedataCtrlr->gettrans($login, 'password-placeholder') }}">
                            <div id="password-error" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label
                                for="confirm_password">{{ $sitedataCtrlr->gettrans($login, 'confirm-password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="confirm_password"
                                placeholder="{{ $sitedataCtrlr->gettrans($login, 'confirm-password-placeholder') }}">
                            <div id="confirm_password-error" class="invalid-feedback"></div>
                        </div>
                          <button type="submit" class="btn btn-primary btn-block  ">إعادة تعيين</button>
                        </form>
                        <p>                          
                          <a href="{{ route('site.home') }}">عودة للصفحة الرئيسية</a>                                   
                      </p>
                      </div>
                    </div>
                  </div>
                </div>
                 
              </main>
            </div>
          </div>
 
 

 
 <!-- Bootstrap core JavaScript و JQuery-->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
    
    <script src="{{ url('assets/site/js/sweetalert.min.js') }}"></script>
<script src="{{ url('assets/site/js/validate.js') }}"></script>
<script src="{{ url('assets/site/js/login.js') }}"></script>
     
    </body>
    </html>