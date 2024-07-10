@extends('admin.layouts.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Media</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/cpanel') }}">Home</a></li>
              <li class="breadcrumb-item active">Media</li>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Show Media</h3>

          <div class="card-tools">
       
                          <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default">
                         <i class="fas fa-plus">
                          </i> New
                          </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
             
          </div>

        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Media
                </div>
              </div>
              <div class="card-body" id="media_content">
                <div class="row">
                 
                  @foreach ($images as $imagerow)
                  <div class="col-sm-2 image_gallery"    data-toggle="modal"  data-target="#modal-edit">
                    
                      <img  src="{{url($imagerow->url)}}" class="img-fluid mb-2 edit_image" id="{{$imagerow->id}}" onerror="this.src='{{url('defaultpic/defaultpic.jpg')}}'" alt="white sample"  />
                  
                  </div> 
                  @endforeach
    
                </div>
                {!! $images->links() !!} 
    

              </div>
            </div>
          </div>
        </div>
      
 
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Image</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="{{url('/cpanel/media/store')}}" enctype="multipart/form-data" method="POST" name="store_media_form" id="store_media_form">
              @csrf
            <div class="modal-body">
           
              <div class="row">
               
                <div class="col-sm-8">
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">title</label>
                    <div class="col-sm-8">
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
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Caption</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('caption')  is-invalid  @enderror "
                        name="caption" id="caption" placeholder="Caption" value="{{old('caption')}}"
                        @error('caption')  
                      describedby="caption-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('caption')  
                       <span id="caption-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="desc" class="col-sm-4 col-form-label">Desc</label>
                    <div class="col-sm-8">
                       
                      <textarea  name="desc" class="form-control" id="desc" placeholder="Place some text here"
                      style="width: 100%;  font-size: 14px; line-height: 18px; ">{{old('desc')}}</textarea>
                      @error('desc')  
                       <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                    <div class="col-sm-8">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input " name="photo" id="btn_photo_add">
                      <label class="custom-file-label " for="photo">Choose file</label>
                      <label class="col-sm-12"    id="fileupload_label_add"  ></label>
                    </div>
                   </div>

                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">Url</label>
                    <div class="col-sm-8">
                      <label  class="col-sm-4 col-form-label">-</label>                
                    </div>
                  </div>
 
                </div>
                <div class="col-sm-4">
                  <a  data-toggle="lightbox" data-title="" >
                    <img src="{{url('defaultpic/defaultpic.jpg')}}" id="image_add" class="img-fluid mb-2" alt="new image">
                  </a>
                </div>
               
              </div>
          
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
           
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- /.card-body -->
    </div>





      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Image</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="form-horizontal" action="{{url('/cpanel/media/update')}}" enctype="multipart/form-data" method="POST" name="update_media_form" id="update_media_form">
              @csrf
            <div class="modal-body">
           
              <div class="row">
                <div class="col-sm-12" id="errormsg" >
                </div>
                <div class="col-sm-8">
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Title</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('title')  is-invalid  @enderror "
                        name="title" id="title_edit" placeholder="* title" value="{{old('title')}}"
                        @error('title')  
                      describedby="title-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('title')  
                       <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-4 col-form-label">Caption</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control 
                      @error('caption')  is-invalid  @enderror "
                        name="caption" id="caption_edit" placeholder="Caption" value="{{old('caption')}}"
                        @error('caption')  
                      describedby="caption-error" aria-invalid="true"  
                      @enderror                  
                      >
                      @error('caption')  
                       <span id="caption-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="desc" class="col-sm-4 col-form-label">Desc</label>
                    <div class="col-sm-8">
                       
                      <textarea  name="desc" class="form-control" id="desc_edit" placeholder="Place some text here"
                      style="width: 100%;  font-size: 14px; line-height: 18px; ">{{old('desc')}}</textarea>
                      @error('desc')  
                       <span id="desc-error" class="error invalid-feedback">{{ $message }}</span>
                       @enderror                  
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="photo" class="col-sm-4 col-form-label">Photo</label>
                    <div class="col-sm-8">

                    <div class="custom-file">
                      <input type="file" class="custom-file-input " name="photo" id="photo_edit">
                      <label class="custom-file-label "   for="photo" >Choose file</label>
                      <label class="col-sm-12"  for="photo" id="fileupload_label" ></label>
                   
                    </div>
                   </div>

                  </div>
                  <div class="form-group row">
                    <label  class="col-sm-4 col-form-label">url</label>
                    <div class="col-sm-8">
                      <label  class="col-sm-12 col-form-label" id="url_edit"></label>                
                    </div>
                  </div>
 
                </div>
                <div class="col-sm-4">
                  <a  data-toggle="lightbox" data-title="" >
                    <img src="{{url('defaultpic/defaultpic.jpg')}}" id="image_edit" class="img-fluid mb-2" alt="black sample">
                  </a>
                </div>
               
              </div>
            
            </div>
            <div class="modal-footer justify-content-between">
              <div class="col-sm-3">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
              <div class="col-sm-3">
              <button type="button" class="btn btn-danger"  id="btn_delete_image">Delete</button>
              </div>
              <div class="col-sm-4">
              <button type="button" id="btn_update_image" class="btn btn-primary">Save changes</button>
            </div>
            </div>
           
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      <!-- /.card-body -->
    </div>

        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection



@section('showmessagecss')

<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{url('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<!-- Toastr -->
<link rel="stylesheet" href="{{url('admin/plugins/toastr/toastr.min.css')}}"> 

<link rel="stylesheet" href="{{url('admin/plugins/ekko-lightbox/ekko-lightbox.css')}}">
<!-- Ionicons -->

@endsection

@section('showmessagescript')

<!-- SweetAlert2 -->
<script src="{{url('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{url('admin/plugins/toastr/toastr.min.js')}}"></script>
<script src="{{url('admin/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

<script>
  var id="0";
  $(function () {

  function clearform (){
   var imgpath= '{{url("defaultpic/defaultpic.jpg")}}';
   $('#title_edit').attr('value', '');
                $('#caption_edit').attr('value', '');
                $('#desc_edit').text('');
                $('#url_edit').text('');
                $('#image_edit').attr('src', imgpath);
   }

   //var urlval='{{route("cpanel.category.updatesort",[0]) }}';
 $('.edit_image').on('click', function(e) {//edit_image
  
   clearform();
id= $(this).attr('id');
 
 
var urlget='{{url("cpanel/media/edit/itemid")}}';
urlget=urlget.replace("itemid",id);
//  alert(urlget);
  
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "GET",         
          contentType: 'application/json',
            success: function(data){
              $('#errormsg').html('');
          
               if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
               
                $('#title_edit').attr('value', data.title);
                $('#caption_edit').attr('value', data.caption);
                $('#desc_edit').text(data.desc);
                $('#url_edit').text(data.url);
                $('#image_edit').attr('src', data.url);
               }
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }
        
        });
   
    });
 



  
   //var urlval='{{route("cpanel.category.updatesort",[0]) }}';
    $('#btn_update_image').on('click', function(e) {//edit_image
     // alert("hi");
  // clearform();
//var formdata= $('#update_media_form').serialize();
let request=new FormData($('#update_media_form')[0]);
//  var urlget='cpanel/media/update/itemid';

 var urlget='{{url("cpanel/media/update/itemid")}}';
urlget=urlget.replace("itemid",id);
 //alert(urlget);


 
//alert( formdata);
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "POST",  
          data: request,  
       contentType:false,  
       processData:false,   
          //contentType: 'application/json',
            success: function(data){
              $('#errormsg').html('');
          
               if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
              //  alert(data);
                toastr.success(data);  
                window.location.href = '{{url("cpanel/media/view")}}';
               /*
                $('#title_edit').attr('value', data.title);
                $('#caption_edit').attr('value', data.caption);
                $('#desc_edit').text(data.desc);
                $('#url_edit').text(data.url);
                $('#image_edit').attr('src', data.url);
                */
               }
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }
      
        });
 
    });  

    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
   
 
  $('#btn_delete_image').on('click', function(e) {//edit_image
   clearform();
//id= $(this).attr('id');
 
 
var urlget='{{url("cpanel/media/delete/itemid")}}';
urlget=urlget.replace("itemid",id);
//  alert(urlget);
  
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "GET",     
             
          contentType: 'application/json',
            success: function(data){
              $('#errormsg').html('');
          
               if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
                clearform();
             // alert();
              toastr.success(data); 
              window.location.href = '{{url("cpanel/media/view")}}'; 
               }
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }
        
        });   
    });

    $("#photo_edit").on("change",function(){ 
      imageChangeForm ("#photo_edit","#fileupload_label","#image_edit");
 /* Current this object refer to input element */    
/* 
 var $input = $(this);
 var reader = new FileReader(); 

 reader.onload = function(){
       $("#image_edit").attr("src", reader.result);
    //   var filename = $('#photo_edit')[0].files.length ? ('#photo_edit')[0].files[0].name : "";
       var filename = $('#photo_edit').val().split('\\').pop();
       $("#fileupload_label").text(filename );
 } 
 reader.readAsDataURL($input[0].files[0]); 
 */

});
$("#btn_photo_add").on("change",function(){ 
      imageChangeForm ("#btn_photo_add","#fileupload_label_add","#image_add");
    });

function imageChangeForm (btn_id,upload_label,imageId){ 
 /* Current this object refer to input element */         
 var $input = $(btn_id);
 var reader = new FileReader(); 

 reader.onload = function(){
       $(imageId).attr("src", reader.result);
    //   var filename = $('#photo_edit')[0].files.length ? ('#photo_edit')[0].files[0].name : "";
       var filename = $(btn_id).val().split('\\').pop();
       $(upload_label).text(filename );
 } 
 reader.readAsDataURL($input[0].files[0]);
 
   }


   $('#btn_search').on('click', function(e) {//edit_image
    e.preventDefault();
    if($('#text_search').val()==''){
      window.location.href = '{{url("cpanel/media/view")}}'; 
    }else{
      var txt= $('#text_search').val();
var urlget='{{url("cpanel/media/search")}}';
        $.ajax({
          //  url: "{{url('cpanel/category/updatesort/',["+parentid+"])}}",   
          url: urlget,              
          type: "Get",         
          data:"text="+ txt,          
            success: function(data){
              $('#media_content').html(data);
          
               /* if(data.length==0){
                $('#errormsg').html('No Data');
               }else{
               
                $('#title_edit').attr('value', data.title);
                
               } */
        
             // $('.alert').html(result.success);
            },
            error: function(jqXHR, textStatus, errorThrown) {
             alert(jqXHR.responseText);
              // $('#errormsg').html(jqXHR.responseText);
              $('#errormsg').html("Error");
            }        
        });
    }   

    });
  });
</script>
@endsection


