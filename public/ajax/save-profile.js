$('.save-profile').click(function(){
	let id = $(this).attr('id');
	// Bỏ lưu
	if($(this).hasClass('active')){
		$(this).removeClass('active');		
		$(this).text('Lưu hồ sơ xin việc');			
		$.ajax({
			url: "/nhatuyendung/unsave-profile/" + id,
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
			url: "/nhatuyendung/save-profile/" + id,
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