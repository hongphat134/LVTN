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
		case 'website':
			return '<strong class="text-black">Website công ty: <span class="badge badge-dark">' + value + '</span></strong>';
		case 'gender':
			return '<strong class="text-black">Yêu cầu giới tính: <span class="badge badge-info">' + value + '</span></strong>';
		case 'status':
			return '<strong class="text-black">Hình thức làm việc: <span class="badge badge-primary">' + value + '</span></strong>';
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
	console.log(f);

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

	var languageStr = $("#language-list :selected").text();
	if(languageStr.length != 0){		
		$('#language-preview').html('');
		languageStr = perfectTrim(languageStr);
		languageStr = languageStr.split("\n");
		$("#language-preview").append('<strong class="text-black">Yêu cầu ngoại ngữ: </strong> ');

		languageStr.forEach( element => {			
			$("#language-preview").append('<span class="badge badge-pill badge-secondary">' + element + '</span> ');
		});
	}
	else $('#language-preview').html('<div class="alert alert-danger">Chưa có yêu cầu ngoại ngữ!</div>');

	var itechStr = $("#itech-list :selected").text();
	if(itechStr.length != 0){
		$('#itech-preview').html('');
		itechStr = perfectTrim(itechStr);
		itechStr = itechStr.split("\n");
		$("#itech-preview").append('<strong class="text-black">Yêu cầu tin học: </strong> ');
		itechStr.forEach( element => {			
			$("#itech-preview").append('<span class="badge badge-pill badge-dark">' + element + '</span> ');		
		});
	}
	else $('#itech-preview').html('<div class="alert alert-danger">Chưa có yêu cầu trình độ tin học!</div>');

	// Clear
	$("#des-preview").html('');
	$("#benefit-preview").html('');
	$("#contact-preview").html('');
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
		else{
			if(v.name == 'skill[]' || v.name == 'region[]' || v.name == 'language[]' 
				|| v.name == 'itech[]' || v.name =='des_job[]' || v.name =='benefit[]'
				|| v.name == 'info_contact[]') ;
			else{
				$('#' + v.name + '-preview').html(v.value ? transPreview(v.name,v.value)
				: '<div class="alert alert-danger">Chưa có ' + transName(v.name) + '!</div>');		
			}		
		}	
	});
});