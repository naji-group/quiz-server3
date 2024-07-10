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
          
          <li class="breadcrumb-item active" aria-current="page">ترتيب</li>
      </ol>
  </nav>
   
      
      <div class="form-group row">
        <label for="page_id"  >الصفحة</label>                             
              <div class="col-sm-6">
              <select class="form-controll"  name="page_id" id="page_id">
              <option value="0"  >اختر</option>              
              </select>            
            </div>             
          </div>    
      <div class="form-group " style="margin-top: 10px;">
          <button type="submit" class="btn btn-primary "id="btn-addtolist">إضافة</button>
      </div>
  
<div>
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
    <div class="form-group">
      <button type="button" id="btn_update_sort" class="btn btn-primary" style="margin-top: 10px;">حفظ</button>
  </div>
</div>

</div>

</div>

</main>
@endsection

 
@section('js')
    <script src="{{ URL::asset('assets/admin/js/plugins/nestable/jquery.nestable1.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/plugins/nestable/sortable-nestable.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/custom/sort.js') }}"></script>
    <script>
        var urlval = '{{ url('admin/page/updatesort',$location) }}';
        var urlget = '{{ url('admin/page/fillsort',$location) }}';
        var  fillselurl='{{ url('admin/page/fillcombo',$location) }}';
        $(function() {
            //  $('#sortbody').html('');
           
        });
    </script>
@endsection
@section('css')
    <!-- JQuery Nestable Css -->
    <link href="{{ URL::asset('assets/admin/js/plugins/nestable/jquery-nestable.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/admin/css/custom.css') }}" rel="stylesheet" />
    
@endsection
