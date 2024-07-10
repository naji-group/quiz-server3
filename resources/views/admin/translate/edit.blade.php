@extends('admin.layouts.layout')
@section('breadcrumb')
    الترجمة
@endsection
@section('content')
    <div class="container">

    </div>
    <div class="row backgroundW p-4 m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{url('admin/setting/translate')}}">الترجمة</a></li>

                <li class="breadcrumb-item active" aria-current="page">تعديل</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="create_form" method="POST"
                    action="{{url('admin/translate/update', $post->id) }}" enctype="multipart/form-data"
                    id="create_form">
                    @csrf
  
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">النص</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-controll" name="title" id="title"
                              placeholder="* النص" value="{{ $post->title }}">

                          <span id="title-error" class="error invalid-feedback"></span>

                      </div>
                  </div>   
                  <div class="form-group row">
                      <label for="code" class="col-sm-2 col-form-label">القسم</label>
                      <div class="col-sm-10">
                          <input type="text" class="form-controll" name="code" id="code"
                              placeholder="* القسم" value="{{ $post->code }}">
                          <span id="title-error" class="error invalid-feedback"></span>

                      </div>
                  </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" value="1"
                                @if ($post->status == '1') @checked(true) @endif>
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">

                            <button type="submit" type="submit" name="btn_save"
                                class="btn btn-primary btn-submit">تعديل</button>

                            <a class="btn btn-danger float-right " href="{{url('admin/setting/translate')}}">إلغاء</a>
                            <button id="btn_reset" class="btn btn-default float-right  "
                                style="margin-right: 20px;margin-left: 20px">إعادة ضبط</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
        <hr>
        <div class="card-body  row">
            <!--translation && media -->
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="project-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active nav-link1" id="custom-tabs-one-trans-tab" data-toggle="pill"
                                    href="#custom-tabs-one-trans" role="tab" aria-controls="custom-tabs-one-trans"
                                    aria-selected="true">الترجمة</a>
                            </li>
                           

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="project-tabs-one-tabContent">
                            <div class="tab-pane fade show active trans" id="custom-tabs-one-trans" role="tabpanel"
                                aria-labelledby="custom-tabs-one-trans-tab">
                                <p>تعديل الترجمة</p>

                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="trans-tabs-four-tab" role="tablist">

                                            @foreach ($lang_list as $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link  @once active @endonce nav-link2"
                                                        id="lang-{{ $lang->id }}-tab" data-toggle="pill"
                                                        href="#lang-{{ $lang->id }}" role="tab"
                                                        aria-controls="lang-{{ $lang->id }}"
                                                        aria-selected="true">{{ $lang->name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="trans-tabs-four-tabContent">
                                            @foreach ($lang_list as $lang)
                                                <div class="tab-pane fade @once show active @endonce trans2 "
                                                    id="lang-{{ $lang->id }}" role="tabpanel"
                                                    aria-labelledby="lang-{{ $lang->id }}-tab">
                                                    <form class="form-horizontal"
                                                        name="update_trans_form-{{ $lang->id }}" method="POST"
                                                        action="{{ route('langpost.update', $post->id) }}"
                                                        enctype="multipart/form-data"
                                                        id="update_trans_form-{{ $lang->id }}">
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label for="title_trans"
                                                                class="col-sm-2 col-form-label">الاسم</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-controll"
                                                                    name="title_trans" id="title_trans"
                                                                    placeholder="* الاسم"
                                                                    value="@if ($lang->langposts->first()) {{ $lang->langposts->first()->title_trans }} @endif">

                                                                <span id="title_trans-error"
                                                                    class="error invalid-feedback"></span>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="content_trans"
                                                                class="col-sm-2 col-form-label">الوصف</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="textarea" name="content_trans" id="content_trans" rows="10"
                                                                    placeholder="الوصف"
                                                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if ($lang->langposts->first()){{ $lang->langposts->first()->content_trans }}@endif</textarea>
                                                                <span id="content_trans-error"
                                                                    class="error invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="{{ $lang->id }}"
                                                            name="lang_id">

                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label"></div>
                                                            <div class="col-sm-10">
                                                                <button type="submit" type="submit"
                                                                    name="btn_update_trans-{{ $lang->id }}"
                                                                    id="btn_update_trans-{{ $lang->id }}"
                                                                    class="btn btn-primary btn-submit">حفظ</button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                            </div>
                            <!-- /.Media -->
                           
                            <!-- /.Media  end-->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
        </main>
       
         
    @endsection
    @section('css')
        <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/content.css') }}">
       
        {{-- <link rel="stylesheet"  href="{{ URL::asset('assets/admin/dist/css/adminlte.min.css') }}"> --}}
    @endsection
    @section('js')
        {{-- <script src="{{ URL::asset('assets/admin/dist/js/adminlte.js') }}"></script> --}}
        
          <script src="{{ URL::asset('assets/admin/js/trans.js') }}"></script>
    @endsection
