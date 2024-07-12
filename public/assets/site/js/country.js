 
$(document).ready(function () {
//alert( countryurl);
 
	
fillCountry();
 
 
	function fillCountry() {
		$.getJSON(countryurl, function(data){
			//	console.log(data.countries);  
			$("#country").html('<option title="" value="0"   class="text-muted">اختر الدولة</option>');
				$.each(data, function( key,value) {
	  
	 if(selcntry==value.alpha2){
		$("#country").append('<option selected value="' + value.alpha2 + '">'+value.name+'</option>');
				
					}else{
						$("#country").append('<option value="' + value.alpha2 + '">'+value.name+'</option>');
				
					}
					}); // close each()
			}).fail(function(){
				console.log("An error has occurred.");
			});
		}
		 
});

///////////////////////////////////////////////////////
 

