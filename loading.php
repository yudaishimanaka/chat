<?php
session_start();
$userid = $_SESSION['userid'];
$userID = "";
$roomid = htmlspecialchars($_POST['roomid']);

if (isset($roomid) && $roomid != NUll) {
	$fp = fopen("chatlog.txt", "r");
	$chatlog = array();
	while($line = fgets($fp)){
		$line = split(" ", $line);
		if($line[1] == $userid) $userID = $line[1];
		$line[2] = str_replace(array("\r\n","\n","\r"), '', $line[2]);
		$log = "";
		if ($line[0] == $roomid){
			$log = $line[1].":".$line[2];
			array_push($chatlog, $log);
		}
	}
	$fp2 = fopen("userinfo.txt", "r");
	$infodata = array();
	while ($data = fgets($fp2)){
		$data = split(" ", $data);
		$data[2] = str_replace(array("\r\n","\n","\r"), '', $data[2]);
		$log2 = "";
		$log2 = $data[0].":".$data[2];
		array_push($infodata, $log2);
	}
	foreach ($chatlog as $value) {
		$value = split(":", $value);
		if ($userID == $value[0]) {
			foreach ($infodata as $value2) {
				$value2 = split(":", $value2);
				if ($value[0] == $value2[0]) {
					echo "<div class='chat-box2'><div class='chat-face2'><img src='".$value2[1]."'/></div><div class='chat-area2'><p class='name2'>".$value[0]."</p><div class='chat-hukidashi2'>".$value[1]."</div></div></div>";
				}
			}

		}else{
			foreach ($infodata as $value2) {
				$value2 = split(":", $value2);
				if ($value[0] == $value2[0]) {
					echo "<div class='chat-box'><div class='chat-face'><img src='".$value2[1]."'></div><div class='chat-area'><p class='name'>".$value[0]."</p><div class='chat-hukidashi'>".$value[1]."</div></div></div>";
				}
			}
		}
	}
}
?>