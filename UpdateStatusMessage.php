<?php


$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};
$STATUSMESSAGE = $obj->{'STATUSMESSAGE'};

//$ID=$_POST['ID'];
//$PW = (int)$_POST['PW'];
//$NAME=$_POST['NAME'];
//$PHONE=$_POST['PHONE'];
//$PROFILEIMAGE=$_POST['PROFILEIMAGE'];
/*
$ID = 'tjsxo21@naver.com';
$PW = 'tken3721';
$NAME = '김선태';
$PHONE = '010-9958-8734';
$PROFILEIMAGE = 'default';
$JOINDATE = date("Ymd");
*/
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
		$redis-> hset($ID,'STATUSMESSAGE',$STATUSMESSAGE);
		echo "UpdateSuccess";
		$redis->close();
	}
} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}




?>
