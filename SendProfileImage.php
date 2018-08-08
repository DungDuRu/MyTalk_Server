
<?php
//폴더 및 하위 경로의 모든 것 각제하는 함수
function rmdir_ok($dir) {
		$dirs = dir($dir);
		while(false !== ($entry = $dirs->read())) {
				if(($entry != '.') && ($entry != '..')) {
						if(is_dir($dir.'/'.$entry)) {
									rmdir_ok($dir.'/'.$entry);
						} else {
									@unlink($dir.'/'.$entry);
						}
				}
		}
		$dirs->close();
		@rmdir($dir);
}

function delete_all($dir) {
	    $d = @dir($dir);
	    while ($entry = $d->read()) {
	        if ($entry == "." || $entry == "..") continue;
        if (is_dir($entry)) delete_all($entry);
	        else unlink($dir."/".$entry);
	    }

	    // 해당디렉토리도 삭제할 경우에는 아래 주석처리를 해제합니다.
	    //unlink($dir);
	}

	$userid = $_POST['userid'];
	// if(is_file('./ProfileImage/'.$userid.'.png')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid.".png");		//파일 삭제하는 메서드
	// }
	// else if(is_file('./ProfileImage/'.$userid.'jpg')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid."jpg");		//파일 삭제하는 메서드
	// }
	// else if(is_file('./ProfileImage/'.$userid.'jpeg')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid."jpeg");		//파일 삭제하는 메서드
	// }else if(is_file('./ProfileImage/'.$userid.'.JPG')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid.".JPG");		//파일 삭제하는 메서드
	// }
	// else if(is_file('./ProfileImage/'.$userid.'JPEG')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid."JPEG");		//파일 삭제하는 메서드
	// }else if(is_file('./ProfileImage/'.$userid.'.PNG')){	//파일 존재여부 확인
	// 	unlink("./ProfileImage/".$userid.".PNG");		//파일 삭제하는 메서드
	// }

 $mydir = './ProfileImage/'.$userid;
 $mydir_mini = './MiniProfileImage/'.$userid;

	if(!is_dir($mydir)) {
        chmod($mydir, 0777);
				if(mkdir($mydir, 0777)){
						chmod($mydir, 0777);
					}
			}
	else{
				chmod($mydir, 0777);
				delete_all($mydir);
			}
	if(!is_dir($mydir_mini)) {
		        chmod($mydir_mini, 0777);
						if(mkdir($mydir_mini, 0777)){
								chmod($mydir_mini, 0777);
							}
			}
			else{
				chmod($mydir_mini, 0777);
				delete_all($mydir_mini);
			}



	 $origin_fileName = $_FILES["uploaded_file1"]["name"]; //일단 파일이름을 받아서
	 $cropped_fileName = $_FILES["uploaded_file2"]["name"];

 // 	$ext = "." . end(explode(".", $origin_fileName));	//확장자명만 땡겨온다.
    // $file_path = "ProfileImage/";
 // 	$file_path2 = "MiniProfileImage/";
 //    echo $_FILES["uploaded_file"]['error'];
 //   $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
 // $file_path = $mydir.$userid.".PNG";
 // $file_path2 =$mydir_mini.$userid.".PNG";

 $file_path = $mydir.'/'.$origin_fileName;
 $file_path2 =$mydir_mini.'/'.$cropped_fileName;
    if(move_uploaded_file($_FILES['uploaded_file1']['tmp_name'],  $file_path) &&  move_uploaded_file($_FILES['uploaded_file2']['tmp_name'], $file_path2)){
 	try {
 			$redis=new Redis() or die("Can not load redis.");
 			$redis->connect('127.0.0.1');
 			$redis->auth('tken3721?!');
 				if ( !$redis->select(0) ){
 					exit( "NOT DB Select");
 					}

 		// 	$redis-> hset($userid,'PROFILEIMAGE',$userid.$ext);
			$redis-> hset($userid,'PROFILEIMAGE',$cropped_fileName);
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
