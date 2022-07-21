<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");
    if($_GET['did'] == NULL) { header("Location: $web_url/404"); exit; }
    $did = (int)$_GET['did'];
    if($_POST['page_cnt'] == NULL) $page_cnt = 0;
    else $page_cnt = (int)$_POST['page_cnt'];
    $row_per_page = 20;

    $query_offset = $page_cnt*$row_per_page;
    $query_limit = $row_per_page;
    $dbcp1 = $dbc->prepare("SELECT `author_uid`,`issue_num`,`content`,`last_modified` FROM `article` WHERE `parent_did`=$did ORDER BY `last_modified` DESC LIMIT $query_offset,$query_limit");
    $dbcp2 = $dbc->prepare("SELECT `uid`,`username`,`identity`,`description` FROM `user` WHERE `uid`=:uid");
    $is_success = $dbcp1->execute();
    if(!$is_success) {
        $errorInfo = $dbcp1->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $article_num = $dbcp1->rowCount();
    $article_num_cnt = $query_offset+1;
    //遍历所有结果
    while($row1 = $dbcp1->fetch(PDO::FETCH_ASSOC)) {
        $article_issue_num = $row1['issue_num'];
        $article_content = $row1['content'];
        $article_last_modified = $row1['last_modified'];
        $author_uid = $row1['author_uid'];
        $is_success2 = $dbcp2->execute(array(':uid'=>$author_uid));
        if(!$is_success2) {
            $errorInfo = $dbcp2->errorInfo();
            echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
            exit;
        }
        $row2 = $dbcp2->fetch(PDO::FETCH_ASSOC);
        $author_name = $row2['username'];
        $author_identity = $row2['identity'];
        $author_description = $row2['description'];
        $author_uid = $row2['uid'];
        //显示
        echo '<div class="author form-group">
            <div class="row">
                <div class="col-sm-6">
                    <a href="'.$web_url.'/user?uid='.$author_uid.'"><div class="author-name">'.$author_name.'</div></a>
                    <span class="author-identity">'.$author_identity.'</span>
                    <!--div class="author-description col-sm-12">'.$author_description.'</div-->
                </div>
                <form active="'.$page_com_url["library"].'do_delete_article.php" class="col-sm-6">
                    <button class="btn btn-default">感谢</button>
                    <button class="btn btn-default">打赏</button>
                    <button class="btn btn-default">关注</button>';
                    if(true) echo '<button class="btn btn-default">删除</button>';
                    echo '<!--div class="col-sm-12">以下内容  $声明</div-->
                </form>
            </div>
        </div>
        <div id="content'.$article_num_cnt.'" class="content" count="'.$article_num.'">'.$article_content.'</div>';
        ++$article_num_cnt;
    }
?>
