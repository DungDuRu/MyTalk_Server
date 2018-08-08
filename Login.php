<?php


$json = file_get_contents('php://input');
$obj = json_decode($json);
$ID = $obj->{'ID'};
$PW = $obj->{'PW'};

// $ID ='kst21@naver.com';
// $PW = 'a';

try {
	$redis=new Redis() or die("Can not load redis.");
	$redis->connect('127.0.0.1');
	$redis->auth('tken3721?!');
	if ( !$redis->select(0) ){
    exit( "NOT DB Select");
	}
	if($redis->exists($ID))
	{
		if(($redis->hget($ID,'PW')) == $PW){
			$json = array('result' => '로그인성공');
			$json['userInfo'][]= $redis->hgetall($ID);


			/*
			echo "로그인성공"."/";
			echo $ID."/";
			echo $redis->hget($ID,'PW'). "/";
			echo $redis->hget($ID,'NAME')."/";
			echo $redis->hget($ID,'PHONE')."/";
			echo $redis->hget($ID,'PROFILEIMAGE');
			*/
			echo json_encode($json,JSON_UNESCAPED_UNICODE);
		} else{
			$json = array('result' => '비밀번호불일치');
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
		}

		$redis->close();
	}
	else
	{
		$json = array('result' => '아이디불일치');
		echo json_encode($json,JSON_UNESCAPED_UNICODE);
		$redis->close();
	}

} catch (Exception $e) {
    exit( "Cannot connect to redis server : ".$e->getMessage() );
}
?>
