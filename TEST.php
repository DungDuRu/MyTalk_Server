<?php


//$json = file_get_contents('php://input');
//$obj = json_decode($json);
//$ID = $obj->{'ID'};




		//$json['FRIENDLIST'][]= array('ID' => $ID,'NAME'=>($redis->hget($ID,'NAME')),'PHONE'=>($redis->hget($ID,'PHONE')),'PROFILEIMAGE'=>($redis->hget($ID,'PROFILEIMAGE')));
		$json['FRIENDLIST'][]= array('ID' => 'dlstjs45@naver.com','NAME'=>'김인선','PHONE'=>'01029018734','PROFILEIMAGE'=>'DEFAULT');
		$json['FRIENDLIST'][] = array('ID' => 'kst21@naver.com','NAME'=>'김선태','PHONE'=> '01099588734','PROFILEIMAGE'=> 'DEFAULT');
		$json = json_encode($json,JSON_UNESCAPED_UNICODE);

		echo $json;
		$obj = json_decode($json);
		$friendlist = $obj->{'FRIENDLIST'};
		$friendlist = json_encode($friendlist,JSON_UNESCAPED_UNICODE);
		echo $friendlist;
		/*
$ID = 'tjsxo21@naver.com';
$redis = new Redis();
try {
	$redis=new Redis() or die("Can not load redis."); 
	$redis->connect('127.0.0.1'); 
	$redis->auth('tken3721?!');
	if ( !$redis->select(0) ){
    exit( "NOT DB Select");
}
	if($redis->exists($ID))
	{
		
	
		//$decode = json_decode($json, true);
		
		$redis-> hset($ID,'FRIENDINFO',$json);
		
		//print_r($decode['FRIENDLIST']);
	//echo $decode['FRIENDLIST'][0]['ID'];
	//echo $json;
	var_dump($json);
		$redis->close();
	}
	else
	{
		$json = array('result' => 'noresult');
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
		$redis->close();
	}
	
} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}


*/

?>