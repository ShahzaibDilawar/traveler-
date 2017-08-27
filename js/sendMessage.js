$("#sendMessageForm").unbind().bind('submit',function(){
	var form = $(this);
	var url = form.attr('action');
	var type = form.attr('method');

	$.ajax({
		url:url,
		type:type,
		data:form.serialize(),
		dataType:'text',
		success:function(data){
			$("#mychatBody").html(data);
			$("#msgTextarea").val('');
			$("#mychatBody").scrollTop($("#mychatBody").prop('scrollHeight'));
			

		}

	});
	return false;
});