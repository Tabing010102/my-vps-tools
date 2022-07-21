<?php
	require_once("../site_info.php");
	$page_title = "用户注册";
	require_once($page_com_url["formnav"]);
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
<form id="signupform" class="form-horizontal signupform" method="post" action="<?php echo $web_url; ?>/library/do_signup.php">
  <div class="form-group">
    <label for="inputusername" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username"id="inputusername" placeholder="最多16个字母符号或8个汉字" maxlength="16">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" name="email" id="inputEmail" placeholder="请注意，注册后不可修改" maxlength="32">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" id="inputPassword" placeholder="">
    </div>
	</div>
  <div class="form-group">
    <label for="inputPasswordAgain" class="col-sm-2 control-label">再输入一次密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd2" id="inputPasswordAgain" placeholder="">
    </div>
	</div>
<div class="form-group">
<label for="inputgender" class="col-sm-2 control-label">性别</label>
<div class="col-sm-10" id="inputgender">
<label class="radio-inline">
  <input type="radio" name="gender" id="inlineRadio1" value="male"> 男
  </label>
  <label class="radio-inline">
    <input type="radio" name="gender" id="inlineRadio2" value="female"> 女
	</label>
	<label class="radio-inline">
	  <input type="radio" name="gender" id="inlineRadio3" value="other"> 其他
	  </label>
</div>
</div>
  <div class="form-group">
    <label for="inputidentity" class="col-sm-2 control-label">身份/职业</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="identity" id="inputidentity" placeholder="请选择最能体现你特点的词语，最多20个字" maxlength="40">
    </div>
  </div>
  <div class="form-group">
    <label for="inputdescription" class="col-sm-2 control-label">个人描述</label>
    <div class="col-sm-10">
      <textarea type="text" class="form-control" name="description" id="inputdescription" rows=3 placeholder="最多50个字" maxlength="100"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">注册</button>
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
