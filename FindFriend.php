<?php


$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};

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
		$json = array('result' => 'result');
		$json['friendInfo'][]= array('ID' => $ID,'NAME'=>($redis->hget($ID,'NAME')),'PROFILEIMAGE'=>($redis->hget($ID,'PROFILEIMAGE')));
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
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




?>