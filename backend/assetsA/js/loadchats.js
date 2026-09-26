/* function loadchats(id) {
	var userid = id;
	var action = "load";
		
	$.ajax({
		url: "php/ajax/get-messages.php",
		method: "POST",
		data: {action: action, userid: userid},
		success: function(result)
		{
			$("#load-all-messages").html(result);
			setInterval( function() 
			{
				loadchats(userid)
			}, 5000);
		}
	});
} */