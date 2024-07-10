@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
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
                <h3 class="card-title">Edit Category</h3>
              </div>
           
              @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                  
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
              @endif
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/category/update',[$category->id])}}" enctype="multipart/form-data" method="POST" name="store_category_form" id="store_category_form">
                @csrf
                <div class="card-body">
                  <div class="card-body">
                    <!-- title start -->
                 <div class="form-group row">
                     <label for="title" class="col-sm-2 col-form-label">title</label>
                     <div class="col-sm-10">
                       <input type="text" class="form-control 
                       @error('title')  is-invalid  @enderror "
                         name="title" id="title" placeholder="* title" 
                         @if ($errors->any()) 
                         value="{{old('title')}}" @else value="{{$category->title}}"
                         @endif  
                        
                         @error('title')  
                       describedby="title-error" aria-invalid="true"  
                       @enderror                  
                       >
                       @error('title')  
                        <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror                  
                     </div>
                   </div>
 
                     <!-- name end -->
                     <div class="form-group row">
                       <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                       <div class="col-sm-10">
                         <input type="text" class="form-control 
                         @error('slug')  is-invalid  @enderror "
                           name="slug" id="slug" placeholder="slug" 
                            @if ($errors->any()) 
                           value="{{old('slug')}}" @else value="{{$category->slug}}"
                           @endif  
                           @error('slug')  
                         describedby="slug-error" aria-invalid="true"  
                         @enderror                  
                         >
                         @error('slug')  
                          <span id="slug-error" class="error invalid-feedback">{{ $message }}</span>
                          @enderror                  
                       </div>
                     </div>
                                <!-- parent_id start -->
                 <div class="form-group row">
                   <label for="parent_id" class="col-sm-2 col-form-label"  @error('parent_id')  
                   describedby="parent_id-error" aria-invalid="true"  
                   @enderror >Select Parent</label>                             
                         <div class="col-sm-10">
                         <select class="form-control  @error('parent_id')  is-invalid  @enderror "  name="parent_id" id="parent_id"  
                         @error('parent_id')  
                         describedby="parent_id-error" aria-invalid="true"  
                         @enderror  >
                         <option value="0" @if(old('parent_id')==0) selected="selected" @elseif($category->parent_id=="0" && !$errors->any() )selected="selected"@endif >-</option>
                         @if(!empty($categories))
                         @foreach($categories as $categoryRow)
@if($categoryRow->last()->id!=$category->id)
                           <option value="{{$categoryRow->last()->id}}" @if(old('parent_id')==$categoryRow->last()->id) selected="selected"  @elseif ($category->parent_id==$categoryRow->last()->id && !$errors->any()) selected="selected" @endif >
                      
                             @foreach($categoryRow as $parent)                        
                             {{ $parent->title }}
                             @if ($categoryRow->last()->id!=$parent->id)
                             >
                             @endif
                            
                             @endforeach                     
                           </option>
                           @endif
                           @endforeach
                           @endif
                         </select>
                         @error('parent_id')  
                         <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                         @enderror  
                       </div>
                        
                     </div>
                     <!-- role end --> 
                         <!-- desc start -->
               
                         <div class="form-group row">
                     <label for="desc" class="col-sm-2 col-form-label">Descreption</label>
                     <div class="col-sm-10">
                       <textarea class="textarea" name="desc"  id="desc" placeholder="Place some text here"
                       style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">@if($errors->any()){{old('desc')}}@else{{$category->desc}}@endif</textarea>
                     
                       @error('desc')  
                       <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror  
                     </div>
                   </div>
                     <!-- desc end -->
                     <div class="form-group row">
                      <label class="col-sm-2 col-form-label"  >Status</label>
                      <div class="custom-control custom-switch col-sm-10" >                    
                        <input type="checkbox" class="custom-control-input" id="status" name="status"  @if($errors->any())  @if(old('status')==1)checked="checked" @endif @else  @if($category->status==1)checked="checked" @endif @endif >  
                        <label class="custom-control-label" for="status" id="status_lbl">@if($errors->any())  @if(old('status')==1)Published @else Draft @endif @else  @if($category->status==1)Published @else Draft @endif @endif</label> 
                      </div>
                    </div>
                           </div>
                 
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a class="btn btn-default float-right" href="{{url('cpanel/category/view')}}">Cancel</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


      <!-- /.card -->

 @endsection
 @section('showmessagecss')
 <!-- SweetAlert2 -->
 <link rel="stylesheet" href="{{url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
 <!-- Toastr -->
 <link rel="stylesheet" href="{{url('admin/plugins/toastr/toastr.min.css')}}"> 
@endsection
@section('showmessagescript')
<!-- SweetAlert2 -->
<script src="{{url('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{url('admin/plugins/toastr/toastr.min.js')}}"></script>
<script type="text/javascript">
$(function() {
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  @if(Session::has('success_message'))
  toastr.success("{{Session::get('success_message')}}");  
  @endif
  $("input[name=status]").click(function() {
      //  var checkBoxes = $(this).val();
      var checkBoxes = $(this).prop("checked");
if(checkBoxes==true){
  $("#status_lbl").text("Published");
  $("#status").prop("value",1);
}else{
  $("#status_lbl").text("Draft");
  $("#status").prop("value",0);
}
      //  alert( $("#status").prop("value"));
     //   checkBoxes.prop("checked", !checkBoxes.prop("checked"));
    }); 
    $('.textarea').summernote();

  
    $('.langrow').click(function(e){



//alert (langcode);
//var langName=$(this).html();


var urltransget='{{url("cpanel/category/trans/itemid/lang")}}';
urltransget=urltransget.replace("itemid",'{{$category->id}}');
urltransget=urltransget.replace("lang",langcode);
window.location.replace(urltransget);
//alert (urltransget);
  });
});
</script>
@endsection
