@extends('admin.layouts.layout')
@section('breadcrumb')مدير جديد@endsection
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
                    <li class="breadcrumb-item active" aria-current="page">جديد</li>
                </ol>
            </nav>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">اسم المدير</label>
                    <input type="text" class="form-controll" name="name"  value="" >
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">البريد الالكتروني</label>
                    <input type="text" class="form-controll" name="email"  value="">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">كلمة المرور الجديدة</label>
                    <input type="password" class="form-controll" name="password">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">تأكيد كلمة المرور</label>
                    <input type="password" class="form-controll" name="confirm_password">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>

    </main>
    @endsection