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
		$('.parsley-error').removeClass('parsley-error');
	 
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
					noteSuccess();
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
				noteError();
				$.each(response.errors, function (key, val) {
				 
					$("#" + "info-form-error").append('<li class="text-danger">'+val[0]+'</li>');
				 
					$("#" + key + "-error").text(val[0]).show();
					$("#" + key).addClass('parsley-error');
				});

			}, finally: function () {
				//endLoading();

			}		});
	}
 
	$("#logo_input").on("change", function () {
		imageChangeForm("#logo_input", "#logo_label", "#logoshow");
	});
	$("#icon_input").on("change", function () {
		imageChangeForm("#icon_input", "#logo_label", "#faviconshow");
	});
	 
 
	function imageChangeForm(btn_id, upload_label, imageId) {
		/* Current this object refer to input element */
		var $input = $(btn_id);
		var reader = new FileReader();
		reader.onload = function () {
			$(imageId).attr("src", reader.result);
			//   var filename = $('#photo_edit')[0].files.length ? ('#photo_edit')[0].files[0].name : "";
			var filename = $(btn_id).val().split('\\').pop();
			$(upload_label).text(filename);
		}
		reader.readAsDataURL($input[0].files[0]);
	
	}
 
	 
// #form_reject_reason'
//#comment_reject_reason
	 
	 
	});
	 
///////////////////////////////////////////////////////

function noteSuccess() {
	swal("تم الحفظ بنجاح");
}
function noteError() {
	swal("لم يتم الحفظ");
}
 
 
function resetexpertForm() {
	//jQuery('#expert_form')[0].reset();


	/*
	$('#imgshow').attr("src", emptyimg);
	$('#iconshow').attr("src", emptyimg);
	*/
}