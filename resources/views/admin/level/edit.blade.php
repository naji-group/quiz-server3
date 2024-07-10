@extends('admin.layouts.layout')
@section('breadcrumb')
    المستويات
@endsection
@section('content')
    <div class="container">

    </div>


      <div class="row backgroundW p-4 m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/level') }}">المستويات</a></li>

                <li class="breadcrumb-item active" aria-current="page">تعديل</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="create_form" method="POST" action="{{route('level.update', $item->id)}}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                   
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">الاسم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="name" id="name"
                                placeholder="* الاسم" value="{{  $item->name }}">

                            <span id="name-error" class="error invalid-feedback"></span>

                        </div>
                    </div>   
                 
                    <div class="form-group row">
                        <label for="value" class="col-sm-2 col-form-label">الرقم</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="value" id="value"
                                placeholder="* الرقم" value="{{  $item->value }}">
                            <span id="value-error" class="error invalid-feedback"></span>
                        </div>
                    </div>   
                    <div class="form-group row">
                        <label for="answers_count" class="col-sm-3 col-form-label">عدد الاجابات الصحيحة</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="answers_count" id="answers_count"
                                placeholder="* عدد الاجابات الصحيحة" value="{{  $item->answers_count }}">
                            <span id="answers_count-error" class="error invalid-feedback"></span>
                        </div>
                    </div>    
                    <div class="form-group row">
                        <label for="points" class="col-sm-2 col-form-label">قيمة الهدية</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="points" id="points"
                                placeholder="* قيمة الهدية" value="{{  $item->points }}">
                            <span id="points-error" class="error invalid-feedback"></span>
                        </div>
                    </div>                       
               
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status"
                            value="{{ $item->status }}" @if ( $item->status=='1') @checked(true) @endif  >
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">
                             
                            <button type="submit" type="submit" name="btn_save" 
                                class="btn btn-primary btn-submit">تعديل</button>
                  
                            <a class="btn btn-danger float-right " href="{{ route('level.index') }}">إلغاء</a>
                            <button id="btn_reset" class="btn btn-default float-right  " style="margin-right: 20px;margin-left: 20px"  >إعادة ضبط</button>
                        
                        </div>
                    </div>
                </form>
            </div>
           
        </div>

        </main>
    @endsection
    @section('js')
        <script src="{{ URL::asset('assets/admin/js/level.js') }}"></script>
    @endsection
