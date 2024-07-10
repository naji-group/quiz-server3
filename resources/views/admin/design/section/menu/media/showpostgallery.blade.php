@foreach ($List  as $mediaproj)
<div class="col-sm-2">
  <div  class="image-contain" >
    <img src="{{ $mediaproj->mediastore->image_path }}" class="img-fluid mb-2 image-show" alt="{{ $mediaproj->mediastore->caption }}"/>
    <input id="edit-{{$mediaproj->mediastore->id }}" class="btn btn-xs btn-primary update " type="button" value="Edit" data-toggle="modal" data-target="#modal-editimage">
    <input id="del-{{$mediaproj->mediastore->id }}" class="btn btn-xs btn-danger delete " type="button" value="Delete" data-toggle="modal" data-target="#modal-delete">

  </div>
</div>
@endforeach  
  <script>
    $(function(){
      $('.delete').on('click', function (e) {
	e.preventDefault();	 
	imgId=$(this).attr("id");
	imgId=imgId.replace("del-","");
	delType = 'image';
	});
  $('.update').on('click', function (e) {
			e.preventDefault();	 
			imgId=$(this).attr("id");
			imgId=imgId.replace("edit-","");
      resetForm('#update_image_form');
			loadImageInfo(imgId);
			});
      function loadImageInfo(imageId) {
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
						$('#imgshow-edit').attr('src',data.image_path);
						$('#caption-edit').html(data.caption);
						$("#btn-cancel-modal").trigger("click");					 
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
function resetForm() {
	jQuery('#create_form')[0].reset();
	$('#image_label').text("Choose File");
	//$('#icon_label').text('اختر ملف SVG');
	$('#imgshow').attr("src", emptyimg);
	$('#imgshow-edit').attr("src", emptyimg);
	//$('#iconshow').attr("src", emptyimg);
}
function resetForm(formId) {
	jQuery(formId)[0].reset();
	$('#image_label').text("Choose File");
	//$('#icon_label').text('اختر ملف SVG');
	$('#imgshow').attr("src", emptyimg);
	$('#imgshow-edit').attr("src", emptyimg);
	//$('#iconshow').attr("src", emptyimg);
}
});
  </script>