var urlval = "";
var gformData = "";
var cancelBtnId = '';
$(document).ready(function () {
	// $('#btn-title').on('click', function (e) {
	// 			e.preventDefault();	 
	// 	sendform('#title-form');
	// 	});
	
		$('.btn-submit').on('click', function (e) {
			e.preventDefault();	 
			var formid = $(this).closest("form").attr('id');
	sendform('#'+formid);
	});
	$('#btn_reset').on('click', function (e) {
		e.preventDefault();
		var formid = $(this).closest("form").attr('id');
	 	resetForm(formid);
		ClearErrors();
	});

// 		$('#btn-icon').on('click', function (e) {
// 			e.preventDefault();	 
// 	sendform('#icon-form');
// 	});
// 	$('#btn-logo').on('click', function (e) {
// 		e.preventDefault();	 
// sendform('#logo-form');
// });
	function ClearErrors() {
		$("#" + "info-form-error").html('');
		$("." + "error").html('').hide();
		
	 
	}
  
	function sendform(formid) {
		//startLoading();
	 	ClearErrors();
	//	$formid='#create_form';
		 
		var form = $(formid)[0];
		var formData = new FormData(form);
		urlval = $(formid).attr("action");
	 

		$.ajax({
			url: urlval,
			type: "POST",

			data: formData,
			contentType: false,
			processData: false,
			//contentType: 'application/json',
			success: function (data) {
				//	alert(data);
				//endLoading();
				//$('#errormsg').html('');
				//$('#sortbody').html('');
				if (data.length == 0) {
					//noteError();
				} else if (data == "ok") {
					
					//noteSuccess();	
					//alert('ok');
					swal( "تم الحفظ بنجاح");
					// if(formid=='#social-form'){
					
					// }else{
					// 	location.reload(true);
					// }
					
				//	
				}

				// $('.alert').html(result.success);
			}, error: function (errorresult) {
			//	endLoading();
				var response = $.parseJSON(errorresult.responseText);
				// $('#errormsg').html( errorresult );
				swal( "لم يتم الحفظ");
				$.each(response.errors, function (key, val) {
				 
					$("#" + "info-form-error").append('<li class="text-danger">'+val[0]+'</li>');
					$("#" + key + "-error").text(val[0]).show();
					$("#" + key).addClass('parsley-error');
				});

			}, finally: function () {
				//endLoading();

			}		});
	}
 
 
	
	$('.nav-link1').on('click', function (e) {
		e.preventDefault();
		$('.nav-link1').removeClass('active');
		$(this).addClass('active');
	var destid=	$(this).attr('aria-controls');
	$('.trans').hide().removeClass('show active');

	$('#'+ destid).addClass('show active').show();
		//alert(destid);
});
$('.nav-link2').on('click', function (e) {
	e.preventDefault();
	$('.nav-link2').removeClass('active');
	$(this).addClass('active');
var destid=	$(this).attr('aria-controls');
$('.trans2').hide().removeClass('show active');

$('#'+ destid).addClass('show active').show();
	//alert(destid);
});


// $('#btn-new-img').on('click', function (e) {

// var destid=	$(this).attr('data-target');
// $(destid).removeClass('modal').removeClass('fade').addClass('modal-backdrop').addClass('show');
 
// });
$('.btn-modal').on('click', function (e) {

	var destid=	$(this).attr('data-target');
	$(destid).removeClass('modal').removeClass('fade').addClass('modal-backdrop').addClass('show');
	$(destid).modal({
		backdrop: 'static',
		keyboard: false,
		show: true
	});
	});

$('.close').on('click', function (e) {

 
	  $('.modal-backdrop').removeClass('modal-backdrop').removeClass('show').addClass('modal');
	 
	 
	});
 
$('#btn_create_image').on('click', function (e) {
	e.preventDefault();
	var formid = $(this).attr("form");
	formid = '#' + formid;
	cancelBtnId = ".close";
	var formData = $(formid).serialize();
	gformData = formData;

	resumable.opts.query.fdata = gformData;
	resumable.opts.target = $(formid).attr("action");
	resumable.assignBrowse(browseFile[0]);
	showProgress();
	//resumable.query({_token:csrtoken,fdata:gformData});
	//	resumable('query',{_token:csrtoken,fdata:gformData} );
	resumable.upload();

	//startLoading();
	ClearErrors();
	//	sendformimg('#'+formid,'image');
});
	/// image
	//delete image
	$('#btn-modal-del').on('click', function (e) {
		e.preventDefault();

		var formid = $(this).closest('form').attr("id");
		delimgform('#' + formid);

	});

	function delimgform(formid) {
		//startLoading();
		ClearErrors();
		//var fdata = $( "#create_form" ).serialize();
		var form = $(formid)[0];
		var formData = new FormData(form);

		urlformval = $(formid).attr("action");
		urlval = urlformval.replace("ItemId", imgId);
		$.ajax({
			url: urlval,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			//contentType: 'application/json',
			success: function (data) {
				//	alert(data);
			//	endLoading();
				//$('#errormsg').html('');
				//$('#sortbody').html('');
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {
					//noteSuccess();

					ClearErrors();
				}

			 	loadgallery(delType);
				$("#btn-cancel-modal").trigger("click");
				// $('.alert').html(result.success);
			}, error: function (errorresult) {
				//endLoading();
				var response = $.parseJSON(errorresult.responseText);
				// $('#errormsg').html( errorresult );
			//	noteError();


			}, finally: function () {
				endLoading();

			}
		});
	}
	function loadgallery(type) {
		urlval = '';
		if (type == 'image') {
			urlval = galimgurl;
		} else if(type == 'pdf'){
			urlval = pdfurl;
		}else {
			urlval = vidurl;
		}


		$.ajax({
			url: urlval,
			type: "GET",

			//	data: formData,
			//	contentType: false,
			//	processData: false,
			//contentType: 'application/json',
			success: function (data) {
				//	alert(data);
				//	endLoading();

				if (data.length == 0) {
					//	noteError();
				} else {
					if (type == 'image') {
						$('#image-gallery-content').html(data);
					}else if(type == 'pdf'){
						$('#pdf-gallery-content').html(data);		
					}	
					else {
						$('#video-gallery-content').html(data);
					}


					//	noteSuccess();

					//	ClearErrors();
				}

			}, error: function (errorresult) {
				//endLoading();
				var response = $.parseJSON(errorresult.responseText);
				//noteError();	
			}, finally: function () {
				//endLoading();

			}
		});
	}

	//end delete image
//get image to edit
$('.update').on('click', function (e) {
	e.preventDefault();
	imgId = $(this).attr("id");
	imgId = imgId.replace("edit-", "");
	resetForm('update_image_form');
	loadImageInfo(imgId, 'image');
});
function loadImageInfo(imageId, type) {
	//startLoading();
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
		//	endLoading();

			if (data.length == 0) {
				//noteError();
			} else {
				if (type == 'image') {
					$('#imgshow-edit').attr('src', data.image_path);
					$('#caption-edit').html(data.caption);
					//	$("#btn-cancel-modal").trigger("click");
				}else if(type == 'pdf'){
					$('#pdfshow').attr('href', data.image_path);
					$('#caption-pdf-edit').html(data.caption);
				} else {
					$('#vidshow-edit').attr('src', data.image_path);
					$('#caption-edit-video').html(data.caption);
					//$("#btn-cancel-modal").trigger("click");
				}
}

		}, error: function (errorresult) {
			//endLoading();
			var response = $.parseJSON(errorresult.responseText);
			//noteError();
		}, finally: function () {
			//endLoading();

		}
	});
}

$("#images").on("change", function () {
	resumable.cancel();
	imageChangeForm("#images", "#image_label", "#imgshow");
	//	resumeChangeimg(resumable.files,"#images", "#image_label", "#imgshow");
});
$("#image").on("change", function () {
	resumable.cancel();
	imageChangeForm("#image", "#image_label", "#imgshow-edit");
});
function imageChangeForm(btn_id, upload_label, imageId) {
	/* Current this object refer to input element */
	var $input = $(btn_id);
	var reader = new FileReader();
	reader.onload = function () {
		$(imageId).attr("src", reader.result);
		//   var filename = $('#photo_edit')[0].files.length ? ('#photo_edit')[0].files[0].name : "";
		var filename = $(btn_id).val().split('\\').pop();
		//$(upload_label).text(filename);
	}

	reader.readAsDataURL($input[0].files[0]);


}

//update image
	//update
	$('#btn_update_image').on('click', function (e) {
		e.preventDefault();
		var formid = $(this).attr("form");
		formid = '#' + formid;
		cancelBtnId = ".close";
		//browseFile = $('#image');
		urlact = $(formid).attr("action");
		var urlval = urlact.replace("item_Id", imgId);
		var formData = $(formid).serialize();
		gformData = formData;
		resumable.assignBrowse(Fileimgedit[0]);
		//	resumable.assignDrop(Fileimgedit[0]);
		//  resumable.opts.fileType= ['png','image/gif','image/jpeg','image/jpg','image/svg','image/webp'];
		resumable.opts.query.fdata = gformData;
		resumable.opts.target = urlval;
		showProgress();
		 
		resumable.upload();
		//startLoading();
		ClearErrors();
	});
	// end image
//resume
var browseFile = $('#images');
	var Fileimgedit = $('#image');
	var resumable = new Resumable({
		simultaneousUploads: 1,
		//target:uploadimg,
		//query:{_token:csrtoken} ,// CSRF token
		query: { _token: csrtoken, fdata: gformData },// CSRF token

		fileType: ['png', 'gif', 'jpeg', 'jpg', 'svg', 'webp'],
		chunkSize: 1 * 1024 * 1024, // default is 1*1024*1024, this should be less than your maximum limit in php.ini
		headers: {
			'Accept': 'application/json'
		},
		testChunks: false,
		throttleProgressCallbacks: 1,
	});

	resumable.assignBrowse(browseFile[0]);
	 resumable.assignBrowse(Fileimgedit[0]);
	resumable.on('fileAdded', function (file) { // trigger when file picked
		//alert ('ok');

		// imageChangeForm("#images", "#image_label", "#imgshow");
		// resumeChangeimg(resumable.files,"#images", "#image_label", "#imgshow");
		// var x= resumable.files[0].fileName;
		//   showProgress();
		//   resumable.upload() // to actually start uploading.
	});

	resumable.on('fileProgress', function (file) { // trigger when file progress update
	 updateProgress(Math.floor(file.progress() * 100));

	});
	var fcount = 0;
	resumable.on('fileSuccess', function (file, response) { // trigger when file upload complete
		fcount++;
		response = JSON.parse(response);
		 
		result = response.id;

		if (fcount >= resumable.files.length) {
			fcount = 0;
			// endLoading();
			// noteSuccess();
			// ClearErrors();
		loadgallery('image');
			$(cancelBtnId).trigger("click");
			hideProgress();
		}
	 
	});

	resumable.on('fileError', function (file, response) { // trigger when there is any error
		// endLoading();
		// noteError();
		// hideProgress();
		// ClearErrors();
		// loadgallery('image');
		$(cancelBtnId).trigger("click");
	});


	var progress = $('.progress');
	function showProgress() {
		progress.find('.progress-bar').css('width', '0%');
		progress.find('.progress-bar').html('0%');
		progress.find('.progress-bar').removeClass('bg-success');
		$( progress).show();
	}

	function updateProgress(value) {

		progress.find('.progress-bar').css('width', `${value}%`);
		progress.find('.progress-bar').html(`${value}%`);
		//$('.progress').find('.progress-bar').html(`${value}%`);
	}

	function hideProgress() {
		 progress.hide();
	}

	});
	 
///////////////////////////////////////////////////////

function noteSuccess() {
	// notif({
	// 	msg: "تمت العملية بنجاح",
	// 	type: "success"
	// });
}
function noteError() {
	// notif({
	// 	msg: "لم تنجح العملية !",
	// 	position: "right",
	// 	type: "error",
	// 	bottom: '10'
	// });
}
 
 
function resetForm(formid) {
	formid="#"+formid;
	jQuery(formid)[0].reset();
	$('#image_label').text("Choose File");
	//$('#icon_label').text('اختر ملف SVG');
	$('#imgshow').attr("src", "");
 
	//$('#iconshow').attr("src", emptyimg);
}