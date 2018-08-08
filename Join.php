<?php


$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};
$PW = $obj->{'PW'};
$NAME = $obj->{'NAME'};
$PHONE = $obj->{'PHONE'};
$PROFILEIMAGE = $obj->{'PROFILEIMAGE'};
$JOINDATE = date("Ymd");



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
		echo "아이디중복";
		$redis->close();
	}
	else
	{
		$redis-> hset($ID,'PW',$PW);
		$redis-> hset($ID,'NAME',$NAME);
		$redis-> hset($ID,'PHONE',$PHONE);
		$redis-> hset($ID,'PROFILEIMAGE',$PROFILEIMAGE);
		$redis-> hset($ID,'JOINDATE',$JOINDATE);
		echo "가입완료";
		$redis->close();
	}
	
} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}




?>