<?php
	include_once "memcached.php";

	$currentCache = new cache;
	$currentCache->load();

	$foundChatter = false;
	$existingChatter = false;
	$id = "";
	foreach ( $currentCache->chat as $currentChatID => $chat )
	{
		if ( count( $chat->name_list ) == 1 )
		{
			if ( $chat->name_list[0] != $_GET["name"] )
			{
				$chat->name_list[1] = $_GET["name"];
				$id = $currentChatID;
				$foundChatter = true;
			}
			else
				$existingChatter = true;
		}
	}
	
	if ( ( !$foundChatter ) && ( !$existingChatter ) )
	{
		
		$id = md5( rand(1, 1000000000) + "disruptsecret" );
		$currentCache->chat[$id] = new chat_class;
		$currentCache->chat[$id]->name_list = array( $_GET["name"] );
		$currentCache->chat[$id]->chat_pool = array();
	}
	

?>

<html>
	<head>
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
		<link rel="stylesheet" type="text/css" href="css/chat.css" />
		<script src="script/3rd-party/jquery-1.6.4.min.js" type=""text/javascript"></script>
		<script type="text/javascript">
			var chatID = <?php echo "'".$id."'" ?>;
			var name = <?php echo "'".$_GET["name"]."'" ?>;
		</script>
		<script src="script/chat.js" type="text/javascript"></script>
		<title>Chatter Window</title>
		</script>
	</head>
	<body>
		<div id="page_wrapper">
			<?php
				if ( $existingChatter )
				{
					echo "<div id=\"title_part\">An existing waiting window is already opened</div>";
					die();
				}
				else if ( count( $currentCache->chat[$id]->name_list ) == 1 )
				{
					echo "<div id=\"title_part\">Waiting for another chatter to come</div>";
					$currentCache->waiting_list = $_GET["name"];
				}
				else
				{
					echo "<div id=\"title_part\">Chatting with ".$currentCache->waiting_list.", ".$_GET["name"]."</div>";
					$currentCache->waiting_list = "";
				}
			?>
			<div id="body_part">Welcome to Disrupt Chatter!</div>
			<div id="chat_part">I say:<input type="text" value="" id="chat_content">
		</div>
	</body>
</html>

<?php
	$currentCache->update();
?>
