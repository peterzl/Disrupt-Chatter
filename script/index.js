
$(document).ready(function()
{
	function open_chat()
	{
		window.open( "chat.php?name=" + $("#chatter_name").attr("value") );
	}
	$("#new_chat_button").click( function()
		{
			 open_chat();
		});
		
		
	$("input").bind("keydown", function(event) {
      var keycode = (event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode));
      if (keycode == 13)
      { // keycode for enter key
         open_chat();
         return false;
      } else  {
         return true;
      }
   });
});
