<?php
	$memCached = memcache_connect("127.0.0.1", 11211);
	
	//$memCached->flush();
	
	class chat_class
	{
	    public $name_list; 	//array
	    public $chat_pool; 	//array $chat_pool["name"][3]
	}
	
	class cache
	{
	    public $waiting_list;
	    public $chat_count;
	    public $chat; //chat

	    function __construct()
	    {
	
	    }
		
		function __destruct()
	    {	
	    }
	    
	    function update()
	    {
	    	global $memCached;
	    	memcache_set( $memCached, "disrupt_chatter", json_encode( $this ), 0, 0 );
	    }
	    
	    function load()
	    {
	    	global $memCached;
	    	
	    	$result = json_decode( memcache_get( $memCached, "disrupt_chatter" ), true );
	    	if ( isset( $result["waiting_list"] ) )
	    		$this->waiting_list = $result["waiting_list"];
	    	else
	    		$this->waiting_list = "";
	    	if ( isset( $result["chat"] ) )
	    	{
	    		foreach ( $result["chat"] as $chatID => $value )
	    		{
	    			$this->chat[$chatID] = new chat_class;
	    			$this->chat[$chatID]->name_list = $value["name_list"];
	    			$this->chat[$chatID]->chat_pool = $value["chat_pool"];
				}
				$this->chat_count = count( $this->chat );
	    	}
	    	$this->chat_count = 0;
	    }
	}

?>