
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
		
	
	$("input").focus( function()
	{
		if ( $("input").attr("value") == "Enter Your Name Here" )
			$("input").attr("value", "");
	});
	
	$("input").blur( function()
	{
		if ( $("input").attr("value") == "" )
			$("input").attr("value", "Enter Your Name Here");
	})
	
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
