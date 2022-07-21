<?php
    require_once("site_info.php");
    $page_title = "主页";
    require_once($page_com_url["library"]."judge_cookie_and_form.php");
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
            <?php require_once($page_com_url["library"]."get_discuss_index.php"); ?>
        </div>
    </div>
</div>

<!-- Pager -->

<ul class="pager">


    <li class="next">
        <a href="https:/s1.ltmcpe.cn:12899/page2">Older Posts &rarr;</a>
    </li>

</ul>


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
