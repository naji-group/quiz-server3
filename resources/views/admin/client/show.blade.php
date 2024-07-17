@extends('admin.layouts.layout')
@section('breadcrumb')معلومات العضو @endsection
@section('content')        
        <div class="container">
            @if ($message = Session::get('success'))
                <div class="alert alert-white" role="alert">
                    {{ $message }}
                </div>
            @endif
        </div>
        

        @if (count($errors) > 0)

            <ul>
                @foreach ($errors->all() as $item)
                    <li class="text-danger">
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

        @endif

        <div class="row backgroundW p-4 m-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/client') }}">الاعضاء</a></li>
                    <li class="breadcrumb-item active" aria-current="page">معلومات العضو</li>
                </ol>
            </nav>
            <div class="card-body  row">
                <div class="col-lg-8">
                  {{-- <form class="form-horizontal" name="create_form" method="POST" action="{{route('language.update', $item->id)}}" 
                    enctype="multipart/form-data" id="create_form"> --}}
                    <div class="form-horizontal">
                                                
    
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">الاسم</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->name}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">البريد الالكتروني</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->email}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label"> الجنس</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->gender_conv}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label"> الدولة</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->country_conv}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label"> الرصيد الحالي</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->balance}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">الرصيد الكلي </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->total_balance}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label">تاريخ التسجيل </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-controll" name="name"  
                                   value="{{$client->created_at}}" disabled>
                                <span id="name-error" class="error invalid-feedback"></span>
    
                            </div>
                        </div>
                       
                     
    
                        <div class="form-group row">
                            <div class="col-sm-2 col-form-label"></div>
                            <div class="col-sm-10">
                                 
                               
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
                </div>
                <div class="col-lg-4  sm-3 ">
                    <img alt="" id="imgshow"
                        class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                        src="{{ $client->image_path }}">
                </div>
            </div>
            </div>
        </div>

    </main>


@endsection