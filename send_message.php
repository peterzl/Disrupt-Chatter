<?php
	include_once "memcached.php";
	
	$currentCache = new cache;
	$currentCache->load();
	
	var_dump( $currentCache );
	
	foreach( $currentCache->chat[$_POST["id"]]->name_list as $name )
	{
		$pool_size = count( $currentCache->chat[$_POST["id"]]->chat_pool[$name] );
	    $currentCache->chat[$_POST["id"]]->chat_pool[$name][$pool_size] =  date('h:i:s')." ".$_POST["name"].": ".$_POST["content"];
	}
	
	$currentCache->update();

?>
