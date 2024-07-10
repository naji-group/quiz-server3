@extends('admin.layouts.layout')
@section('breadcrumb')
   اعدادات الاسئلة
@endsection
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
                <li class="breadcrumb-item"><a href="{{ url('admin/setting/general') }}">معلومات الموقع</a></li>

            </ol>
        </nav>
        <form action="{{ url('admin/setting/question', [$minpoints->id]) }}" id="minpoints" method="POST"
            enctype="multipart/form-data">
            
            @csrf
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1">الحد الادنى من النقاط لسحب الرصيد</label>
                <input type="text" class="form-controll" name="minpoints" value="{{ $minpoints->value1 }}">
                <span id="minpoints-error" class="error invalid-feedback"></span>
            </div>
            <div class="form-group">
                <button type="submit"  class="btn btn-primary btn-submit">حفظ</button>
            </div>
        </form>

        <form action="{{ url('admin/setting/question', [$pointsrate->id]) }}" id="pointsrate-form" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1">نسبة النقاط الى العملة</label>
                <input type="text" class="form-controll" name="pointsrate" value="{{ $pointsrate->value1 }}">
                <span id="pointsrate-error" class="error invalid-feedback"></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-submit">حفظ</button>
            </div>
        </form>
      
    </div>

    </main>


@endsection
@section('js')
    <script src="{{ URL::asset('assets/admin/js/settinginfo.js') }}"></script>
@endsection
