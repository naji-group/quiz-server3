@extends('admin.layouts.layout')
@section('page-title')
{{ __('general.products',[],'en') }}
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
                            <li class="breadcrumb-item active"><a href= "{{ route('project.index') }}" >{{ __('general.products',[],'en') }}</a></li>   
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
                    <h3 class="card-title">Add Product</h3>
                </div>
                <!-- form start -->
                <div class="card-body  row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" name="create_form" method="POST" action="{{ url('admin/project') }}"
                            enctype="multipart/form-data" id="create_form">
                            @csrf
 
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" id="title"
                                        placeholder="* Title" value="">

                                    <span id="title-error" class="error invalid-feedback"></span>

                                </div>
                            </div>                         
 
                            <div class="form-group row">
                                <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control " name="slug" id="slug"
                                        placeholder="Slug" value="">
                                    <span id="slug-error" class="error invalid-feedback"></span>

                                </div>
                            </div>
                            <div class="form-group row">
                              <label for="metakey" class="col-sm-2 col-form-label">Keywords</label>
                              <div class="col-sm-10">                           
                                      <textarea class="form-control" rows="2"  name="metakey" id="metakey" placeholder="Keywords"></textarea>
                                  <span id="metakey-error" class="error invalid-feedback"></span>
                              </div>
                             </div>
                       
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10 custom-control custom-switch ">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status"
                                        value="1" checked="checked">
                                    <label class="custom-control-label" for="status" id="status_lbl">Active</label>
                                    <span id="status-error" class="error invalid-feedback"></span>
                                </div>
                            </div>
 
                            <div class="form-group row">
                                <div class="col-sm-2 col-form-label"></div>
                                <div class="col-sm-10">
                                     
                                    <button type="submit" type="submit" name="btn_save" id="btn_save"
                                        class="btn btn-primary">Save</button>
                          
                                    <a class="btn btn-danger float-right " href="{{ route('project.index') }}">Cancel</a>
                                    <button id="btn_reset" class="btn btn-default float-right  " style="margin-right: 20px;margin-left: 20px"  >Reset</button>
                                
                                </div>
                            </div>
                        </form>
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
@endsection




@section('js')

    <script src="{{ URL::asset('assets/admin/js/custom/validate.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/custom/content.js') }}"></script>
    <script  >  
        var emptyimg ="{{ URL::asset('assets/admin/img/default/1.jpg') }}";
        </script>
@endsection
@section('css')

@endsection
