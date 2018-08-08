<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};
$for_friend = 'Friend_'.$ID;
//$for_friend = 'Friend_kst21@naver.com';

//$json['emp_info'][]=$row;

try {
	$redis=new Redis() or die("Can not load redis.");
	$redis->connect('127.0.0.1');
	$redis->auth('tken3721?!');
	if ( !$redis->select(0) ){
    exit( "NOT DB Select");
	}
	if($redis->exists($for_friend)){
		$json = array('result' => 'result');
		$ID_ARR = $redis->smembers($for_friend);
		for($i=0; $i<count($ID_ARR); $i++)
		{
		//	echo $ID_ARR[$i];
		//	echo "\n";
			//var_dump($redis->hgetall($ID_ARR[$i])).PHP_EOL;
			//$json['friendInfo'][]= $redis->hgetall($ID_ARR[$i]);
			//$json['friendInfo'][]= array('ID' => $ID_ARR[$i],$redis->hgetall($ID_ARR[$i]));
			$json['friendInfo'][]= array('ID' => $ID_ARR[$i],'NAME'=>($redis->hget($ID_ARR[$i],'NAME')),'PHONE'=>($redis->hget($ID_ARR[$i],'PHONE')),'STATUSMESSAGE'=>($redis->hget($ID_ARR[$i],'STATUSMESSAGE')),'PROFILEIMAGE'=>($redis->hget($ID_ARR[$i],'PROFILEIMAGE')));

		}
		echo json_encode($json,JSON_UNESCAPED_UNICODE);

	}else{
		$json = array('result' => 'noresult');
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
	}
		$redis->close();

} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}
?>
