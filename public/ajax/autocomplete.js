var curr;
$(document).on('input','#search',function(e){
	// console.log($(this).val());

	var val = $(this).val();

	closeAllLists();

	if(!val) return false;

	curr = -1;

	$.ajax({
		url: "/skill-job/" + val,
		type: "get",
		dataType: "json",
		success: function(data){
			// console.log(data);
			$.each(data,function(key,value){
				$("#job-skill-autocomplete").append('<li class="list-group-item">' + value.ten + '</li>');
			});

			$("#job-skill-autocomplete li").click(function(){
				$("#search").val($(this).text());
				closeAllLists();
			});

			
			// if(data.length < 5){
			// 	console.log(data.length);
			// 	$("#job-skill-autocomplete").css('width', '400px');
			// 	$("#job-skill-autocomplete").css('overflow-y', 'none');
			// }			
		}
	});	


});

$("#search").keyup(function(e){	
	var x = $("#job-skill-autocomplete li");
	if(e.keyCode == 40){
		// console.log("DOWN");

		curr++;
		addActive(x);
	}
	else if(e.keyCode == 38){
		// console.log("UP");

		curr--;
		addActive(x);
	}
	else if(e.keyCode == 13 || e.which == 13){
		
		console.log("ENTER");		
				
		if(curr > -1){
			if(x) x[curr].click();
		}
	}
});

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

$(document).click(function(e){	
	// console.log(e);
	if(e.target.type != 'submit') closeAllLists();		
});

// $('.selectpicker').change(function(){
// 	console.log("Ấn vào r");
// 	closeAllLists();
// });


function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (curr >= x.length) curr = 0;
    if (curr < 0) curr = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[curr].classList.add("active");
}

function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
    x[i].classList.remove("active");
    }
}

function closeAllLists(){
	$("#job-skill-autocomplete").html('');
}