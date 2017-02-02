<?php
session_start();

if(!isset($_SESSION['roomname'])){
	header("Location: logout.php");
	exit();
}else{
	$message = "ルームネーム：".$_SESSION['roomname']."<br>";	
}
if (!isset($_SESSION['userid'])) {
	header("Location: logout.php");
	exit();
}else{
	$message += $_SESSION['userid']."さんようこそ<br>";
}
if(!isset($_SESSION['roomid'])){
	header("Location: logout.php");
	exit();
}else{
	$message += "ルームID：".$_SESSION['roomid']."<br>";	
}
$roomname = $_SESSION['roomname'];
$userid = $_SESSION['userid'];
$roomid = $_SESSION['roomid'];

if (isset($roomid) && $roomid != NULL) {
	$fp = fopen("chatlog.txt", "r");
	$chatlog = array();
	while($line = fgets($fp)){
		$line = split(" ", $line);
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
}
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/chat.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/top2.css">
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script src="js/chat.js"></script>
	<meta charset="UTF-8">
	<title>chat</title>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fulid">
			<!-- 2.ヘッダ情報 -->
			<div class="navbar-header">
				<a class="navbar-brand"><div class="logo" style="padding:0px 0">RoomName:<?php echo $roomname;?></div></a>
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
	<!-- ユーザIDにHTMLタグが含まれても良いようにエスケープする -->
	<br><br>
	<div id="chatlog"><?php foreach ($chatlog as $value) {
		$value = split(":", $value);
		if ($userid == $value[0]) {
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
	}?></div>
	<br><br>
	<div id="footerArea">
		<footer class="footer">
			<div class="container">
				<form method="post">
					<div class="panel-footer">
                    <div class="input-group">
                        <input id="request" autocomplete="off" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" id="send" type="submit">Send</button>
                        </span>
                    </div>
                </div>
					<input id="userid" type="hidden" value="<?php echo $userid; ?>"/>
					<input id="roomid" type="hidden" value="<?php echo $roomid; ?>">
				</form>
			</div>
		</footer>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>