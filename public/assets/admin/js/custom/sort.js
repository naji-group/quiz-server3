$(document).ready(function () {

	$('#btn-addtolist').on('click', function (e) {
		e.preventDefault();	
		var option = $('#page_id').find(":selected").val(); 
		var optiontext = $('#page_id').find(":selected").text();
		if(option!=0){		 
		appendrow(option,optiontext);
		$('#page_id').find(":selected").remove();
		}
		// alert( option +'-'+optiontext);
});

		$('#btn_update_sort').click(function(e){		 
			 e.preventDefault();
			 updatesort();
			  });

			  function updatesort(){		 
				//startLoading();
				var serializedData = window.JSON.stringify($('.dd').nestable('serialize'));
			 //   alert(serializedData);
				$.ajaxSetup({
				  headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				  }
				});
			//  var urlval='<?php echo route("contacts.show",":contactid:"); ?>';
				
				$.ajax({
				   
				  url: urlval,//from sort page              
				  type: "POST",
				  data: serializedData,
				  contentType: 'application/json',
					success: function(result){
						swal( "تم الحفظ بنجاح");
					},
					error: function(jqXHR, textStatus, errorThrown) {
						//endLoading();
						swal( "لم يتم الحفظ ");
					   noteError();
					// alert(jqXHR.responseText);
					  // $('#errormsg').html(jqXHR.responseText);
					 // $('#errormsg').html("Error");
					}
				
				});
				 };
 
function ClearErrors() {

    $('.error').html('');
    $(":input").removeClass('is-invalid');     
}
function noteSuccess() {
	toastr.success("Sucsess");	 
}
function noteError() {
	//toastr.error("Faild");		 
}
 
 //show list
 function sortList() {
               
	$.ajax({		 
		url: urlget,
		type: "GET",
		contentType: 'application/json',
		success: function(data) {
			$('#errormsg').html('');
			$('#sortbody').html('');
			if (data.length == 0) {
				$('#sortbody').html('<div class="dd" id="sortbody"><ol class="dd-list"></ol></div>');
			} else {
				fillsortlist(data, $('#sortbody'));
			}
			// $('.alert').html(result.success);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			//   alert(jqXHR.responseText);
			// $('#errormsg').html(jqXHR.responseText);
			$('#errormsg').html("Error");
		}
	});};
sortList();
function fillsortlist(data, $root) {
	var $ul = $('<ol class="dd-list">');
	$.each(data, function(_, item) {
		var $li = $('<li class="dd-item" data-id="' + item.id + '">');
		var $btncollapse = $(
			'<button data-action="collapse" type="button" style="display: block;">').text(
			'Collapse');
		var $btnexpand = $('<button data-action="expand" type="button" style="display: none;">')
			.text('Expand');

		//	var $divb = $('<div class="btn-div">');
			var $btndel = $(
				'<button onclick="delsort(this);" class="btn-del" style="display: block;">');
				var itag='<i class="fas fa-times" style="font-size:16px;color:red;"></i>';
				$btndel.append(itag);
				//$divb.append($btndel);//temp
			$li.append($btndel);//temp


		if (item.children && item.children.length) {
			$li.append($btncollapse);
			$li.append($btnexpand);
		}
		//var $divhandle = $('<div class="dd-handle">').html(item.name+'<a href=""  class="del-sort"><i class="fas fa-times" style="font-size:16px;color:red;float: left;"></i></a>');
	 var $divhandle = $('<div class="dd-handle">').html(item.name);
	 $li.append($divhandle);
		//$li.append($divhandle);
		if (item.children && item.children.length) {
			$li.append(fillsortlist(item.children));
		}
		$ul.append($li);
		 });
	return $root ? $root.html($ul) : $ul;
}
function appendrow(itemid,itemname) {
//	var $ul = $('<ol class="dd-list">').html(); 
	var $ul = $('.dd-list'); 
		var $li = $('<li class="dd-item" data-id="' + itemid + '">');
		var $btncollapse = $(
			'<button data-action="collapse" type="button" style="display: block;">').text(
			'Collapse');
		var $btnexpand = $('<button data-action="expand" type="button" style="display: none;">')
			.text('Expand');
		// if (item.children && item.children.length) {
		// 	$li.append($btncollapse);
		// 	$li.append($btnexpand);
		// }
		//var $divhandle = $('<div class="dd-handle">').html(itemname+'<a  href=""  class="del-sort"><i class="fas fa-times" style="font-size:16px;color:red;float: left;"></i></a>');
		var $btndel = $(
			'<button onclick="delsort(this);" class="btn-del" style="display: block;">');
			var itag='<i class="fas fa-times" style="font-size:16px;color:red;"></i>';
			$btndel.append(itag);
			//$divb.append($btndel);//temp
		$li.append($btndel);//temp

		var $divhandle = $('<div class="dd-handle">').html(itemname);
	
		$li.append($divhandle);
	 
		// if (item.children && item.children.length) {
		// 	$li.append(fillsortlist(item.children));
		// }
		$ul.append($li);
		$('#sortbody').html($ul);
	// return $root ? $root.html($ul) : $ul;
}
//pages combo
function loadpages() {		 
	//	resetForm();
		ClearErrors();
	 var choose='اختر الصفحة';	 
		 $('#page_id').html('<option title="اختر الصفحة" value="0"  class="text-muted">'+choose+'</option>');
 	$.ajax({
	url:fillselurl,
	type: "GET",  
//	contentType: false,
//	processData: false,
	//contentType: 'application/json',
	success: function (data) {			 
		if (data.length == 0) {			 
		} else   {
			datalist=data;
			$(data).each(function(index, item) {
				$('#page_id').append('<option value="'+ item.id +'" >'+ item.name +'</option>');
		});		 
		}		 
	}, error: function (errorresult) {			 
	} 
});

	};

	loadpages() ;
	
 
});

function delsort(button) {
	var listItem = button.parentNode;
	var dataId = listItem.getAttribute('data-id');
	var handleText = listItem.querySelector('.dd-handle').textContent;
	//delete
	listItem.parentNode.removeChild(listItem);
	// add to select
	var select = document.getElementById('page_id');
	var option = document.createElement('option');
	option.value = dataId;
	option.textContent = handleText;
	select.appendChild(option);
}
 
 