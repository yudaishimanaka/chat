<?php
session_start();
$roomid = htmlspecialchars($_POST['roomid']);
$roompass= htmlspecialchars($_POST['roompass']);
$string = "";
$count = 0;

if (isset($roomid) && $roomid != NULL && isset($roompass) && $roompass != NULL) {
	$fp = fopen("roominfo.txt", "r");
	while ($line = fgets($fp)) {
		$line = split(" ", $line);
		$line[2] = str_replace(array("\r\n","\n","\r"), '', $line[2]);
		if ($roomid === $line[1] && $roompass === $line[2]){
			$count++; 
			$_SESSION['roomname'] = $line[0];
			$_SESSION['roomid'] = $line[1];
		}
	}
	if ($count == 0) {
		$string = "Room does not exist<br>";
	}else{
		header('Location: chat.php');
		exit();
	}
	fclose($fp);
}else{
	$string = "Have not been entered yet<br>";
}
?>
<html>
<head>
	<title></title>
</head>
<body>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/top2.css">
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<center>
		<div class="text-center" style="padding:30px 0">
			<div class="logo"><?php echo $string; ?></div>
		</div>
		<div class="etc-login-form">
		<p>return the mainpage? <a href="main.php">click here</a></p>
	</center>
</body>
</html>