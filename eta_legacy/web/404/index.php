<?php
    require_once("../site_info.php");
    require_once($page_com_url["formnav"]);
    $page_title = "404";
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
            <p>你来到这个页面，通常有两个原因</p>
            <h2 id="toc_0">一、链接错误</h2>
            <h3 id="toc_2">解决办法一：在 <a href="/">主页</a> 中找你需要的文章</h3>
            <h3 id="toc_2">解决办法二：使用正常方法访问本网站</h3>
            <h2 id="toc_3">二、维度攻击</h2>
            <p>不明力量入侵，你想要访问的页面被摧毁了。</p>
        </div>
    </div>
</div>

<?php
    require_once($page_com_url["footer"]);
    require_once($page_com_url["foot"]);
?>

</body>
</html>
