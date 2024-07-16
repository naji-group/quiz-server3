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
            <form action="{{ url('admin/page/update', $category->id) }}" id="page-form" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">العنوان</label>
                    <input type="text" class="form-controll" name="title"  value="{{ $category->title }}"  >
                </div>
                <div class="form-group mb-3">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-controll" name="slug"  value="{{ $category->slug }}">
                </div>
                {{-- <div class="form-group mb-3">
                  <label for="code">المحتوى</label>
                  <textarea class="form-controll" name="desc">{{ $category->desc }}</textarea>
              </div>       --}}
              
                <div class="form-group row">
                    <label for="is_active" class="col-sm-2 col-form-label">الحالة</label>
                    <div class="col-sm-10 custom-control custom-switch ">
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" value="1" @if ($category->status == '1') @checked(true) @endif>
                        <label class="custom-control-label" for="status" id="status_lbl">مفعل</label>
                      
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-submit">تعديل</button>
                </div>
            </form>
        </div>
        <hr>
        <div class="card-body  row">
            <!--translation && media -->
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="project-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active nav-link1" id="custom-tabs-one-trans-tab" data-toggle="pill"
                                    href="#custom-tabs-one-trans" role="tab" aria-controls="custom-tabs-one-trans"
                                    aria-selected="true">الترجمة</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link nav-link1" id="custom-tabs-one-media-tab" data-toggle="pill"
                                    href="#custom-tabs-one-media" role="tab" aria-controls="custom-tabs-one-media"
                                    aria-selected="false">الصور</a>
                            </li> --}}

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="project-tabs-one-tabContent">
                            <div class="tab-pane fade show active trans" id="custom-tabs-one-trans" role="tabpanel"
                                aria-labelledby="custom-tabs-one-trans-tab">
                                <p>تعديل الترجمة</p>

                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="trans-tabs-four-tab" role="tablist">

                                            @foreach ($lang_list as $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link  @once active @endonce nav-link2"
                                                        id="lang-{{ $lang->id }}-tab" data-toggle="pill"
                                                        href="#lang-{{ $lang->id }}" role="tab"
                                                        aria-controls="lang-{{ $lang->id }}"
                                                        aria-selected="true">{{ $lang->name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="trans-tabs-four-tabContent">
                                            @foreach ($lang_list as $lang)
                                                <div class="tab-pane fade @once show active @endonce trans2 "
                                                    id="lang-{{ $lang->id }}" role="tabpanel"
                                                    aria-labelledby="lang-{{ $lang->id }}-tab">
                                                    <form class="form-horizontal"
                                                        name="update_trans_form-{{ $lang->id }}" method="POST"
                                                        action="{{ route('langcategory.update', $category->id) }}"
                                                        enctype="multipart/form-data"
                                                        id="update_trans_form-{{ $lang->id }}">
                                                        @csrf

                                                        <div class="form-group row">
                                                            <label for="title_trans"
                                                                class="col-sm-2 col-form-label">الاسم</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-controll"
                                                                    name="title_trans" id="title_trans"
                                                                    placeholder="* الاسم"
                                                                    value="@if ($lang->langposts->first()) {{ $lang->langposts->first()->title_trans }} @endif">

                                                                <span id="title_trans-error"
                                                                    class="error invalid-feedback"></span>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="content_trans"
                                                                class="col-sm-2 col-form-label">الوصف</label>
                                                            <div class="col-sm-10">
                                                                <textarea class="textarea" name="content_trans" id="content_trans" rows="10"
                                                                    placeholder="الوصف"
                                                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if ($lang->langposts->first()){{ $lang->langposts->first()->content_trans }}@endif</textarea>
                                                                <span id="content_trans-error"
                                                                    class="error invalid-feedback"></span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" value="{{ $lang->id }}"
                                                            name="lang_id">

                                                        <div class="form-group row">
                                                            <div class="col-sm-2 col-form-label"></div>
                                                            <div class="col-sm-10">
                                                                <button type="submit" type="submit"
                                                                    name="btn_update_trans-{{ $lang->id }}"
                                                                    id="btn_update_trans-{{ $lang->id }}"
                                                                    class="btn btn-primary btn-submit">حفظ</button>
                                                            </div>
                                                        </div>
                                                    </form>


                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>

                            </div>
                            <!-- /.Media -->
                            {{-- <div class="tab-pane fade trans" id="custom-tabs-one-media" role="tabpanel"
                                aria-labelledby="custom-tabs-one-media-tab">
                                <p>تعديل الصور </p>
                                <div class="card card-primary card-outline card-outline-tabs">
                                    <div class="card-header p-0 border-bottom-0">
                                        <ul class="nav nav-tabs" id="custom-tabs-four-media" role="tablist">

                                            <li class="nav-item ">
                                                <a class="nav-link active" id="custom-tabs-four-images-tab"
                                                    data-toggle="pill" href="#custom-tabs-four-images" role="tab"
                                                    aria-controls="custom-tabs-four-images" aria-selected="true">الصور</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="custom-tabs-four-tabContent">
                                             <!-- image content -->
                                            <div class="tab-pane fade show active" id="custom-tabs-four-images"
                                                role="tabpanel" aria-labelledby="custom-tabs-four-images-tab">
                                                <div class="card-header">
                                                    <h3 class="card-title"></h3>
                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-info btn-sm btn-modal"
                                                            data-toggle="modal" data-target="#modal-newimage"
                                                            id="btn-new-img">
                                                            <i class="fas fa-plus">
                                                            </i>
                                                           جديد
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:20px;" id="image-gallery-content">
                                                    @foreach ($category->mediaposts->where('media_type', 'image') as $itemimage)
                                                        <div class="col-sm-2">
                                                            <div class="image-contain">
                                                                <img src="{{ $itemimage->mediastore->image_path }}"
                                                                    class="img-fluid mb-2 image-show"
                                                                    alt="{{ $itemimage->mediastore->caption }}" />
                                                                <input id="edit-{{ $itemimage->mediastore->id }}"
                                                                    class="btn btn-xs btn-primary update btn-modal" type="button"
                                                                    value="تعديل" data-toggle="modal"
                                                                    data-target="#modal-editimage">
                                                                <input id="del-{{ $itemimage->mediastore->id }}"
                                                                    class="btn btn-xs btn-danger delete btn-modal"
                                                                    type="button" value="حذف" data-toggle="modal"
                                                                    data-target="#modal-delete">

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                    <!-- /.card -->
                                </div>


                            </div> 
                            --}}
                            <!-- /.Media  end-->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </main>
  <!-- /.add image modal -->
  <div class="modal" id="modal-newimage" style="opacity: 1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">اضافة صورة</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <form class="form-horizontal col-sm-12" name="create_image_form" method="POST"
                                action="{{ route('mediapost.store', $category->id) }}"
                                enctype="multipart/form-data" id="create_image_form">
                                @csrf
                                <div class="col-sm-12">
                                    <textarea name="caption" style="width: 100%" id="caption" rows="2" placeholder="الوصف"></textarea>
                                </div>
                                <input type="hidden" value="category" name="dep_name">

                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="images[]" multiple
                                accept="image/x-png,image/gif,image/jpeg,image/jpg,image/svg,image/webp"
                                id="images">
                            <label class="custom-file-label" id="image_label" for="images">اختر صورة</label>
                            <span id="images-error" class="error invalid-feedback"></span>
                            <div style="display: none" class="progress mt-3" style="height: 40px">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 75%; height: 100%">75%</div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <img alt="" id="imgshow"
                            class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                            src="">

                    </div>



                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" id="btn-cancel-modal-create" class="btn btn-default close"
                    data-dismiss="modal">الغاء</button>
                <button type="submit" name="btn_create_image" id="btn_create_image" class="btn btn-primary"
                    form="create_image_form">حفظ</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

 <!-- /.edit image modal -->
<div class="modal" id="modal-editimage"  style="opacity: 1">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">تعديل</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group row">
                        <form class="form-horizontal col-sm-12" name="update_image_form" method="POST"
                            action="{{ route('mediapost.update', 'item_Id') }}" enctype="multipart/form-data"
                            id="update_image_form">
                            @csrf
                            <div class="col-sm-12">
                                <textarea name="caption-edit" style="width: 100%" id="caption-edit" rows="2" placeholder="الوصف"></textarea>
                            </div>
                            <input type="hidden" value="category" name="dep_name">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image"
                            accept="image/x-png,image/gif,image/jpeg,image/jpg,image/svg,image/webp"
                            id="image">
                        <label class="custom-file-label" id="image_label" for="images">اختر صورة</label>
                        <span id="images-error" class="error invalid-feedback"></span>
                        <div style="display: none" class="progress mt-3" style="height: 40px">
                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                style="width: 75%; height: 100%">75%</div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-sm-6">
                    <img alt="" id="imgshow-edit"
                        class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0"
                        src="">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" id="btn-cancel-modal-edit" class="btn btn-default close"
                data-dismiss="modal">الغاء</button>
            <button type="submit" name="btn_update_image" id="btn_update_image" class="btn btn-primary"
                form="update_image_form">تعديل</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<!-- /. delete modal -->
<div class="modal" id="modal-delete" style="opacity: 1">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center" style="padding-bottom: 5px;	padding-top: 30px;">
                <h4 class="modal-title">{{ __('general.Are you sure', [], 'ar') }}</h4>
            </div>
            <div class="modal-footer justify-content-between" style="border-top: 0px solid  ">

                <button class="btn btn-secondary close" id="btn-cancel-modal" data-dismiss="modal"
                    type="button">{{ __('general.cancel', [], 'ar') }}</button>

                <form name="del_image_form" method="POST"
                    action="{{ url('admin/mediastore/destroyimage', 'ItemId') }}" enctype="multipart/form-data"
                    id="del_image_form">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger " id="btn-modal-del"
                        type="button">{{ __('general.delete', [], 'ar') }}</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('assets/admin/css/content.css') }}">

{{-- <link rel="stylesheet"  href="{{ URL::asset('assets/admin/dist/css/adminlte.min.css') }}"> --}}
@endsection
@section('js')
{{-- <script src="{{ URL::asset('assets/admin/dist/js/adminlte.js') }}"></script> --}}
<script>
    var csrtoken = "{{ csrf_token() }}";
    var imgId = 0;
    var delType = '';
    var emptyimg = "{{ URL::asset('assets/admin/img/default/1.jpg') }}";
    var editimgurl = "{{ url('admin/mediastore/getbyid', 'ItemId') }}";
    var delimgurl = "{{ url('admin/mediastore/destroyimage', 'ItemId') }}";
    var galimgurl = "{{ url('admin/mediastore/getcatgallery', $category->id) }}";
    $(function() {
    $('.delete').on('click', function(e) {
        e.preventDefault();
        imgId = $(this).attr("id");
        imgId = imgId.replace("del-", "");
        delType = 'image';
    });
});
</script>
<script src="{{ URL::asset('assets/admin/js/catques.js') }}"></script>
@endsection
