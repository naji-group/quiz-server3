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

                <li class="breadcrumb-item active" aria-current="page">جديد</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="create_form" method="POST" action="{{ url('admin/translate/store') }}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                   
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 col-form-label">النص</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="title" id="title"
                                placeholder="* النص" value="">

                            <span id="title-error" class="error invalid-feedback"></span>

                        </div>
                    </div>   
                    <div class="form-group row">
                        <label for="code" class="col-sm-2 col-form-label">القسم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="code" id="code"
                                placeholder="* القسم" value="">
                            <span id="title-error" class="error invalid-feedback"></span>

                        </div>
                    </div>

                    <input type="hidden" value="{{$category->id}}" name="category_id">              
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                                value="1" checked="checked">
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                             
                            <button type="submit" type="submit" name="btn_save" 
                                class="btn btn-primary btn-submit">إضافة</button>
                  
                            <a class="btn btn-danger float-right " href="{{url('admin/setting/translate')}}">إلغاء</a>
                            <button id="btn_reset" class="btn btn-default float-right  " style="margin-right: 20px;margin-left: 20px"  >إعادة ضبط</button>
                        
                        </div>
                    </div>
                </form>
            </div>
           
        </div>

        </main>
    @endsection
    @section('js')
        <script src="{{ URL::asset('assets/admin/js/trans.js') }}"></script>
    @endsection
