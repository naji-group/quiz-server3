@extends('admin.layouts.layout')
@section('breadcrumb')تعديل المدير@endsection
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
                    <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                </ol>
            </nav>
            <form action="{{ route('user.update' , $user->id) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">اسم المدير</label>
                    <input type="text" class="form-controll" name="name"  value="{{$user->name}}" disabled>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">بريد الالكتروني</label>
                    <input type="text" class="form-controll" name="email"  value="{{$user->email}}">
                </div>
                <div class="form-group mb-3">
                    <label for="exampleFormControlInput1">كلمة المرور الجديدة</label>
                    <input type="text" class="form-controll" name="password">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>

    </main>


@endsection