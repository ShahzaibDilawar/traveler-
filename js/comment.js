
$(".commentForm").unbind().bind('submit',function(){
	var form = $(this);
	var url = form.attr('action');
	var type = form.attr('method');

	$.ajax({
		url:url,
		type:type,
		data:form.serialize(),
		dataType:'text',
		success:function(data){
			$("#getFeeds").html(data);
			//alert(data);
		}

	});
	return false;
});