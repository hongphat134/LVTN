$("#language").change(function(){
	// console.log($(this).children("option:selected:last").val());

	var obj = $(this).children("option:selected:last").val();
	// Chèn mục other vào
	if(obj == 'other'){		
		// console.log("Yes");
		$("#other_language").css('display','block');
	}
	// Áp dụng cho MULTI SELECT
	var vals = $(this).val();
	// Nếu bỏ chọn other thì đóng lại
	if(jQuery.inArray('other',vals) < 0) $("#other_language").css('display','none');
})

$("#itech").change(function(){
	// console.log($(this).children("option:selected:last").val());

	var obj = $(this).children("option:selected:last").val();
	// Chèn mục other vào
	if(obj == 'other'){		
		// console.log("Yes");
		$("#other_itech").css('display','block');
	}

	var vals = $(this).val();
	// Nếu bỏ chọn other thì đóng lại
	if(jQuery.inArray('other',vals) < 0) $("#other_itech").css('display','none');
})

$("#title").change(function(){
	// console.log($(this).children("option:selected:last").val());

	var obj = $(this).children("option:selected:last").val();
	// Chèn mục other vào
	if(obj == 'other'){		
		console.log("Yes");
		$("#other_title").css('display','block');
	}
	else{
		$("#other_title").css('display','none');
	}	
})