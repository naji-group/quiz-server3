
                <div class="row" >
                 
                  @foreach ($images as $imagerow)
                  <div class="col-sm-2 image_gallery"    data-toggle="modal"  data-target="#modal-edit">
                    
                      <img  src="{{url($imagerow->url)}}" class="img-fluid mb-2 edit_image" id="{{$imagerow->id}}" onerror="this.src='{{url('defaultpic/defaultpic.jpg')}}'" alt="white sample"  />
                  
                  </div> 
                  @endforeach
             
                 
               
                </div>
             
                <script>
                    $(function () {
                      function clearform (){
   var imgpath= '{{url("defaultpic/defaultpic.jpg")}}';
   $('#title_edit').attr('value', '');
                $('#caption_edit').attr('value', '');
                $('#desc_edit').text('');
                $('#url_edit').text('');
                $('#image_edit').attr('src', imgpath);
   }
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
                   });
                  </script>
              