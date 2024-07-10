@extends('admin.layouts.layout')
@section('breadcrumb')
    معلومات الموقع
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
        <form action="{{ url('admin/setting/updateinfo', [$titlerow->id]) }}" id="title-form" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="exampleFormControlInput1">الاسم</label>
                <input type="text" class="form-controll" name="name" value="{{ $titlerow->value1 }}">
            </div>
            <div class="form-group">
                <button type="submit" id="btn-title" class="btn btn-primary btn-submit">حفظ</button>
            </div>
        </form>

        <div class="card-body  row">
            <div class="col-lg-8">
                <form action="{{ url('admin/setting/updateinfo', [$iconrow->id]) }}" id="icon-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="icon_input">Icon</label>
                        <input type="file" class="form-controll" name="icon_input" id="icon_input">
                    </div>
                      <div class="form-group">
                        <button type="submit" id="btn-icon" class="btn btn-primary btn-submit">حفظ</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <img alt="" id="faviconshow" class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                    src="{{ $favicon }}">
            </div>
        </div>

        <div class="card-body  row">
            <div class="col-lg-8">
                <form action="{{ url('admin/setting/updateinfo', [$logorow->id]) }}" id="logo-form" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="logo_input">شعار الموقع</label>
                        <input type="file" class="form-controll" name="logo_input" id="logo_input">
                    </div>
                     <div class="form-group">
                        <button type="submit" id="btn-logo" class="btn btn-primary btn-submit">حفظ</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <img alt="" id="logoshow" class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                    src="{{ $logo }}">
            </div>
        </div>

        <form action="{{ url('admin/setting/updateinfo', [$facerow->id]) }}" id="face-form" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">حساب الفايسبوك</label>
                <input type="text" class="form-controll" name="face" value="{{ $facerow->value1 }}">
                <label for="name">حساب التويتر</label>
                <input type="text" class="form-controll" name="twitter" value="{{ $twitterrow->value1 }}">
            </div>
            <div class="form-group">
                <button type="submit" id="btn-submit" class="btn btn-primary btn-submit" >حفظ</button>
            </div>
        </form>
    </div>

    </main>


@endsection
@section('js')
    <script src="{{ URL::asset('assets/admin/js/settinginfo.js') }}"></script>
@endsection
