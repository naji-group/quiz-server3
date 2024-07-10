@extends('admin.layouts.layout')
@section('breadcrumb')الصفحات الثابتة @endsection
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
                    <li class="breadcrumb-item"><a href="{{url('/admin/page')}}"> الصفحات الثابتة </a></li>
                    
                    <li class="breadcrumb-item active" aria-current="page">تعديل</li>
                </ol>
            </nav>
            <form action="{{ url('admin/page/update', $page->id) }}" id="page-form" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">العنوان</label>
                    <input type="text" class="form-controll" name="title"  value="{{ $page->title }}"  >
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-controll" name="slug"  value="{{ $page->slug }}">
                </div>
                <div class="form-group mb-3">
                  <label for="code">المحتوى</label>
                  <textarea class="form-controll" name="desc">{{ $page->desc }}</textarea>
              </div>      
              
                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">الحالة</label>
                    <div class="col-sm-10 custom-control custom-switch ">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" value="1" @if ($page->status == '1') @checked(true) @endif>
                        <label class="custom-control-label" for="status" id="status_lbl">مفعل</label>
                      
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-submit">تعديل</button>
                </div>
            </form>
        </div>

    </main>
    @endsection
    @section('js')
    <script src="{{ URL::asset('assets/admin/js/settinginfo.js') }}"></script>
@endsection