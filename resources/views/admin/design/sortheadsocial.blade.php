@extends('admin.layouts.layout')
@section('page-title')
    Design
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
                            <li class="breadcrumb-item active">{{ __('general.settings', [], 'en') }}</li>
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
                    <h3 class="card-title">Sort</h3>
                </div>

                <!-- sort-->
                <div class="card">
                    <div class="header body">
                        <h2>

                            <small>Drag & drop hierarchical list with mouse and touch compatibility</small>
                        </h2>
                        <div class="form-group row" id="errormsg">
                        </div>
                    </div> <!-- /.card-body -->

                </div>
                <div class="body">
                    <div class="clearfix m-b-20">

                        <div class="dd" id="sortbody">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" name="btn_h_socialsort" id="btn_h_socialsort" class="btn btn-info">Save</button>
                </div>
            </div>
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
    <script src="{{ URL::asset('assets/admin/plugins/nestable/jquery.nestable1.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/pages/ui/sortable-nestable.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/custom/sort.js') }}"></script>
    <script>
        var urlval = '{{ url('admin/design/updatesort') }}';
        var urlget = '{{ url('admin/design/getsort',$location) }}';
        $(function() {
            //  $('#sortbody').html('');
           
        });
    </script>
@endsection
@section('css')
    <!-- JQuery Nestable Css -->
    <link href="{{ URL::asset('assets/admin/plugins/nestable/jquery-nestable.css') }}" rel="stylesheet" />
@endsection
