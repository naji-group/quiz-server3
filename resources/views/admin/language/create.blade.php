@extends('admin.layouts.layout')
@section('breadcrumb')
    اللغات
@endsection
@section('content')
    <div class="container">
      
    </div>


     

    <div class="row backgroundW p-4 m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/language') }}">اللغات</a></li>

                <li class="breadcrumb-item active" aria-current="page">جديد</li>
            </ol>
        </nav>
     
            <div class="card-body  row">
                <div class="col-lg-8">
        <form class="form-horizontal" name="create_form" method="POST" action="{{ url('admin/language') }}"
            enctype="multipart/form-data" id="create_form">
            @csrf
            <!-- first_name start -->
            <div class="form-group row">
                <label for="code" class="col-sm-2 col-form-label">الرمز</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controll" name="code" id="code" placeholder="* الرمز"
                        value="">

                    <span id="code-error" class="error invalid-feedback"></span>

                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">الاسم</label>
                <div class="col-sm-10">
                    <input type="text" class="form-controll" name="name" id="name" placeholder="* الاسم"
                        value="">
                    <span id="name-error" class="error invalid-feedback"></span>

                </div>
            </div>

            <div class="form-group">
                <!-- <label for="customFile">Custom File</label> -->
                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">الصورة</label>
                    <div class="col-sm-10">

                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" id="image">
                           

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                <div class="col-sm-10 custom-control custom-switch ">
                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1"
                        checked="checked">
                    <label class="custom-control-label" for="status" id="status_lbl">مفعل</label>
               
                </div>
            </div>

            <div class="form-group row">
                <label for="is_default" class="col-sm-2 col-form-label">افتراضي</label>
                <div class="col-sm-10 custom-control custom-switch ">
                    <input type="checkbox" class="custom-control-input" id="is_default" name="is_default">
                    <label class="custom-control-label" for="is_default" id="is_default_lbl">افتراضي</label>
                   
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 col-form-label"></div>
                <div class="col-sm-10">

                    <button type="submit" type="submit" name="btn_save"  
                        class="btn btn-primary btn-submit">إضافة</button>

                    <a class="btn btn-danger float-right " href="{{ route('language.index') }}">إلغاء</a>
                    <button type="button" id="btn_reset" class="btn btn-default float-right  "
                        style="margin-right: 20px;margin-left: 20px">إعادة ضبط</button>

                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-4  sm-3  ">
        <img alt="" id="imgshow"
            class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
            src="{{ URL::asset('assets/admin/img/default/1.jpg') }}">
    </div>
    </div>

    </main>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/admin/js/lang.js') }}"></script>
@endsection
