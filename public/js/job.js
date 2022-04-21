$("#des-job").click(function(){
	// $(this).fadeIn(2000,"slow",function(){
	// });	
	$(this).before('<input type="text" name="des_job[]" class="form-control" placeholder="Nội dung...">');
});

$("#benefit").click(function(){
	$(this).before('<input type="text" name="benefit[]" class="form-control" id="company-name" placeholder="Nội dung...">');
});

$("#info-contact").click(function(){
	$(this).before('<input type="text" name="info_contact[]" class="form-control" id="company-name" placeholder="Thông tin...">');
});

$("#info-plus").click(function(){
	$(this).before('<input type="text" name="info_plus[]" class="form-control" id="company-name" placeholder="Thông tin...">');
});

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

// PREVIEW
function transName(name){
	switch(name){
		case 'job':
			return 'ngành nghề';
		case 'deadline':
			return 'hạn tuyển dụng';
		case 'degree':
			return 'bằng cấp';
		case 'rank':
			return 'cấp bậc';		
		case 'exp':
			return 'số năm kinh nghiệm'; 
		case 'vacancy':
			return 'số lượng tuyển dụng'; 
		case 'salary':
			return 'mức lương'; 
		case 'website':
			return 'website công ty';		
		default:
			break;
	}
}

function transPreview(name,value){
	switch(name){
		case 'job':
			return '<strong class="text-black">Ngành nghề: <span class="badge badge-danger">' + value + '</span></strong>';
		case 'deadline':
			return '<strong class="text-black">Hạn tuyển dụng: <span class="badge badge-dark">' + (new Date(value)).toLocaleDateString("vi-VN") + '</span></strong>';
		case 'degree':
			return '<strong class="text-black">Yêu cầu bằng cấp: <span class="badge badge-info">' + value + '</span></strong>';
		case 'rank':
			return '<strong class="text-black">Vị trí cần tuyển: <span class="badge badge-secondary">' + value + '</span></strong>';
		case 'exp':
			return '<strong class="text-black">Vị trí cần tuyển: <span class="badge badge-primary">' + value + '</span></strong>';
		case 'vacancy':
			return '<strong class="text-black">Số lượng tuyển dụng: <span class="badge badge-warning">' + value + ' người</span></strong>';
		case 'salary':
			return '<strong class="text-black">Mức lương: <span class="badge badge-danger">' + value + '</span></strong>';		
		case 'gender':
			return '<strong class="text-black">Yêu cầu giới tính: <span class="badge badge-info">' + value + '</span></strong>';
		case 'status':
			return '<strong class="text-black">Hình thức làm việc: <span class="badge badge-primary">' + value + '</span></strong>';
		case 'probation':
			return '<strong class="text-black">Thời gian thử việc: <span class="badge badge-danger">' + value + '</span></strong>';
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
	var f = $("#post-job").serializeArray();
	// console.log(f);

	var skillStr = $("#skill-list :selected").text();
	if(skillStr.length != 0){
		$('#skill-preview').html('');
		skillStr = perfectTrim(skillStr);
		skillStr = skillStr.split("\n");
		$("#skill-preview").append('<strong class="text-black">Yêu cầu kĩ năng:</strong> ');
		skillStr.forEach( element => {			
			$("#skill-preview").append('<span class="badge badge-pill badge-info">' + element + '</span> ');		
		});
	}
	else $('#skill-preview').html('<div class="alert alert-danger">Chưa có kỹ năng!</div>');

	var regionStr = $("#region-list :selected").text();
	if(regionStr.length != 0){
		$('#region-preview').html('');
		regionStr = perfectTrim(regionStr);
		regionStr = regionStr.split("\n");
		$("#region-preview").append('<strong class="text-black">Khu vực làm việc: </strong> ');
		regionStr.forEach( element => {			
			$("#region-preview").append('<span class="badge badge-pill badge-dark">' + element + '</span> ');		
		});
	}
	else $('#region-preview').html('<div class="alert alert-danger">Chưa có khu vực làm việc!</div>');

	var languageStr = $("#language :selected").text();
	if(languageStr.length != 0){		
		// console.log(languageStr);
		$('#language-preview').html('');
		languageStr = perfectTrim(languageStr);
		languageStr = languageStr.split("\n");	
		
		languageStr.forEach( element => {			
			$("#language-preview").append('<span class="icon-language mr-2"></span> ' + element + '</br>');
		});
	}	

	var itechStr = $("#itech :selected").text();
	if(itechStr.length != 0){
		console.log(itechStr);
		$('#itech-preview').html('');
		itechStr = perfectTrim(itechStr);
		itechStr = itechStr.split("\n");				
		itechStr.forEach( element => {			
			$("#itech-preview").append('<span class="icon-gear mr-2"></span> ' + element + '</br>');
		});
	}	

	// Clear
	$("#des-preview").html('');
	$("#benefit-preview").html('');
	$("#contact-preview").html('');
	$("#plus-preview").html('');
	$.each(f,function(k,v){		
		if(v.name == "des_job[]" && v.value != ''){
			$("#des-preview").append('<p>' + v.value + '</p>');
		}
		else if(v.name == 'benefit[]' && v.value != ''){
			$("#benefit-preview").append('<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' + v.value + '</span></li>');
		}
		else if(v.name == 'info_contact[]' && v.value != ''){
			$("#contact-preview").append('<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' + v.value + '</span></li>');
		}
		else if(v.name == 'info_plus[]' && v.value != ''){			
			$("#plus-preview").append('<li class="d-flex align-items-start mb-2"><span class="icon-check_circle mr-2 text-muted"></span><span>' + v.value + '</span></li>');
		}
		else{
			if(v.name == 'skill[]' || v.name == 'region[]' || v.name == 'language[]' 
				|| v.name == 'itech[]' || v.name =='des_job[]' || v.name =='benefit[]'
				|| v.name == 'info_contact[]' || v.name == 'info_plus[]') ;
			else{
				$('#' + v.name + '-preview').html(v.value ? transPreview(v.name,v.value)
				: '<div class="alert alert-danger">Chưa có ' + transName(v.name) + '!</div>');		
			}		
		}	
	});
});

$(".has-error").click(function(){
	$(this).removeClass('has-error');
	$(this).unbind('click');
	// console.log($(this).children(":last-child"));
	$(this).children(":last-child").remove();
});