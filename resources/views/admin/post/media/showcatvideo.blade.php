@foreach ($List  as $mediaproj)
<div class="col-sm-2">
  <div  class="image-contain" >  
	<video controls  class="img-fluid mb-2 image-show" alt="{{ $mediaproj->mediastore->caption }}"  ><source src="{{$mediaproj->mediastore->image_path }}" > </video>
	<input id="edit-{{$mediaproj->mediastore->id }}" class="btn btn-xs btn-primary  update-video " type="button" value="Edit" data-toggle="modal" data-target="#modal-edit-video">
	<input id="del-{{$mediaproj->mediastore->id }}" class="btn btn-xs btn-danger delete-video " type="button" value="Delete" data-toggle="modal" data-target="#modal-delete">
  </div>
</div>
@endforeach   
  <script>
    $(function(){
		$('.delete-video').on('click', function (e) {
	e.preventDefault();	 
	imgId=$(this).attr("id");
	imgId=imgId.replace("del-","");
	delType='video';
	});
//get video to edit
$('.update-video').on('click', function (e) {
	e.preventDefault();	 
	imgId=$(this).attr("id");
	imgId=imgId.replace("edit-","");
	resetForm('#update_video_form');
	loadImageInfo(imgId,'video');
	});  
	function loadImageInfo(imageId,type) {
				startLoading();
			ClearErrors();
			urlval=editimgurl;
			urlval=urlval.replace("ItemId", imageId);			 
					$.ajax({
				url: urlval,
				type: "GET",		 
				success: function (data) {				 
					endLoading();				
					if (data.length == 0) {
						noteError();
					} else   {
						if(type=='image'){
							$('#imgshow-edit').attr('src',data.image_path);
							$('#caption-edit').html(data.caption);						 
						}else{
							$('#vidshow-edit').attr('src',data.image_path);
							$('#caption-edit-video').html(data.caption);						 
						}				 
					}	
				}, error: function (errorresult) {
					endLoading();
					var response = $.parseJSON(errorresult.responseText);			
					noteError();	
				}, finally: function () {
					endLoading();				
				}
			});
			}      
			function ClearErrors() {
$('.error').html('');
$(":input").removeClass('is-invalid'); 
}
 
function resetForm(formId) {
	jQuery(formId)[0].reset();	 
	$('#video_label').text("Choose File");
	$('#image_label-video-edit').text("Choose File"); 
	$('#vidshow').attr("src", '');
	$('#vidshow-edit').attr("src", '');	
}
});
  </script>