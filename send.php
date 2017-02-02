<?php
session_start();
$roomid = htmlspecialchars($_POST['roomid']);
$userid = htmlspecialchars($_POST['userid']);
$request = htmlspecialchars($_POST['request']);

if ($roomid != NULL && $userid != NULL && $request != NULL) {
	$fp = fopen("chatlog.txt", "a");
		fwrite($fp, $roomid." ".$userid." ".$request."\n");
}
?>