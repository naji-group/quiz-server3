var urlval = "";
 
$(document).ready(function () {
	$('#btn-save-info').on('click', function (e) {
		e.preventDefault();	 
		sendform('#info-form');
		});
		$('#btn-social').on('click', function (e) {
			e.preventDefault();	 
			sendform('#social-form');
			});
		
	function ClearErrors() {
		$("#" + "info-form-error").html('');
	 
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
					if(formid=='#social-form'){
						swal( "تم الحفظ بنجاح");
					}else{
						location.reload(true);
					}
					
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
				  
				});

			}, finally: function () {
				//endLoading();

			}		});
	}
	function afterOkComment() {
		$('#span_wait').hide();
		$('.agree-state').show();
		$('#btn_agree_comment').remove();
		$('.rate-btn').show();
	}
	function afterOkCommentRate(selectid) {	 		 				
		$('.rated-hide').remove();
		var option=$(selectid).find(":selected").text();
	 $('#p_rate_value').html(option);
	 $('.rated-h').show();	
	 $('#p_rate_value').show();		 
	}

	function afterOkForm() {
		$('#span_wait').hide();
		$('.agree-state').show();
		$('#div_btns').remove();
	}
	 
// #form_reject_reason'
//#comment_reject_reason
	 
	 
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
 
 
function resetexpertForm() {
	jQuery('#expert_form')[0].reset();


	/*
	$('#imgshow').attr("src", emptyimg);
	$('#iconshow').attr("src", emptyimg);
	*/
}