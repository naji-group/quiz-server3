var valid = true;
var quesid = '';
 

$(document).ready(function () {


	//start form 
	$('#start-button').on('click', function (e) {
		e.preventDefault();
		//$(this).hide(500);
		var formid = $(this).closest("form").attr('id');
		sendform('#' + formid);

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
					noteErrorempty();
				} else {
					$('#question-text').text(data.content);
					quesid = data.id;
					var uldep = $('<ul id="answers-list" class="list-group ques-group">');
					$(data.answers).each(function (index, item) {

						var lidep = $('<li class="list-group-item d-flex align-items-center list-group-item-default" id="' + 'ans-' + item.id + '">');
						var indic = $('<span class="answer-indicator">');
						var anstxt = $('<span class="answer-text">');
						anstxt.text(item.content);
						lidep.append(indic);
						lidep.append(anstxt);
						uldep.append(lidep);

					});
					$('#ans-container').html(uldep);
					//noteSuccess(); 	
					$('#question-section').show();
					$('#ques-div').fadeIn(1000);

				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();
			}, finally: function () {

			}
		});
	}
	function checkform(formid, ansidnum) {
		var dataser = $(formid).serialize() + '&ques=' + quesid + '&ans=' + ansidnum + '&cat=' + cat;
		urlval = $(formid).attr("action");

		$.ajax({

			url: urlval,
			type: "POST",
			data: dataser,

			success: function (data) {
				if (data.length == 0) {
					noteError();
				} else {

					// hide 

					animateresult($('#' + ansid), data.correct_ans)
					setTimeout(hideoldques, 1000); // 2 ثانية بعد clickstart
					setTimeout(shownewques, 2000); // 2 ثانية بعد fun2 (4 ثواني بعد clickstart)

					//end hide 
					if (data.result == 1) {
						$('#u-balance').text(data.balance);
						noteSuccess();
						if (data.notifylevel == 1) {
var tmp_nextmsg=nextlevel_msg;
tmp_nextmsg=tmp_nextmsg.replace("level-num", data.levelnum).replace("gift-points",data.giftpoints);
							swal(tmp_nextmsg);
						}
					} else {
						noteError();
					}

				}

			}, error: function (errorresult) {
				var response = $.parseJSON(errorresult.responseText);
				noteError();


			}, finally: function () {

			}
		});
	}

	//click on answer event
	var ansid = '';

	$('#ans-container').on('click', '.list-group-item', function (e) {

		ansid = $(this).attr('id');
		var ansidnum = ansid.replace("ans-", "");
		checkform('#check-form', ansidnum);

		//color correct
		/*
		  
		 */
	});
	
	function clickstart() {
		$('#start-button').trigger('click');
	}
	function hideoldques() {
		$('#ques-div').fadeOut(1000);
	}
	function shownewques() {
		$('#start-button').trigger('click');
	}
	function animateresult(selectedObj, correct_ans) {
		//show correct answer
		correct_ans = 'ans-' + correct_ans;
		var corrli = $('#' + correct_ans);
		var indicator = corrli.find('.answer-indicator');
		var id = selectedObj.attr('id');
		indicator.removeClass('incorrect').addClass('correct answer-correct');
		corrli.removeClass('list-group-item-default').addClass('list-group-item-correct');
		//
		if (id != correct_ans) {
			var indicatorincor = selectedObj.find('.answer-indicator');
			indicatorincor.removeClass('correct').addClass('incorrect answer-incorrect');
			selectedObj.addClass('list-group-item-incorrect');
		}


	}

	// end click
	clickstart();
});
function noteSuccess() {
	swal(correct_answer);
}
function noteError() {
	swal(wrong_answer);
}
function noteErrorempty() {
	swal(no_questions);
}