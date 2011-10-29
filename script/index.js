
$(document).ready(function()
{
	$("#new_chat_button").click( function()
		{
			 window.open( "chat.php?name=" + $("#chatter_name").attr("value") );
		});
});
