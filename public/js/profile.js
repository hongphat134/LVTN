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
		console.log("Yes, you've choosen Other Title!");
		$("#other_title").css('display','block');
	}
	else{
		$("#other_title").css('display','none');
		$("#other_title input[type='text']").val('');
	}	
});

function transPreview(name){
	switch(name){
		case 'name':
			return 'tên';
		case 'email':
			return 'email liên hệ';
		case 'degree':
			return 'bằng cấp';
		case 'rank':
			return 'cấp bậc';
		case 'marital_stt':
			return 'tình trạng hôn nhân';
		case 'region':
			return 'khu vực làm việc';
		case 'status':
			return 'hình thức làm việc';
		case 'target':
			return 'mục tiêu';
		case 'talent':
			return 'sở trường';			
		case 'exp':
			return 'số năm kinh nghiệm'; 
		case 'salary':
			return 'mức lương mong muốn';
		case 'title':
			return 'ngành nghề'; 
		default:
			break;
	}
}
function perfectTrim(x) {
  return x.replace(/^\s+|\s+$/gm,'');
}
function jsUcfirst(string)
{
	return string.charAt(0).toUpperCase() + string.slice(1);
}
// PREVIEW
$(".preview").click(function(){
	var f = $("#profile").serializeArray();
	// console.log(f);		
	
	// Clear html for multi selectpicker
	$('#skill-preview').html('');
	$('#language-preview').html('');
	$('#itech-preview').html('');

	var str = $("#skill-list :selected").text();
	if(str.length != 0){
		str = perfectTrim(str);
		str = str.split("\n");
		str.forEach( element => {
		let html = '<li><a href="#">' + element + ' <span class="icon-wb_sunny"></span></a></li>';
			$('#skill-preview').append(html);		
		});
	}	
	
	// Các multi select ko chọn sẽ k có trường
	// bao gồm: Kĩ năng, ngoại ngữ, tin học
	$.each(f,function(k,v){		
		// console.log(v.name);
		// Chi hiện ID , chưa có tên
		if(v.name == 'skill[]');		
		else if(v.name == 'language[]' || v.name == 'other_language'){			
			if(v.name == 'other_language' && v.value != '') $("#language-preview").append('<li><a href="#">Ngôn ngữ khác <span class="icon-star"></span></a></li>');
			else if(v.value != 'other' && v.value != ''){
				let html = '<li><a href="#">' + v.value + ' <span class="icon-star"></span></a></li>';
				$('#language-preview').append(html);
			} 
		}
		else if(v.name == 'itech[]' || v.name == 'other_itech'){
			if(v.name == 'other_itech' && v.value != '') $("#itech-preview").append('<li><a href="#">Phần mềm khác <span class="icon-star"></span></a></li>');
			else if(v.value != 'other' && v.value != ''){
				let html = '<li><a href="#">' + v.value + ' <span class="icon-check"></span></a></li>';
				$('#itech-preview').append(html);	
			}			
		}
		else{
			if(v.name == 'other_title' && v.value != ''){				
				v.name = 'title';	
			} 							
			if(v.value == 'other') v.value = '';

			if(v.name == 'target' || v.name == 'talent')
			$('#' + v.name + '-preview').html(
				v.value? jsUcfirst('<strong>' + transPreview(v.name) + ':</strong></br> <pre>' + v.value + '</pre>') : '<div class="alert alert-dark">Chưa có ' + transPreview(v.name) + '!</div>');					
			else
			$('#' + v.name + '-preview').html(
				v.value? jsUcfirst(transPreview(v.name) + ': ' + v.value) : '<div class="alert alert-danger">Chưa có ' + transPreview(v.name) + '!</div>');	
		}		
	});
});

$(".has-error").click(function(){
	$(this).removeClass('has-error');
	$(this).unbind('click');
	// console.log($(this).children(":last-child"));
	$(this).children(":last-child").remove();
});