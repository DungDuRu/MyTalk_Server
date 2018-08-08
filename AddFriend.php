<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};
$FID = $obj->{'FID'};
$for_friend = 'Friend_'.$ID;
//$FID = 'dlstjs45@naver.com';
//$for_friend = 'Friend_tjsxo21@naver.com';

//$json['emp_info'][]=$row;

try {
	$redis=new Redis() or die("Can not load redis."); 
	
	$redis->connect('127.0.0.1'); 
	$redis->auth('tken3721?!');
	if ( !$redis->select(0) ){
    exit( "NOT DB Select");
	}
		$redis->sadd($for_friend,$FID);
		$json = array('result' => 'SUCCESS');
		
		$redis->close();
	
	
} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}
	echo json_encode($json,JSON_UNESCAPED_UNICODE);
?>