<?php
    require_once("../site_info.php");
    require_once($page_com_url["formnav"]);

    require_once($page_com_url["library"]."get_info_user.php");

    $page_title = $user_name;
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
    <div class="personaldescription col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
        <div class="row">
            <div class="col-sm-1" style="font-size:100px">“</div>
            <div class="col-sm-10"style="font-size:30px;padding:50px 10px;"><?php echo $user_description;?></div>
            <div class="col-sm-1" style="font-size:100px">”</div>
        </div>
    </div>
    <!-- “设置”，“登出”按钮显示 -->
    <?php
        if($is_myself) {
            echo '<div class="col-md-1" style="position:relative;top:-20px;">';
            echo '<button class="btn btn-default btn-lg" href="'.$web_com_url["settings"].'">设置</button>';
            /*echo '<form id="signoutform" class="signoutform" method="post" action="/library/do_signout.php">';
            echo '<button type="submit" class="btn btn-default">登出</button>';
            echo '</form>';*/
            echo '</div>';
        }
    ?>
    <!-- 原代码
    <div class="col-md-1" style="position:relative;top:-65px;">
    <button class="btn btn-default" href="<?php echo $page_url["settings"];?>">设置</button>
    <form id="signoutform" class="signoutform" method="post" action="/library/do_signout.php">
      <button type="submit" class="btn btn-default">登出</button>
    </form>
    </div>
    -->

    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div id="articlelist" count="1" url="<?php echo $web_url; ?>/library/get_user_article.php">
                <?php require_once($page_com_url["library"]."get_user_article.php"); ?>
            </div>
            <div class="undatenotice"><p id="undateNoticeContext" style="text-align:center">滑动到页面底端加载后面的内容</p></div>
        </div>
    </div>
</div>

<?php
    require_once($page_com_url["footer"]);
    require_once($page_com_url["foot"]);
?>

</body>
</html>
