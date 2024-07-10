@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Posts</li>
              <li class="breadcrumb-item active">Add</li>
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
                <h3 class="card-title">Add Post</h3>
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
              <!-- form start -->
              <form class="form-horizontal" action="{{url('/cpanel/post/store')}}" enctype="multipart/form-data" method="POST" name="store_category_form" id="store_category_form">
                @csrf
                <div class="card-body">
                   <!-- title start -->
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">title</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control 
                      @error('title')  is-invalid  @enderror "
                        name="title" id="title" placeholder="* title" value="{{old('title')}}"
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
                          name="slug" id="slug" placeholder="slug" value="{{old('slug')}}"
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
                        <option value="0" @if(old('parent_id')==0) selected="selected" @endif >-</option>
                        @if(!empty($categories))
                        @foreach($categories as $category)
                          <option value="{{$category->last()->id}}" @if(old('parent_id')==$category->last()->id) selected="selected" @endif >
                     
                            @foreach($category as $parent)                        
                            {{ $parent->title }}
                            @if ($category->last()->id!=$parent->id)
                            >
                            @endif
                            @endforeach                     
                          </option>
                          @endforeach
                          @endif
                        </select>
                        @error('parent_id')  
                        <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror  
                      </div>
                       
                    </div>
                    <!-- parent_id end --> 
                    
                        <!-- desc start -->
              
                        <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                      <textarea class="textarea" name="content"  id="content" placeholder="Place some text here"
                      style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('content')}}</textarea>
                    
                      @error('content')  
                      <span id="content-error" class="error invalid-feedback">{{ $message }}</span>
                      @enderror  
                    </div>
                  </div>
                    <!-- desc end -->
                    <div class="form-group row">
                      <label class="col-sm-2 col-form-label"  >Status</label>
                      <div class="custom-control custom-switch col-sm-10" >                    
                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" checked="checked">  
                        <label class="custom-control-label" for="status" id="status_lbl">Published</label> 
                      </div>
                    </div>
                          </div>               
                          <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">Save</button>
                  <a class="btn btn-default float-right" href="{{url('cpanel/post/view')}}">Cancel</a>
            
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
  });
</script>
@endsection
