$('.save-profile').click(function(){
	let id = $(this).attr('id');
	var origin = ''; var str = window.location.origin;
	if(str.indexOf("localhost") > 0){
		var ten_folder_goc = 'LVTN';
		origin = window.location.origin + '/' + ten_folder_goc + '/public';	
	} 
	// Bỏ lưu
	if($(this).hasClass('active')){
		$(this).removeClass('active');		
		$(this).text('Lưu hồ sơ xin việc');			
		$.ajax({
			url: origin +  "/nhatuyendung/unsave-profile/" + id,
			type: "get",
			// data: "",
			success:function(data){
				console.log(data);
			},
			error:function(){

			}
		});
	}
	// Lưu
	else{
		$(this).addClass('active');		
		$(this).text('Đã lưu hồ sơ');			
		$.ajax({
			url: origin + "/nhatuyendung/save-profile/" + id,
			type: "get",
			success:function(data){
				console.log(data);
			},
			error:function(){

			}
		});
	}
	// $(this).toggleClass('btn-dark');	
});