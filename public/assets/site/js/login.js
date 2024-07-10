var valid=true;
$(document).ready(function() {
  
  $("#email").focusout(function (e) {
    if (!validatempty($(this))) {
			return false;
		} else {

		//	return true;
		}
		if (!validateinputemail($(this),"Must be email")) {
			return false;
		} else {
			return true;
		}
	}); 
  $("#password").focusout(function (e) {
		if (!validatempty($(this))) {
			return false;
		} else {
			return true;
		}
	});
  
     
   //register form 
   $('.btn-submit').on('click', function (e) {
		e.preventDefault();
if( validatempty($("#email")) && validateinputemail($("#email"),"Must be email") && validatempty($("#password"))  ){
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
		urlval = $(formid).attr("action");
		$.ajax({
			url: urlval,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,

			success: function (data) {
				if (data.length == 0) {
					noteError();
				} else if (data == "ok") {
					noteSuccess(); 	
          var url= window.location.origin;
					$(location).attr('href',url); 
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
   
  });
  function noteSuccess() {
  //  swal("تم   بنجاح");
  }
  function noteError() {
    swal("لم يتم تسجيل الدخول");
  }