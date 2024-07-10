@extends('admin.layouts.layout')
@section('breadcrumb')
    الاسئلة
@endsection
@section('content')
    <div class="container">

    </div>


    <div class="row backgroundW p-4 m-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">الرئيسية</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/question') }}">الاسئلة</a></li>

                <li class="breadcrumb-item active" aria-current="page">جديد</li>
            </ol>
        </nav>

        <div class="card-body  row">
            <div class="col-lg-12">
                <form class="form-horizontal" name="create_form" method="POST" action="{{ url('admin/question') }}"
                    enctype="multipart/form-data" id="create_form">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">اللغة</label>
                            <select name="lang_id" id="lang_id" class="form-controll">
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر اللغة</option>
@foreach ($lang_list as $lang)
<option value="{{ $lang->id }}">{{ $lang->name }}</option>
@endforeach
                                 


                            </select>
                            <span id="lang_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <label for="name" class="col-sm-2 col-form-label">التصنيف</label>
                            <select name="category_id" id="category_id" class="form-controll">
                                <!--placeholder-->
                                <option title=""value="0" class="text-muted">اختر التصنيف</option>
                                @foreach ($cat_list as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                                                        </select>
                            <span id="category_id-error" class="error invalid-feedback"></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">نص السؤال</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-controll" name="content" id="content"
                                placeholder="* نص السؤال" value="">

                            <span id="content-error" class="error invalid-feedback"></span>

                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6 col-12">
                            <label class="col-12 col-form-label" style="text-align: center">الاجوبة</label>
                        </div>
                        <div class="col-sm-4 col-12">
                            <label class="col-12 col-form-label">الاجابة الصحيحة</label>
                        </div>
                        @php
                            $i=1;
                        @endphp
                    @for ($i=1;$i<6;$i++)                   
                        <div class="col-sm-6 col-12 ans-col">
                            <div class="form-group row">
                                <span class="col-sm-1 col-2">{{ $i }}-</span>
                                <div class="col-sm-11 col-10">
                                    <input type="text" class="form-controll" name="answer_content[{{ $i }}]" id="answer_content-{{  $i }}"
                                           placeholder="* الاجابة {{ $i }}" value="">
                                    <span id="answer_content-{{ $i }}-error" class="error invalid-feedback"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-12 ans-col">
                            <input type="radio" id="is_correct_{{ $i }}" name="is_correct" value="{{  $i }}">
                        </div>

                        @endfor

                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">الحالة</label>
                        <div class="col-sm-10 custom-control custom-switch ">
                            <input type="checkbox" class="custom-control-input" id="status" name="status" value="1"
                                checked="checked">
                            <label class="custom-control-label" for="status" id="status_lbl">الحالة</label>
                            <span id="status-error" class="error invalid-feedback"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2 col-form-label"></div>
                        <div class="col-sm-10">

                            <button type="submit" type="submit" name="btn_save"
                                class="btn btn-primary btn-submit">إضافة</button>

                            <a class="btn btn-danger float-right " href="{{ route('question.index') }}">إلغاء</a>
                            <button id="btn_reset" class="btn btn-default float-right  "
                                style="margin-right: 20px;margin-left: 20px">إعادة ضبط</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>

        </main>
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/content.css') }}">
    @endsection
    @section('js')
        <script src="{{ URL::asset('assets/admin/js/ques.js') }}"></script>
    @endsection
