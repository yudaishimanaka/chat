<?php
$userid = htmlspecialchars($_POST['userid']);
$pass = htmlspecialchars($_POST['pass']);
$confirmpass = htmlspecialchars($_POST['confirmpass']);
$count = 0;
$string = "";
if($userid != NULL && $pass != NULL && $confirmpass != NULL){
	if($pass !== $confirmpass){
		$string = "Password and ConfirmPass do not match<br>";
	}else{
		$fp = fopen("userinfo.txt", "r");
		while($line = fgets($fp)){
			$line = split(" ", $line);
			if ($line[0] == $userid) $count++;
		}
		fclose($fp);
		if($count == 0 ){
			$fp2 = fopen("userinfo.txt", "a");
			fwrite($fp2, $userid." ".$pass." img/you.jpg"."\n");
			fclose($fp2);
			$string = "Registration has been completed<br>";
		}else{
			$string = 'User with the same name is already registered<br>';
		}
	}
}else{
	$string = 'UserID or Password is not entered<br>';
}
?>
<!DOCTYPE html>
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
		</div>
	</center>
</body>
</html>