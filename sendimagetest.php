
<?php
	$userid = $_POST['userid'];
	if(is_file('./ProfileImage/'.$userid.'.png')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid.".png");		//파일 삭제하는 메서드
	}
	else if(is_file('./ProfileImage/'.$userid.'jpg')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid."jpg");		//파일 삭제하는 메서드
	}
	else if(is_file('./ProfileImage/'.$userid.'jpeg')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid."jpeg");		//파일 삭제하는 메서드
	}else if(is_file('./ProfileImage/'.$userid.'.JPG')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid.".JPG");		//파일 삭제하는 메서드
	}
	else if(is_file('./ProfileImage/'.$userid.'JPEG')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid."JPEG");		//파일 삭제하는 메서드
	}else if(is_file('./ProfileImage/'.$userid.'.PNG')){	//파일 존재여부 확인
		unlink("./ProfileImage/".$userid.".PNG");		//파일 삭제하는 메서드
	}					

	 $fileName = $_FILES["uploaded_file"]["name"]; //일단 파일이름을 받아서
	 
		$ext = "." . end(explode(".", $fileName));	//확장자명만 땡겨온다.
    $file_path = "ProfileImage/";
 //    echo $_FILES["uploaded_file"]['error'];
 //   $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
 $file_path = $file_path.$userid.$ext;
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
		try {
				$redis=new Redis() or die("Can not load redis."); 
				$redis->connect('127.0.0.1'); 
				$redis->auth('tken3721?!');
					if ( !$redis->select(0) ){
						exit( "NOT DB Select");
						}
		
				$redis-> hset($userid,'PROFILEIMAGE',$userid.$ext);
				$redis->close();
				echo "success";
			} 
		catch (Exception $e) {
				exit( "Cannot connect to redis server : ".$e->getMessage() );
			}
       
    } else{
        echo "fail";
    }
 ?>