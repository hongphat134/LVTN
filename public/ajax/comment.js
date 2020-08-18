// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

$('#cmt-btn').click(function(){
	f = $("#cmt-form").serializeArray();
	// console.log(f);
	
	$.ajax({
		url: "/thanh-vien/binh-luan",
		type: "post",
		data: f,
		dataType: "json",
		success: function(data){
			console.log(data);					
			$(".comment-list").append('<li class="comment"><div class="vcard bio"><img src="http://lvtn.laravel.info/hinhdaidien/person_2.jpg" alt="Image placeholder"></div><div class="comment-body"><h3>' + data.name + '</h3><div class="meta">' + data.created_at + '</div><p>' + data.content + '</p></div></li>');
		}
	});	

	
});
