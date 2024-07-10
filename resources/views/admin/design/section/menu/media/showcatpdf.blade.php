 @foreach ($List->where('media_type', 'pdf') as $mediaproj)
                                                          <div class="col-sm-2">
                                                              <div class="image-contain">
                                                                  <img src="{{URL::asset('assets/admin/img/default/pdf-icon.png')}}"
                                                                      class="img-fluid mb-2 image-show"
                                                                      alt="{{ $mediaproj->mediastore->caption }}" />
                                                                  <input id="edit-{{ $mediaproj->mediastore->id }}"
                                                                      class="btn btn-xs btn-primary update-pdf "
                                                                      type="button" value="Edit"
                                                                      data-toggle="modal"
                                                                      data-target="#modal-editpdf">
                                                                  <input id="del-{{ $mediaproj->mediastore->id }}"
                                                                      class="btn btn-xs btn-danger delete-pdf "
                                                                      type="button" value="Delete"
                                                                      data-toggle="modal"
                                                                      data-target="#modal-delete">
                                                              </div>
                                                          </div>
 @endforeach

  <script>
    $(function(){
      $('.delete').on('click', function (e) {
	e.preventDefault();	 
	imgId=$(this).attr("id");
	imgId=imgId.replace("del-","");
	});
//pdf
$('.update-pdf').on('click', function (e) {
	e.preventDefault();
	imgId = $(this).attr("id");
	imgId = imgId.replace("edit-", "");
	resetForm('#update_pdf_form');
	loadImageInfo(imgId, 'pdf');

});
$('.delete-pdf').on('click', function(e) {
                e.preventDefault();
                imgId = $(this).attr("id");
                imgId = imgId.replace("del-", "");
                delType = 'pdf';
            });
			
	function loadImageInfo(imageId, type) {
		startLoading();
		ClearErrors();
		urlval = editimgurl;
		urlval = urlval.replace("ItemId", imageId);
		$.ajax({
			url: urlval,
			type: "GET",

			//	data: formData,
			//	contentType: false,
			//	processData: false,
			//contentType: 'application/json',
			success: function (data) {
				//	alert(data);
				endLoading();

				if (data.length == 0) {
					noteError();
				} else {
					if (type == 'image') {
						$('#imgshow-edit').attr('src', data.image_path);
						$('#caption-edit').html(data.caption);
						//	$("#btn-cancel-modal").trigger("click");
					}else if(type == 'pdf'){
						$('#pdfshow-edit').attr('src', data.image_path);
						$('#caption-pdf-edit').html(data.caption);
					} else {
						$('#vidshow-edit').attr('src', data.image_path);
						$('#caption-edit-video').html(data.caption);
						//$("#btn-cancel-modal").trigger("click");
					}

					//	noteSuccess();

					//	ClearErrors();
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