<?php
session_start();
$string = "";
$icon = "";
if(!isset($_SESSION['userid']) && !isset($_SESSION['icon'])){
	header("Location: logout.php");
	exit();
}else{
	$string = "Welcome to ".$_SESSION['userid']."<br>";	
	$icon = $_SESSION['icon'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/top2.css">
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<title>CHAT</title>
	<script type="text/javascript">
		$(function(){
			$('#file_input').change(function() {
				$('#dummy_file').val($(this).val());
			});
		})
	</script>
	<script type="text/javascript">
		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fulid">
			<!-- 2.ヘッダ情報 -->
			<div class="navbar-header">
				<a class="navbar-brand"><div class="logo" style="padding:0px 0">CHAT SYSTEM</div></a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-nav">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="top-nav">
        	<!-- right navbar -->
        	<ul class="nav navbar-nav">
        		<li>
        			<a href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
        		</li>
        	</ul>
        </div>
    </div>
</nav>
<center>
	<div class="text-center">
		<div class="logo" style="padding:30px 0"><h2><?php echo $string; ?></h2></div>
		<div class="chat-box">
			<div class="chat-face" id="chat-face"><img src="<?php echo $icon; ?>"></div>
		</div>
		<!-- end:Main Form -->
		<center>
			<form id="my_form" class="form-inline" enctype="multipart/form-data" action="" name="file_1" method="post">
				<div class="form-group" style="width:200px;">
					<div class="input-group">
						<input type="file" id="file_input" name="file_input" style="display: none;">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" onclick="$('#file_input').click();"><i class="glyphicon glyphicon-folder-open"></i></button>
						</span>
						<div class="input-group">
							<input id="dummy_file" type="text" class="form-control" placeholder="select image..." disabled>       
						</div>
					</div>
				</div>
				<button type="button" class="btn btn-default" onclick="file_upload()">Change Icon</button>
			</form>
		</center>
	</div>
	</center>
	<div id="userdata"></div>
	<center>
		<div class="text-center">
			<div class="logo">Log in to the room</div>
			<!-- Main Form -->
			<div class="login-form-1">
				<form id="login-form" class="text-left" action="enterroom.php" method="post" autocomplete="off">
					<div class="login-form-main-message"></div>
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<div align="left">
									<label for="lg_username" class="sr-only">Username</label>
									<input type="text" class="form-control" id="lg_username" name="roomid" placeholder="roomid">
								</div>
							</div>
							<div class="form-group">
								<div align="left">
									<label for="lg_password" class="sr-only">Password</label>
									<input type="password" class="form-control" id="lg_password" name="roompass" placeholder="roompass">
								</div>
							</div>
						</div>
						<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
					</div>
				</form>
			</div>
			<!-- end:Main Form -->
		</div>
	</center>
	<center>
		<!-- REGISTRATION FORM -->
		<div class="text-center">
			<div class="logo">Create room</div>
			<!-- Main Form -->
			<div class="login-form-1">
				<form id="register-form" class="text-left">
					<div class="login-form-main-message"></div>
					<div class="main-login-form">
						<div class="login-group">
							<div class="form-group">
								<div align="left">
									<label for="reg_username" class="sr-only">Username</label>
									<input type="text" class="form-control" id="roomname" name="roomname" placeholder="roomname" autocomplete="off">
								</div>
							</div>
							<div class="form-group">
								<div align="left">
									<label for="reg_password" class="sr-only">Password</label>
									<input type="text" class="form-control" id="roomid" name="roomid" placeholder="roomid">
								</div>
							</div>
							<div class="form-group">
								<div align="left">
									<label for="reg_password" class="sr-only">Confirm Password</label>
									<input type="password" class="form-control" id="pass" name="roompass" placeholder="roompass">
								</div>
							</div>
						</div>
						<button type="submit" class="login-button" id="createroom"><i class="fa fa-chevron-right"></i></button>
					</div>
				</form>
			</div>
			<!-- end:Main Form -->
		</div>
		<div class="logo" style="padding:20px 0"><span data-toggle="tooltip" data-placement="top" data-html="true" title="下のフォームからルームを作成し、上のフォームからルームにログインしてチャットを始められます!!　またアイコン下のフォームからアイコンを設定することができます。<br>雑談ルーム<br>roomid:svapp<br>roompass:NwUsr1">Hints</span></div>
	</center>
		<div id="footerArea">
		<footer class="footer">
			<div class="container">
				<p class="text-muted">Back to the top page <a href="../index.php">click here.</a></p>
			</div>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>