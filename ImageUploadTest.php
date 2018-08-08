
<?php
	if(is_file('./ProfileImage/kst21@naver.com.png')){	//파일 존재여부 확인
		unlink("./ProfileImage/kst21@naver.com.png");		//파일 삭제하는 메서드
	}		
   
    $file_path = "ProfileImage/";
     
    $file_path = $file_path . basename( $_FILES['uploaded_file']['name']);
    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
        echo "success";
    } else{
        echo "fail";
    }
 ?>