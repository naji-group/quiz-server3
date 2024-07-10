var urlval = "";
 
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
		//$("#" + "info-form-error").html('');
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
 
	// $("#image").on("change", function () {
	// 	imageChangeForm("#image", "#logo_label", "#imgshow");
	// });
	 
	 
 
	// function imageChangeForm(btn_id, upload_label, imageId) {
	// 	/* Current this object refer to input element */
	// 	var $input = $(btn_id);
	// 	var reader = new FileReader();
	// 	reader.onload = function () {
	// 		$(imageId).attr("src", reader.result);
	// 		//   var filename = $('#photo_edit')[0].files.length ? ('#photo_edit')[0].files[0].name : "";
	// 		var filename = $(btn_id).val().split('\\').pop();
	// 		$(upload_label).text(filename);
	// 	}
	// 	reader.readAsDataURL($input[0].files[0]);
	
	// }
 
	 
 
	 
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