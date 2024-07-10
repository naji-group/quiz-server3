@extends('admin.layouts.layout')
@section('page-title')
    {{ __('general.sections', [], 'en') }}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a
                                    href= "{{ url('/admin/design/sections', 'main-menu') }}">{{ __('general.sections', [], 'en') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <!-- form start -->
                <div class="card-body  row">
                    <div class="col-lg-12 form-separate">
                        <form class="form-horizontal" name="create_form" method="POST"
                            action="{{ route('category.updatemenu', $item->id) }}" enctype="multipart/form-data"
                            id="create_form">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" @readonly(true) class="form-control" name="title"
                                        id="title" placeholder="* Title" value="{{ $item->title }}">

                                    <span id="title-error" class="error invalid-feedback"></span>

                                </div>
                            </div>

                            <div class="form-group row" style="display: none;">
                                <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " name="slug" id="slug"
                                        placeholder="Slug" value="{{ $item->slug }}">
                                    <span id="slug-error" class="error invalid-feedback"></span>

                                </div>
                            </div>
                            @if( $item->code!='main-banner'&&$item->code!='catalog') 
                            <div class="form-group row">
                                <label for="metakey" class="col-sm-2 col-form-label">Keywords</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="2" name="metakey" id="metakey" placeholder="Keywords">{{ $item->meta_key }}</textarea>
                                    <span id="metakey-error" class="error invalid-feedback"></span>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        value="{{ $item->status }}"
                                        @if ($item->status == '1') @checked(true) @endif>
                                    <label class="custom-control-label" for="status" id="status_lbl">Active</label>
                                    <span id="status-error" class="error invalid-feedback"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2 col-form-label"></div>
                                <div class="col-sm-10">
                                    <button type="submit" type="submit" name="btn_update_user" id="btn_update_user"
                                        class="btn btn-primary">Save</button>

                                    <a class="btn btn-danger float-right "
                                        href="{{ url('/admin/design/sections', 'main-menu') }}">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>

                    <!--translation && media -->
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="project-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-trans-tab" data-toggle="pill"
                                            href="#custom-tabs-one-trans" role="tab"
                                            aria-controls="custom-tabs-one-trans" aria-selected="true">Translation</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-media-tab" data-toggle="pill"
                                            href="#custom-tabs-one-media" role="tab"
                                            aria-controls="custom-tabs-one-media" aria-selected="false">Media</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="project-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-trans" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-trans-tab">
                                        <p>Edit Translation</p>

                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="trans-tabs-four-tab" role="tablist">

                                                    @foreach ($lang_list as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link @once active @endonce"
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
                                                        <div class="tab-pane fade @once show active @endonce "
                                                            id="lang-{{ $lang->id }}" role="tabpanel"
                                                            aria-labelledby="lang-{{ $lang->id }}-tab">
                                                            <form class="form-horizontal"
                                                                name="update_trans_form-{{ $lang->id }}"
                                                                method="POST"
                                                                action="{{ route('langcategory.update', $item->id) }}"
                                                                enctype="multipart/form-data"
                                                                id="update_trans_form-{{ $lang->id }}">
                                                                @csrf

                                                                <div class="form-group row">
                                                                    <label for="title_trans"
                                                                        class="col-sm-2 col-form-label">Title</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control"
                                                                            name="title_trans" id="title_trans"
                                                                            placeholder="* Title"
                                                                            value="@if ($lang->langposts->first()) {{ $lang->langposts->first()->title_trans }} @endif">

                                                                        <span id="title_trans-error"
                                                                            class="error invalid-feedback"></span>

                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <label for="content_trans"
                                                                        class="col-sm-2 col-form-label">Content</label>
                                                                    <div class="col-sm-10">
                                                                        <textarea class="textarea" name="content_trans" id="content_trans" rows="10"
                                                                            placeholder="Place the translation here"
                                                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
@if ($lang->langposts->first())
{{ $lang->langposts->first()->content_trans }}
@endif
</textarea>
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
                                                                            class="btn btn-primary btn_update_trans">Save</button>
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
                                    <div class="tab-pane fade" id="custom-tabs-one-media" role="tabpanel"
                                        aria-labelledby="custom-tabs-one-media-tab">
                                        <p>Edit Media</p>
                                        <div class="card card-primary card-outline card-outline-tabs">
                                            <div class="card-header p-0 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-four-media" role="tablist">
                                                    @if ($item->code == 'catalog')
                                                        <li class="nav-item ">
                                                            <a class="nav-link  active" id="custom-tabs-four-pdf-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-pdf"
                                                                role="tab" aria-controls="custom-tabs-four-pdf"
                                                                aria-selected="true">PDF</a>
                                                        </li>
                                                    @else
                                                        <li class="nav-item ">
                                                            <a class="nav-link active" id="custom-tabs-four-images-tab"
                                                                data-toggle="pill" href="#custom-tabs-four-images"
                                                                role="tab" aria-controls="custom-tabs-four-images"
                                                                aria-selected="true">Images</a>
                                                        </li>
                                                    @endif
                                                    @if ($item->code == 'main-banner')
                                                    <!-- /.Video-->
                                                    <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-video-tab" data-toggle="pill" href="#custom-tabs-four-video" role="tab" aria-controls="custom-tabs-four-video" aria-selected="false">Video</a>
                                  </li>                                   
                                  @endif

                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                                  <div class="tab-pane fade @if ($item->code == 'catalog') show active @endif" id="custom-tabs-four-pdf"
                                                  role="tabpanel" aria-labelledby="custom-tabs-four-pdf-tab">

                                                  <div class="card-header">
                                                      <h3 class="card-title"></h3>
                                                      <div class="card-tools">

                                                          <button type="button" class="btn btn-info btn-sm"
                                                              data-toggle="modal" data-target="#modal-newpdf"
                                                              id="btn-new-pdf">
                                                              <i class="fas fa-plus">
                                                              </i>
                                                              New
                                                          </button>


                                                      </div>
                                                  </div>
                                                  <div class="row" style="margin-top:20px;"
                                                      id="pdf-gallery-content">
                                                      @foreach ($item->mediaposts->where('media_type', 'pdf') as $itemimage)
                                                          <div class="col-sm-2">
                                                              <div class="image-contain">
                                                                  <img src="{{URL::asset('assets/admin/img/default/pdf-icon.png')}}"
                                                                      class="img-fluid mb-2 image-show"
                                                                      alt="{{ $itemimage->mediastore->caption }}" />
                                                                  <input id="edit-{{ $itemimage->mediastore->id }}"
                                                                      class="btn btn-xs btn-primary update-pdf "
                                                                      type="button" value="Edit"
                                                                      data-toggle="modal"
                                                                      data-target="#modal-editpdf">
                                                                  <input id="del-{{ $itemimage->mediastore->id }}"
                                                                      class="btn btn-xs btn-danger delete-pdf"
                                                                      type="button" value="Delete"
                                                                      data-toggle="modal"
                                                                      data-target="#modal-delete">

                                                              </div>
                                                          </div>
                                                      @endforeach
                                                  </div>
                                              </div>
{{-- image content --}}
                                                    <div class="tab-pane fade  @if ($item->code != 'catalog') show active @endif " id="custom-tabs-four-images"
                                                        role="tabpanel" aria-labelledby="custom-tabs-four-images-tab">

                                                        <div class="card-header">
                                                            <h3 class="card-title"></h3>
                                                            <div class="card-tools">

                                                                <button type="button" class="btn btn-info btn-sm"
                                                                    data-toggle="modal" data-target="#modal-newimage"
                                                                    id="btn-new-img">
                                                                    <i class="fas fa-plus">
                                                                    </i>
                                                                    New
                                                                </button>


                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top:20px;"
                                                            id="image-gallery-content">
                                                            @foreach ($item->mediaposts->where('media_type', 'image') as $itemimage)
                                                                <div class="col-sm-2">
                                                                    <div class="image-contain">
                                                                        <img src="{{ $itemimage->mediastore->image_path }}"
                                                                            class="img-fluid mb-2 image-show"
                                                                            alt="{{ $itemimage->mediastore->caption }}" />
                                                                        <input id="edit-{{ $itemimage->mediastore->id }}"
                                                                            class="btn btn-xs btn-primary update "
                                                                            type="button" value="Edit"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-editimage">
                                                                        <input id="del-{{ $itemimage->mediastore->id }}"
                                                                            class="btn btn-xs btn-danger delete "
                                                                            type="button" value="Delete"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-delete">

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- Video modal  content-->
                                                     <div class="tab-pane fade" id="custom-tabs-four-video" role="tabpanel" aria-labelledby="custom-tabs-four-video-tab">
                                     <!-- Video -->
                                    <div class="card-header">
                                      <h3 class="card-title"></h3>                            
                                      <div class="card-tools">                                   
                                                      <button type="button"  class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-newvid" id="btn-new-vid">
                                                        <i class="fas fa-plus">
                                                        </i>
                                                       New
                                                      </button>                                     
                                      </div>
                                    </div>
                                    <div class="row" style="margin-top:20px;" id="video-gallery-content">
                                      @foreach ($item->mediaposts->where('media_type', 'video') as $itemimage)
                                      <div class="col-sm-2">
                                        <div  class="image-contain" >
                                        
                                          <video controls  class="img-fluid mb-2 image-show" alt="{{ $itemimage->mediastore->caption }}"  ><source src="{{$itemimage->mediastore->image_path }}" > </video>
                                          <input id="edit-{{$itemimage->mediastore->id }}" class="btn btn-xs btn-primary update-video " type="button" value="Edit" data-toggle="modal" data-target="#modal-edit-video">
                                          <input id="del-{{$itemimage->mediastore->id }}" class="btn btn-xs btn-danger delete-video " type="button" value="Delete" data-toggle="modal" data-target="#modal-delete">
                                      
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
                                    <!-- /.Media  end-->
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>

                </div>
            </div>
            <!-- first_name end -->
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer -->

    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- /.card -->
    <!-- /.add image modal -->
    <div class="modal fade" id="modal-newimage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <form class="form-horizontal col-sm-12" name="create_image_form" method="POST"
                                    action="{{ route('mediapost.store', $item->id) }}" enctype="multipart/form-data"
                                    id="create_image_form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <textarea name="caption" style="width: 100%" id="caption" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">

                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="images[]" multiple
                                    accept="image/x-png,image/gif,image/jpeg,image/jpg,image/svg,image/webp"
                                    id="images">
                                <label class="custom-file-label" id="image_label" for="images">Choose file</label>
                                <span id="images-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
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
                                src="{{ URL::asset('assets/admin/img/default/1.jpg') }}">

                        </div>



                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-modal-create" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_create_image" id="btn_create_image" class="btn btn-primary"
                        form="create_image_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.end add image modal -->

    <!-- /.edit image modal -->
    <div class="modal fade" id="modal-editimage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit image</h4>
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
                                        <textarea name="caption-edit" style="width: 100%" id="caption-edit" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"
                                    accept="image/x-png,image/gif,image/jpeg,image/jpg,image/svg,image/webp"
                                    id="image">
                                <label class="custom-file-label" id="image_label" for="images">Choose file</label>
                                <span id="images-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
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
                                src="{{ URL::asset('assets/admin/img/default/1.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-modal-edit" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_update_image" id="btn_update_image" class="btn btn-primary"
                        form="update_image_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.end edit  image modal -->
    <!-- /. delete modal -->
    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog  modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center" style="padding-bottom: 5px;	padding-top: 30px;">
                    <h4 class="modal-title">{{ __('general.Are you sure', [], 'en') }}</h4>
                </div>
                <div class="modal-footer justify-content-between" style="border-top: 0px solid  ">

                    <button class="btn ripple btn-secondary" id="btn-cancel-modal" data-dismiss="modal"
                        type="button">{{ __('general.cancel', [], 'en') }}</button>

                    <form name="del_image_form" method="POST"
                        action="{{ url('admin/mediastore/destroyimage', 'ItemId') }}" enctype="multipart/form-data"
                        id="del_image_form">
                        @csrf
                        @method('DELETE')
                        <button class="btn ripple btn-danger " id="btn-modal-del"
                            type="button">{{ __('general.delete', [], 'en') }}</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.end delete modal -->

    <!-- /.modal -->
    <!-- video -->
    <div class="modal fade" id="modal-newvid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <form class="form-horizontal col-sm-12" name="create_video_form" method="POST"
                                    action="{{ route('mediapost.storevideo', $item->id) }}" enctype="multipart/form-data"
                                    id="create_video_form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <textarea name="caption" style="width: 100%" id="caption" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"
                                    accept="video/mp4,video/mkv,video/x-m4v,video/*" id="image-video">
                                <label class="custom-file-label" id="video_label" for="image-video">Choose file</label>
                                <span id="image-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <video controls id="vidshow"
                                class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0" alt="">
                                <source src="">
                            </video>

                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-modal-create-video" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_create_video" id="btn_create_video" class="btn btn-primary"
                        form="create_video_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-edit-video">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit video</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <form class="form-horizontal col-sm-12" name="update_video_form" method="POST"
                                    action="{{ route('mediapost.updatevideo', 'item_Id') }}" enctype="multipart/form-data"
                                    id="update_video_form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <textarea name="caption-edit" style="width:100%" id="caption-edit-video" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image"
                                    accept="video/mp4,video/mkv, video/x-m4v,video/*" id="image-video-edit">
                                <label class="custom-file-label" id="image_label-video-edit"
                                    for="image-video-edit">Choose file</label>
                                <span id="image-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <video controls id="vidshow-edit"
                                class="rounded img-thumbnail wd-100p float-sm-right  mg-t-10 mg-sm-t-0" alt="">
                                <source src="">
                            </video>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-modal-edit-video" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_update_video" id="btn_update_video" class="btn btn-primary"
                        form="update_video_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- /.add pdf modal -->
    <div class="modal fade" id="modal-newpdf">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <form class="form-horizontal col-sm-12" name="create_pdf_form" method="POST"
                                    action="{{ route('mediapost.store', $item->id) }}" {{-- enctype="multipart/form-data" --}}
                                    id="create_pdf_form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <textarea name="caption" style="width: 100%" id="caption" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">
                                    <input type="hidden" value="pdf" name="file_type">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="pdf-file" accept="document/pdf"
                                    id="pdf-file">
                                <label class="custom-file-label" id="pdf-file_label" for="pdf-file">Choose file</label>
                                <span id="pdf-file-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                           
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-modal-pdf" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_create_pdf" id="btn_create_pdf" class="btn btn-primary"
                        form="create_pdf_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- /.end add pdf modal -->

    <!-- /.edit pdf modal -->
    <div class="modal fade" id="modal-editpdf">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit PDF</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <form class="form-horizontal col-sm-12" name="update_pdf_form" method="POST"
                                    action="{{ route('mediapost.update', 'item_Id') }}" {{-- enctype="multipart/form-data"  --}}
                                    id="update_pdf_form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <textarea name="caption-edit" style="width: 100%" id="caption-pdf-edit" rows="2" placeholder="Description"></textarea>

                                    </div>
                                    <input type="hidden" value="category" name="dep_name">
                                    <input type="hidden" value="pdf" name="file_type">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="pdf" accept="pdf"
                                    id="pdf-edit">
                                <label class="custom-file-label" id="pdf_label" for="pdf-edit">Choose file</label>
                                <span id="pdf-error" class="error invalid-feedback"></span>
                                <div style="display: none" class="progress mt-3" style="height: 25px">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 75%; height: 100%">75%</div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                          <a alt="" id="pdfshow"  class="rounded " target="_blank"
                           href="{{ URL::asset('assets/admin/img/default/1.jpg') }}">Download</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="btn-cancel-pdf-edit" class="btn btn-default"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" name="btn_update_pdf" id="btn_update_pdf" class="btn btn-primary"
                        form="update_pdf_form">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.end edit  pdf modal -->
@endsection

@section('js')
    <script src="{{ URL::asset('assets/admin/js/custom/validate.js') }}"></script>
    <script>
        var csrtoken = "{{ csrf_token() }}";
    </script>
    @once
        <script src="{{ URL::asset('assets/admin/js/custom/project.js') }}"></script>
    @endonce


    <script>
        var emptyimg = "{{ URL::asset('assets/admin/img/default/1.jpg') }}";
        var imgId = 0;
        var delType = '';
        var editimgurl = "{{ url('admin/mediastore/getbyid', 'ItemId') }}";
        var delimgurl = "{{ url('admin/mediastore/destroyimage', 'ItemId') }}";
        var galimgurl = "{{ url('admin/mediastore/getcatgallery', $item->id) }}";
        var vidurl = "{{ url('admin/mediastore/getcatvideo', $item->id) }}";
        var pdfurl = "{{ url('admin/mediastore/getcatpdf', $item->id) }}";
        $(function() {
            $('.textarea').summernote();
            //delete image
            $('.delete').on('click', function(e) {
                e.preventDefault();
                imgId = $(this).attr("id");
                imgId = imgId.replace("del-", "");
                delType = 'image';
            });
            // delete video
            $('.delete-video').on('click', function(e) {
                e.preventDefault();
                imgId = $(this).attr("id");
                imgId = imgId.replace("del-", "");
                delType = 'video';
            });
            $('.delete-pdf').on('click', function(e) {
                e.preventDefault();
                imgId = $(this).attr("id");
                imgId = imgId.replace("del-", "");
                delType = 'pdf';
            });
        });
    </script>
@endsection
@section('css')
    <link href="{{ URL::asset('assets/admin/css/custom/content.css') }}" rel="stylesheet">
@endsection
