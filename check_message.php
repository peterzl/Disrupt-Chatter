<?php
	include_once "memcached.php";
	
	class response
	{
		public $name_list;
		public $chat_pool;
	}
	
	$currentCache = new cache;
	$currentCache->load();
	//var_dump( $currentCache );
	$result = new response;
	$result->name_list = $currentCache->chat[$_POST["id"]]->name_list;
	if ( $currentCache->chat[$_POST["id"]]->chat_pool[$_POST["name"]] )
	{
	 	$result->chat_pool = $currentCache->chat[$_POST["id"]]->chat_pool[$_POST["name"]];
		$currentCache->chat[$_POST["id"]]->chat_pool[$_POST["name"]] = array();
		$currentCache->update();
	}
	echo json_encode( $result );
?>
