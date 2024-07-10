@extends('admin.layouts.layout')
@section('breadcrumb')
     Footer
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
                <li class="breadcrumb-item"><a href="{{url('admin/setting/footer')}}"> Footer</a></li>
                <li class="breadcrumb-item">جديد</li>
            </ol>
        </nav>
        <div class="form-group btn-create  justify-content-end" style="display: flex">
            <a href="{{ url('admin/setting/createfooter') }}" class="btn btn-primary">جديد</a>
        </div>
        @php 
$i=0;
        @endphp
       
        <form action="{{ url('admin/setting/storefooter') }}" id="footer-form" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name">الوصف</label>
                <input type="text" class="form-controll"  name="name" value="">
            </div>
            <div class="form-group mb-3">
                <label for="code">الكود</label>
                <textarea class="form-controll" name="code"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" id="btn" class="btn btn-primary btn-submit">حفظ</button>
            </div>
        </form>
      
    </div>

    </main>
@endsection
@section('js')
    <script src="{{ URL::asset('assets/admin/js/settinginfo.js') }}"></script>
@endsection
