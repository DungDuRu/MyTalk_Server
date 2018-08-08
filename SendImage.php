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
 
// rmdir_ok('./Image');
 
 $userid = $_POST['userid'];
 $roomnum = $_POST['roomnum'];
 $mydir = './Image/'.$roomnum; 
 
 $fileName = $_FILES["uploaded_file"]["name"];		//파일이름
 $file_path = $mydir .'/'. basename( $_FILES['uploaded_file']['name']);		//저장할 경로
 
 
	if(is_dir($mydir)) { 
        chmod($mydir, 0777); 
		if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
			echo "success/".$roomnum."*".$userid."*".$fileName;
		} else{
				echo "fail/noresult";
		}
    } 
	else{
		 if(mkdir($mydir, 0777)){
			 chmod($mydir, 0777); 
			 if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path) ){
				echo "success/".$roomnum."*".$userid."*".$fileName;
			 } 
			 else{
					echo "fail/noresult";
			 }
		 }
		 else { 
			echo "fail/noresult";
		 } 
	}
 

 ?>