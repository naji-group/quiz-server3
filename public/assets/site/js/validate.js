 var  requiredmsg = input_required;
 var  emailmsg =input_email;
 //var  requiredmsg = 'هذا الحقل مطلوب';
 //var  emailmsg ='هذا الحقل يجب ان يكون عنوان بريد الكتروني';
 

 function  validatempty(input) {
  
    input.removeClass('is-invalid');

    //var input = $(this);
    // $("#" + key).addClass('parsley-error');
    input.removeClass("is-invalid");
  // input.nextAll(':has(.error):first').first().html("");
   input.nextAll('.invalid-feedback').html("").hide();
    if (!required(input.val())) {
        input.addClass('is-invalid');
      //  input.nextAll(':has(.error):first').first().html(requiredmsg);
        input.nextAll('.invalid-feedback').html(requiredmsg).show();
        return false;
    }
    return true;
}
function  selValidatempty(input) {
  
    input.removeClass('is-invalid');

    //var input = $(this);
    // $("#" + key).addClass('parsley-error');
    input.removeClass("is-invalid");
  // input.nextAll(':has(.error):first').first().html("");
   input.nextAll('.invalid-feedback').html("").hide();
    if (!selRequired(input.val())) {
        input.addClass('is-invalid').style;
      //  input.nextAll(':has(.error):first').first().html(requiredmsg);
        input.nextAll('.invalid-feedback').html(requiredmsg).show();
        return false;
    }
    return true;
}
function required(inputtxt) {

    var empt = $.trim(inputtxt);
    if (empt == "") {
        //alert("Please input a Value");
        return false;
    }
    else {
        //alert('Code has accepted : you can try another');
        return true;
    }
}
function selRequired(inputtxt) {

    var empt = $.trim(inputtxt);
    if (empt == "0") {
        //alert("Please input a Value");
        return false;
    }
    else {
        //alert('Code has accepted : you can try another');
        return true;
    }
}
function validateinputemail(input, msg) {
    //var input = $(this);
    input.removeClass("is-invalid");
    input.nextAll('.invalid-feedback').html("").hide();
    if (!ValidateEmail(input.val())) {
        input.addClass('is-invalid');
        //  input.nextAll(':has(.error):first').first().html(requiredmsg);
          input.nextAll('.invalid-feedback').html(msg).show();
      
        return false;
    }
    return true
}
function allnumeric(inputtxt) {
    const regex = /^[0-9]+$/;
    const found = inputtxt.match(regex);
    if (found != null) {
        //  alert('Your Registration number has accepted....');
        return true;
    }
    else {


        return false;
    }
}
function ValidateEmail(inputText) {
    // alert("hii");
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (inputText.match(mailformat)) {

        return true;
    }
    else {
        //alert("You have entered an invalid email address!");
        //document.form1.text1.focus();
        return false;
    }
}

function stringlength(inputtxt, minlength, maxlength) {
    var field = inputtxt;
    var mnlen = minlength;
    var mxlen = maxlength;

    if (field.length < mnlen || field.length > mxlen) {

        return false;
    }
    else {
        //alert('Your userid have accepted.');
        return true;
    }
}
//clear error
function  clearInputError(input) { 
    input.removeClass("parsley-error");
   input.nextAll(':has(.parsley-required):first').find('.parsley-required').html("");    
    return true;
}
$(document).ready(function () {
//  customer

function validateinput(input, minlength, maxlength, emptyMsg, lengthMsg) {

    //var input = $(this);
    input.removeClass("is-invalid");
    input.nextAll('.alert-danger:first').attr("hidden", true).empty();
    if (!required(input.val())) {
        input.addClass("is-invalid");
        input.nextAll('.alert-danger:first').attr("hidden", false).append(emptyMsg);
        return false;

    } else if (!stringlength(input.val(), minlength, maxlength)) {
        input.addClass("is-invalid");
        input.nextAll('.alert-danger:first').attr("hidden", false).append(lengthMsg);
        return false;
    }
    return true;
}

function validateNumber(input) {

    //var input = $(this);
    input.removeClass("is-invalid");
    input.nextAll('.alert-danger:first').attr("hidden", true).empty();
    if (!allnumeric(input.val())) {
        input.addClass("is-invalid");
        input.nextAll('.alert-danger:first').attr("hidden", false).append(NotNumericMsg);
        return false;
    }
    return true;
}
function validateinputlength(input, minlength, maxlength, msg) {

    //var input = $(this);
    input.removeClass("is-invalid");
    input.nextAll('.alert-danger:first').attr("hidden", true).empty();
    if (!stringlength(input.val(), minlength, maxlength)) {
        input.addClass("is-invalid");
        msg = msg.replace("[[min]]", minlength.toString());
        msg = msg.replace("[[max]]", maxlength.toString());
        input.nextAll('.alert-danger:first').attr("hidden", false).append(msg);
        return false;
    }
    return true;
}



//check valid in form
//name
// $("form#customerform input[name=name]").focusout(function (e) {
//     if (!validateinput($(this), 1, 100, emptyMsg, lengthMsg)) {
//         tmpchk = tmpchk && false;
//         return false;
//     } else {
//         tmpchk = tmpchk && true;
//         return true;
//     }

// });
 

});
    /////////////////////////////////////////////////////
 