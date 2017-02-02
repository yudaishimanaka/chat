<?php
session_start();
$userid = $_SESSION['userid'];
if(is_uploaded_file($_FILES['file_input']['tmp_name'])){
        //一字ファイルを保存ファイルにコピーできたか
	if(move_uploaded_file($_FILES['file_input']['tmp_name'],"./img/".$_FILES['file_input']['name'])){
		$filename2 = 'userinfo.txt';
		chmod($filename2, 0666);
		$fp = fopen($filename2, "r");
		$filename = 'userinfo_new.txt';
		touch($filename);
		chmod($filename, 0666);
		$fp2 = fopen($filename, "a");
		while($line = fgets($fp)){
			$line = split(" ", $line);
				if($line[0] == $userid){
					fwrite($fp2, $line[0]." ".$line[1]." img/".$_FILES['file_input']['name']."\n");
				}else{
					fwrite($fp2, $line[0]." ".$line[1]." ".$line[2]);
				}
		}
		fclose($fp2);
		fclose($fp);
		unlink("userinfo.txt");
		rename("userinfo_new.txt", "userinfo.txt");
            //正常
		echo $_FILES['file_input']['name'];
	}else{
            //コピーに失敗（だいたい、ディレクトリがないか、パーミッションエラー）
		echo "error while saving.";
	}
}else{
        //そもそもファイルが来ていない。
	echo "file not uploaded.";
}
?>