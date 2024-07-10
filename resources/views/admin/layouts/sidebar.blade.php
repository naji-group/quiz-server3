<aside
        class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark"
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="{{route('admin')}}">
                <img src="{{ asset('assets/admin/img/logo-ct.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="me-1 font-weight-bold text-white" style="font-size: 18px;">لوحة التحكم</span>
            </a>
        </div>
        <hr class="horizontal light mt-0 mb-2">
        <div dir="rtl" class="collapse navbar-collapse px-0 w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="{{route('admin')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">format_textdirection_r_to_l</i>
                        </div>
                        <span class="nav-link-text me-1">الرئيسية</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('language.index') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">اللغة</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('categoryques.index') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">التصنيفات</span>
                    </a>
                </li>
                <li class="nav-item" id="nb">
                    <a class="nav-link " href="{{url('admin/categoryques/sort/cats')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">ترتيب التصنيفات</span>
                    </a>
                   
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('level.index') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">المستويات</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('question.index') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الاسئلة</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('social.index')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text me-1">وسائل التواصل</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{url('admin/setting/general')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">view_in_ar</i>
                        </div>
                        <span class="nav-link-text me-1">الاعدادات العامة</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">person</i>
                        </div>
                        <span class="nav-link-text me-1">منطقة الاعلانات</span>
                    </a>
                </li>
              
              
             
               
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('user.index') }}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">المدراء</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('admin')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الاعضاء</span>
                    </a>
                </li>
             
                <li class="nav-item" id="nb">
                    <a class="nav-link " href="{{url('admin/page')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">الصفحات الثابتة</span>
                    </a>
                   
                </li>
                <li class="nav-item" id="nb">
                    <a class="nav-link " href="{{url('admin/page/sort')}}">
                        <div class="text-white text-center ms-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons-round opacity-10">table_view</i>
                        </div>
                        <span class="nav-link-text me-1">ترتيب القوائم  </span>
                    </a>
                   
                </li>
                 
            </ul>
        </div>

    </aside>
