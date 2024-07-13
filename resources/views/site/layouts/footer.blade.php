  <!-- قائمة سفلية -->
  <div class="fixed-bottom">
    <div class="bottom-nav-container bg-style">
      <nav class="navbar navbar-light">
        <ul class="navbar-nav d-flex flex-row justify-content-between w-100">
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ url($lang,'home') }}"><i class="fas fa-home icon-style"></i><br>{{$sitedataCtrlr->gettrans($f_menu,'home')}}</a>
          </li>
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ url($lang,'scores') }}"><i class="fas fa-cog icon-style"></i><br>{{$sitedataCtrlr->gettrans($f_menu,'scores')}}</a>
          </li>
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ url($lang,'categories') }}"><i class="fas fa-th-list icon-style"></i><br>{{$sitedataCtrlr->gettrans($f_menu,'tests')}}</a>
          </li>
          @if (Auth::guard('client')->check())
          <li class="nav-item text-center flex-fill">
            <a class="nav-link nav-link-pad" href="{{ route('client.account',$lang)  }}"><i class="fas fa-user icon-style"></i><br>{{$sitedataCtrlr->gettrans($f_menu,'profile')}}</a>
          </li>
          @endif
        </ul>
      </nav>
    </div>
  </div>
  
  <!-- Bootstrap core JavaScript و JQuery-->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
 
  
  @yield('js')
   
  </body>
  </html>
  