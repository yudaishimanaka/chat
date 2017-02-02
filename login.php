<?php
session_start();
$userid = htmlspecialchars($_POST['userid']);
$pass = htmlspecialchars($_POST['pass']);
$string = "";
if($userid != NULL && $pass != NULL){
	$fp = fopen("userinfo.txt", "r");
	while($line = fgets($fp)){
		$count = 0;
		$line = split(" ", $line);
		$line[2] = str_replace(array("\r\n","\n","\r"), '', $line[2]);
		if ($line[0] === $userid && $line[1] === $pass) {
			fclose($fp);
			$_SESSION['userid'] = $userid;
			$_SESSION['icon'] = $line[2];
			header('Location: main.php');
			exit();
		}else{
			$count++;
		}
	}
	if(isset($count) == 1){
		$string = 'UserID or Password is incorrect<br>';
	}else{
		$string = 'User is not registered or UserID or Password is incorrect<br>';
	}
}else{
	$string = 'UserID or Password is not entered<br>';
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
		<p>return the toppage? <a href="index.html">click here</a></p>
	</center>
</body>
</html>