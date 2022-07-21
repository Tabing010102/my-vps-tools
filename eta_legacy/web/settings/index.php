<?php
	require_once("../site_info.php");
	require_once($page_com_url["formnav"]);
	$page_title = "设置";
	require_once($page_com_url["library"]."get_info_settings.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php
	require_once("../include/head.php");
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
    <div class="col-lg-8 col-lg-offset-1 col-md-10">
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade in active" id="settab1">
      <form id="changesettingsform1" class="form-horizontal settingsTab" method="post" action="<?php echo $web_url; ?>/library/do_change_settings.php">
      <div class="form-group">
      <label for="inputusername" class="col-sm-2 control-label">用户名</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name="username"id="inputusername" placeholder="最多16个字母符号或8个汉字" maxlength="16" value=<?php echo "$user_name";?>></div>
      </div>
      <div class="form-group">
      <label for="inputgender" class="col-sm-2 control-label">性别</label>
      <div class="col-sm-10" id="inputgender">
      <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio1" value="male" <?php if($user_gender == "male")echo "checked";?>> 男
      </label>
      <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio2" value="female" <?php if($user_gender == "female")echo "checked";?>> 女
      </label>
      <label class="radio-inline">
      <input type="radio" name="gender" id="inlineRadio3" value="other" <?php if($user_gender == "other")echo "checked";?>> 其他
      </label>
      </div>
      </div>
      <div class="form-group">
      <label for="inputidentity" class="col-sm-2 control-label">身份/职业</label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name="identity" id="inputidentity" placeholder="请选择最能体现你特点的词语，最多20个字" maxlength="40" value=<?php echo "$user_identity";?>></div>
      </div>
      <div class="form-group">
      <label for="inputdescription" class="col-sm-2 control-label">个人描述</label>
      <div class="col-sm-10">
      <textarea type="text" class="form-control" name="description" id="inputdescription" rows=3 placeholder="最多50个字" maxlength="100"><?php echo "$user_description";?></textarea></div>
      </div>
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">修改个人信息</button></div>
      </div>
      </form>
        </div>

        <div class="tab-pane fade" id="settab2">
        <div class="settingsTab">

			<?php
			echo "<table id=\"signinlogtable\" count=\"1\" class=\"table table-hover\"><thead><tr>";
    		echo "<th> 登录id </th>";
    		echo "<th> 用户id </th>";
    		echo "<th> IP </th>";
    		echo "<th> UA </th>";
    		echo "<th> 登录时间 </th>";
    		echo "</tr></thead><tbody id=\"signinloglist\">";

    		require_once($page_com_url["library"]."get_info_loginlog.php");

    		echo "</tbody></table>";
    		?>
    		<div class="undatenotice"><p id="undateNoticeContext" style="text-align:center">滑动到页面底端加载后面的内容</p></div>
    		</div>
        </div>

        <div class="tab-pane fade" id="settab3">
      <form id="changesettingsform2" class="form-horizontal settingsTab" method="post" action="<?php echo $web_url; ?>/library/do_change_settings.php">
      <div class="form-group">
      <label for="inputPassword" class="col-sm-2 control-label">原密码</label>
      <div class="col-sm-10">
      <input type="password" class="form-control" name="pwdori" id="inputPassword" placeholder="Password"></div>
      </div>
      <div class="form-group">
      <label for="inputPassword" class="col-sm-2 control-label">新密码</label>
      <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd" id="inputPassword" placeholder="Password"></div>
      </div>
      <div class="form-group">
      <label for="inputPasswordAgain" class="col-sm-2 control-label">再输入一次密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="pwd2" id="inputPasswordAgain" placeholder="Password">
    </div>
	</div>
      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">修改密码</button></div>
      </div>
      </form>
      <form id="signoutform" class="settingsTab" method="post" action="<?php echo $web_url; ?>/library/do_signout.php">
			<div class="formgroup"><div class="col-sm-offset-2">
			<button type="submit" class="btn btn-default">退出登录</button>
			</div></div>
			</form>
        </div>

	</div>
  </div>
    <div class="col-md-2 col-lg-3">

      <ul id="myTab" class="nav nav-tabs nav-pills nav-stacked">
        <li>
          <a href="#settab0" data-toggle="tab">通用</a></li>
        <li class="active">
          <a href="#settab1" data-toggle="tab">个人信息</a></li>
        <li id="signinlog" count="1" url="<?php echo $web_url; ?>/library/get_info_loginlog.php">
          <a href="#settab2" data-toggle="tab">登录记录</a></li>
        <li>
          <a href="#settab3" data-toggle="tab">用户账户</a></li>
      </ul>
    </div>
</div>
<hr>

<?php
	require_once($page_com_url["footer"]);
	require_once($page_com_url["foot"]);
?>

</body>
</html>
