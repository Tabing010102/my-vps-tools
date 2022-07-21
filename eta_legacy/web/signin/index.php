<?php
	require_once("../site_info.php");
	$page_title = "用户登录";
	require_once($page_com_url["formnav"]);
	if($login_status == 0) { header("Location: /"); exit; }
?>

<!DOCTYPE html>
<html lang="en">

<?php
	require_once($page_com_url["head"]);
?>

<body data-spy="scroll">

<?php
	require_once($page_com_url["nav"]);
	require_once($page_com_url["header"]);
?>

<div id="back-top">
  <a href="#top" title="回到顶部"></a>
</div>

<!-- Main Content -->
<div class="container">
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
<form id="signinform" class="form-horizontal" method="post" action="<?php echo $web_url; ?>/library/do_signin.php">
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" id="inputPassword" placeholder="Password">
    </div>
	</div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-4">
      <button type="submit" class="btn btn-default btn-lg">登录</button>
    </div>
	<div id="signupnotice" class="col-sm-4">
		<a href="/signup">没有账号？请点击这里注册</a>
	</div>
  </div>
</form>
		</div>
	</div>
</div>

<hr>

<?php
	require_once($page_com_url["footer"]);
	require_once($page_com_url["foot"]);
?>

</body>
</html>
