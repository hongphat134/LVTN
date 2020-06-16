$('.follow-news').click(function(){
	if($(this).hasClass('follow-news')){
		// console.log($(this).attr('id'));
		$(this).removeClass('btn-light follow-news');		
		$(this).html('<span class="icon-heart mr-2 text-danger"></span>Đang theo dõi');	
		let id = $(this).attr('id');
		$.ajax({
			url: "/nguoitimviec/save-job/" + id,
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
		$(this).addClass('btn-light follow-news');
		$(this).html('<span class="icon-heart-o mr-2 text-danger"></span>Theo dõi tin tuyển dụng');	
		let id = $(this).attr('id');
		$.ajax({
			url: "/nguoitimviec/unsave-job/" + id,
			type: "get",
			success:function(data){
				console.log(data);
			},
			error:function(){

			}
		});
	}
	$(this).toggleClass('btn-dark');	
});


