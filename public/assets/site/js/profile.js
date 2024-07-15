var valid=true;

$(document).ready(function() {
  
  $("#name").focusout(function (e) {
		if (!validatempty($(this))) {
  
			return false;
		} else {
     
			return true;
		}
	});
 
  
//   $("#email").focusout(function (e) {
//     if (!validatempty($(this))) {
// 			return false;
// 		} else {

// 		//	return true;
// 		}
// 		if (!validateinputemail($(this),"Must be email")) {
// 			return false;
// 		} else {
// 			return true;
// 		}
// 	}); 
  $("#password").focusout(function (e) {
		if (!validatempty($(this))) {
			return false;
		} else {
			return true;
		}
	});
	$("#old_password").focusout(function (e) {
		if (!validatempty($(this))) {
			return false;
		} else {
			return true;
		}
	});
  $("#confirm_password").focusout(function (e) {
		if (!validatempty($(this))) {
			return false;
		} else {
			return true;
		}
	});
	$("#country").focusout(function (e) {
		if (!selValidatempty($(this))) {
			return false;
		} else {
			return true;
		}
	});



   //register form 
   $('#btn-delete').on('click', function (e) {
	e.preventDefault();
 
var formid = $(this).closest("form").attr('id');
	sendform('#' + formid);
 
	
});
 
	$('#btn-pass').on('click', function (e) {
		e.preventDefault();
if(validatempty($("#old_password"))  && validatempty($("#password")) && validatempty($("#confirm_password"))  ){
    var formid = $(this).closest("form").attr('id');
		sendform('#' + formid);
}
		
	});
	
	$('#btn-update').on('click', function (e) {
		e.preventDefault();
if(validatempty($("#name")) && selValidatempty($("#country")) && selValidatempty($("#gender")) ){
    var formid = $(this).closest("form").attr('id');
		sendform('#' + formid);
}
		
	});

	function ClearErrors() {
		$("." + "invalid-feedback").html('').hide();
		$('.is-invalid').removeClass('is-invalid');
	}

	function sendform(formid) {
		ClearErrors();
		var form = $(formid)[0];
		var formData = new FormData(form);
	var	urlformval = $(formid).attr("action");
		$.ajax({
			url: urlformval,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (data) {
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {
					if(formid=='#del-form'){
						notemsg(delmsg);
						var url= window.location.origin;
						$(location).attr('href',url); 
					}else{
						noteSuccess(); 	
					}
		 
				} else {
					noteError();
				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();
				$.each(response.errors, function (key, val) {
				//	$("#" + "info-form-error").append('<li class="text-danger">' + val[0] + '</li>');
					$("#" + key + "-error").addClass('invalid-feedback').text(val[0]).show();
					$("#" + key).addClass('is-invalid');
				});

			}, finally: function () {		 

			}
		});
	}

   //end register
   	//pull
	$("#points").focusout(function (e) {
		
		if (!validatempty($(this))) {
			return false;
		} else {
			if( allnumeric($(this).val())){
				var pullpoints=$(this).val();
				var cash="-";
if(pullpoints>=arrdata.minpoints && pullpoints<=arrdata.balance){
	  cash=$(this).val()/arrdata.pointsrate;
}
				

				$('#coin-value').text(cash);
			}
			
			return true;
		}
	});
	$('#btn-pull').on('click', function (e) {
		e.preventDefault();
if(validatempty($("#points"))){
    var formid = $(this).closest("form").attr('id');
	sendpullform('#' + formid);
}
		
	});

   
   function sendpullform(formid) {
	ClearErrors();
	var form = $(formid)[0];
	var formData = new FormData(form);
	var urlpull = $(formid).attr("action");
	$.ajax({
		url: urlpull,
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (data) {
			if (data.length == 0) {
				noteError();
			} else if (data == "ok") {	
				resetForm();
loadpointdata();
					noteSuccess(); 	

	 
			} else {
				noteError();
			}

		}, error: function (errorresult) {
			var response = $.parseJSON(errorresult.responseText);
			noteError();
			$.each(response.errors, function (key, val) {
			//	$("#" + "info-form-error").append('<li class="text-danger">' + val[0] + '</li>');
				$("#" + key + "-error").addClass('invalid-feedback').text(val[0]).show();
				$("#" + key).addClass('is-invalid');
			});

		}, finally: function () {		 

		}
	});
}

function loadpointdata() {
 
 
	$.ajax({
		url: urlval,
		type: "GET",

	 
		success: function (data) {
		 

			if (data.length == 0) {
				//	noteError();
			} else {
				arrdata=data; 
				if(arrdata.balance<arrdata.minpoints){
$('#pull-form').hide();
$('#balance-msg').show();

				}else{
					$('#pull-form').show();	
					$('#balance-msg').hide();	
				}
$('#pointbalance-value').text(arrdata.balance);
$('#u-balance').text(arrdata.balance);
			}

		}, error: function (errorresult) {
		 
			var response = $.parseJSON(errorresult.responseText);
			 	
		}, finally: function () {
			 

		}
	});
}
loadpointdata() ;
  });
  function noteSuccess() {
    swal (success_msg);
  }
  function notemsg(msg) {
    swal(msg);
  }
  function noteError() {
    swal(fail_msg);
  }
  function resetForm() {
	jQuery('#pull-form')[0].reset();


	/*
	$('#imgshow').attr("src", emptyimg);
	$('#iconshow').attr("src", emptyimg);
	*/
}