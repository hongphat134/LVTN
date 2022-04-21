$('.follow a').click(function(){
	var origin = ''; var str = window.location.origin;
	if(str.indexOf("localhost") > 0){
		var ten_folder_goc = 'LVTN';
		origin = window.location.origin + '/' + ten_folder_goc + '/public';	
	} 

	if($(this).hasClass('follow-news')){
		// console.log($(this).attr('id'));
		$(".follow a").removeClass('btn-light follow-news');		
		$(".follow a").html('<span class="icon-heart mr-2 text-danger"></span>Đang theo dõi');	
		let id = $(this).attr('id');

		

		$.ajax({
			url: origin + "/nguoitimviec/save-job/" + id,
			type: "get",
			// data: "",
			success:function(data){
				console.log(data);
			},
			error:function(){

			}
		});
	}
	else{
		// console.log($(this).attr('id'));			
		$(".follow a").addClass('btn-light follow-news');
		$(".follow a").html('<span class="icon-heart-o mr-2 text-danger"></span>Theo dõi tin tuyển dụng');	
		let id = $(this).attr('id');
		$.ajax({
			url: origin + "/nguoitimviec/unsave-job/" + id,
			type: "get",
			success:function(data){
				console.log(data);
			},
			error:function(){

			}
		});
	}
	$(".follow a").toggleClass('btn-dark');	
});


