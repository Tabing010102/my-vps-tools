<?php
	require_once("../site_info.php");
	$page_title = "发起讨论";
	require_once($page_com_url["formnav"]);
	if($login_status != 0) { header("Location: /signin"); exit; }
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
<form id="writeform" class="form-horizontal signupform" method="post" action="<?php echo $web_url; ?>/library/do_add_discuss.php">
  <div class="form-group">
  	<div class="col-sm-12">
		<input type="text" class="form-control input-lg" name="topics" id="inputTitle" placeholder="话题">
  	</div>
  	</div>
  	<div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control input-lg" name="title" id="inputTitle" placeholder="标题，最多25个字" maxlength="50">
    </div>
        <div class="col-sm-1">
      <button type="submit" class="btn btn-default btn-lg">提交</button>
    </div>
    </div>
  <div class="form-group">
		<textarea name="content" id="MDE"></textarea>
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
