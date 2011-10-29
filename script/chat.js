
$(document).ready(function()
{
   	function send_chat()
   	{
   		$.post( "send_message.php", {id:chatID,  name: name, content: $("#chat_content").attr("value") }, function(data, textStatus, XMLHttpRequest)
   		{
   			$("#chat_content").attr( "value", "" );
   			check_chat();
   		});
   	}
   	
   	function check_chat()
   	{
	   		$.post( "check_message.php", {id:chatID,  name: name }, function(data, textStatus, XMLHttpRequest)
	   		{
	   			var obj = $.parseJSON(data);
	   			var html = "<div>Chatting with ";
	   			for ( i = 0; i < obj.name_list.length - 1; i++ )
	   			{
	   				html += obj.name_list[i] + ", ";
	   			}
	   			html += obj.name_list[obj.name_list.length - 1];
	   			html += "</div>";
	   			$( "#title_part" ).html( html );
	   			if ( obj.chat_pool )
	   			{
		   			for ( i = 0; i < obj.chat_pool.length; i++ )
		   			{
		   				$("#body_part").append( "<div>" + obj.chat_pool[i] + "</div>" );
		   			}
	   			}
	   			setTimeout( function(){ check_chat() }, 1000 );
	   		});
   	}

	$("input").bind("keydown", function(event) {
      var keycode = (event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode));
      if (keycode == 13)
      { // keycode for enter key
         send_chat();
         return false;
      } else  {
         return true;
      }
   });
   
   if ( chatID != "" )
		setTimeout( function(){check_chat()}, 1000);
	else
	{
		alert("1");
		$("input").attr("disabled", "disabled" );
	}
});
