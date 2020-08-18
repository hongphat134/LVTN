$('.theo-doi').click(function(){	
	if($(this).hasClass('follow-rec')){	
		$(this).removeClass('btn-outline-danger follow-rec');	
		$(this).text('ĐANG THEO DÕI');
		$(this).addClass('btn-danger');	
		
		let id = $(this).attr('id');		
		if(id != ''){
			$.ajax({
				url: "/nguoitimviec/save-rec/" + id,
				type: "get",				
				success:function(data){
					console.log(data);
				}				
			});	
		} 
		else console.log('Lỗi get ID NTD');
	}
	else{		
		$(this).removeClass('btn-danger');	
		$(this).addClass('btn-outline-danger follow-rec');
		$(this).text('THEO DÕI');
		let id = $(this).attr('id');		
		if(id != ''){
			$.ajax({
				url: "/nguoitimviec/unsave-rec/" + id,
				type: "get",				
				success:function(data){
					console.log(data);
				}				
			});	
		} 
		else console.log('Lỗi get ID NTD');		
	}
});


