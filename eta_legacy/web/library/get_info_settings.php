<?php
	require_once("PDO_dbconnect.php");
	require_once("site_info.php");
	if($login_status != 0) { header("Location: $web_url/signin"); exit; }
	$uid = (int)$_COOKIE['uid'];
	//$sql = "SELECT `username`,`gender`,`identity`,`description` FROM `user` WHERE `uid`=$uid";
	$dbcp = $dbc->prepare("SELECT `username`,`gender`,`identity`,`description` FROM `user` WHERE `uid`=:uid");
	$is_success = $dbcp->execute(array(':uid'=>$uid));
	if(!$is_success) {
		$errorInfo = $dbcp->errorInfo();
		echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
		exit;
	}
	$result = &$dbcp;
	$row_num = $result->rowCount();
	//if($row_num)
	$row = $result->fetch(PDO::FETCH_ASSOC);
	$user_name = $row['username'];
	$user_gender = $row['gender'];
	$user_description = $row['description'];
	$user_identity = $row['identity'];
?>
