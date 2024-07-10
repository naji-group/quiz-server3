@extends('admin.layouts.layout')
@section('breadcrumb')تعديل وسائل التواصل@endsection
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
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{route('social.index')}}">وسائل التواصل</a></li>
                    <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                </ol>
            </nav>
            <form action="{{url('admin/social/update', [$itemsocial->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">الاسم</label>
                    <input type="text" class="form-controll" name="name"  value="{{ $itemsocial->name }}"  >
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">الاسم EN</label>
                    <input type="text" class="form-controll" name="code"  value="{{ $itemsocial->code }}">
                </div>
              
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">كود HTML</label>
                    <input type="text" class="form-controll" name="htmlcode"  value="{{ $itemsocial->htmlcode }}">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">العنوان</label>
                    <input type="text" class="form-controll" name="link"  value="{{ $itemsocial->link }}">
                </div>
                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">الحالة</label>
                    <div class="col-sm-10 custom-control custom-switch ">
                        <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"      @if ($itemsocial->is_active == '1') @checked(true) @endif>
                        <label class="custom-control-label" for="is_active" id="is_active_lbl">مفعل</label>
                      
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
            </form>
        </div>

    </main>


@endsection