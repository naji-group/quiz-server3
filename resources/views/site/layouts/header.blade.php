  <body>

    <!-- قائمة الأعلى -->
    <nav class="navbar navbar-expand-lg navbar-light bg-style">
      <div class="container">
     
        <a  class="navbar-brand"  href="{{ url('/') }}"><img src="{{ $mainarr['logo']}}" width="50px" height="50px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            @if (Auth::guard('client')->check())
            <li  class="nav-item dropdown " >
                <a  class="nav-link dropdown-toggle nav-link-pad" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span> {{$sitedataCtrlr->gettrans($h_menu,'welcome')}} {{ Auth::guard('client')->user()->name }}</span></a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="{{ route('client.account',$lang)  }}">{{$sitedataCtrlr->gettrans($h_menu,'profile')}}</a>
                    <a class="dropdown-item" href="{{ url($lang,'myscore')}}">{{$sitedataCtrlr->gettrans($h_menu,'my-score')}}</a>

                    <form method="POST" action="{{ route('logout.client') }}"  >
                        @csrf
                    <a class="dropdown-item" href="#"  onclick="event.preventDefault();  this.closest('form').submit();">{{$sitedataCtrlr->gettrans($h_menu,'logout')}}</a>
                </form> 
                  </div>
            </li>
              <li class="nav-item  ">
                <a  class="nav-link  nav-link-pad" href="#"> {{$sitedataCtrlr->gettrans($h_menu,'balance')}} <span id="u-balance">{{ Auth::guard('client')->user()->balance }}</span></a>
              </li>
            @else
            <li class="nav-item  ">
                <a class="nav-link  nav-link-pad" href="{{ url($lang,'register') }}">{{$sitedataCtrlr->gettrans($h_menu,'new-account')}}</a>
            </li>
               <li class="nav-item  ">
                <a class="nav-link  nav-link-pad" href="{{ route('login.client',$lang) }}">{{$sitedataCtrlr->gettrans($h_menu,'login')}}</a>
              </li>
            @endif
         
                {{-- start lang--}}
                @if ( $transarr['langs']->count()>1)
                  
             
            <li class="nav-item dropdown ">
              <a class="nav-link dropdown-toggle nav-link-pad" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="selected-lang-img"  width="25" height="20" src="{{$defultlang->image_path}}">
              <span>{{$defultlang->name }}</span><i class="bi bi-chevron-down"></i>
  
              </a>
              <div class="dropdown-menu" aria-labelledby="languageDropdown">
                @foreach ( $transarr['langs']->skip(1) as $langrow )
                @if (isset($catquis)) 
                <a class="dropdown-item" href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),['lang' => $langrow->code,'slug'=>$catquis['slug']])}}">         
                  @elseif (isset($page))
                  <a class="dropdown-item" href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),['lang' => $langrow->code,'slug'=>$page['slug']])}}">                    
                  @else
                  <a class="dropdown-item" href="{{route(\Illuminate\Support\Facades\Route::currentRouteName(),['lang' => $langrow->code])}}">                    
                @endif
                <img  width="25" height="20" src="{{$langrow->image_path}}"><span class="lang-menu-name">{{ $langrow->name }}</span></a>
                @endforeach
              </div>
            </li>
            @endif
           {{-- end lang--}}


          </ul>
        </div>
      </div>
    </nav>
  
