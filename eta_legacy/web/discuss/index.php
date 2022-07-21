<?php
    require_once("../site_info.php");
    require_once($page_com_url["library"]."get_info_discuss.php");
    $page_title = $discuss_title;
    require_once($page_com_url["formnav"]);
?>

<!DOCTYPE html>
<html lang="en">

<?php
    require_once($page_com_url["head"]);
?>

<body data-spy="scroll" data-offset="300">

<?php
    require_once($page_com_url["nav"]);
    require_once($page_com_url["discuss_header"]);
?>

<div style="display:none;"><textarea></textarea></div>
<!-- Post Content -->
<article>
<div class="col-md-9">
    <div class="container">
        <div class="row">
            <div id="maintext" class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 post-container">
                <?php require_once($page_com_url["library"]."get_discuss_article.php"); ?>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($page_com_url["toc"]);
?>

</article>

<?php
    require_once($page_com_url["footer"]);
    require_once($page_com_url["foot"]);
?>

</body>
</html>
