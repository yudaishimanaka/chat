<?php
$roomname = htmlspecialchars($_POST['roomname']);
$roomid = htmlspecialchars($_POST['roomid']);
$pass = htmlspecialchars($_POST['pass']);
$count = 0;

if ($roomname != NULL && $roomid != NULL && $pass != NULL){
	$fp = fopen("roominfo.txt", "r");
	while ($line = fgets($fp)) {
		$line = split(" ", $line);
		if ($line[1] == $roomid) $count++;
	}
	if ($count == 0) {
		$fp2 = fopen("roominfo.txt", "a");
		fwrite($fp2, $roomname." ".$roomid." ".$pass."\n");
		fclose($fp2);
		echo "Room creation succeeded";
	}else{
		echo "Room with the same roomID already exists"."\n";
		echo "Please set a new roomID. .";
	}
}else{
	echo "Have not been entered yet";
}
?>