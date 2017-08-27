$("#loginForm").unbind().bind('submit',function(){
	var form = $(this);
	var url = form.attr('action');
	var type = form.attr('method');

	$.ajax({
		url:url,
		type:type,
		data:form.serialize(),
		dataType:'text',
		success:function(data){
			$("#response").html(data);
		}

	});
	return false;
});

			/* Register */
			$("#registerForm").unbind().bind('submit',function(){
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url:url,
			type:type,
			data:form.serialize(),
			dataType:'text',
			success:function(data){
				$("#response").html(data);
			}

		});
	return false;
		});


