<?php
    require_once("PDO_dbconnect.php");
    require_once("cookie.php");
    require_once("site_info.php");

    //error_reporting(E_ALL || ~E_NOTICE);
    //临时解决方法

    if((int)$_GET['uid'] == NULL) {//AJAX
        $uid = (int)$_POST['uid'];
        $page_cnt = $_POST['page_cnt'];
    } else {//不是AJAX
        $uid = (int)$_GET['uid'];
        $page_cnt = 0;
    }

    $row_per_page = 5;

    $query_offset = $page_cnt*$row_per_page;
    $query_limit = $row_per_page;
    //$sql = "SELECT * FROM `article` WHERE `author_uid`=$uid ORDER BY `last_modified` DESC LIMIT $query_offset,$query_limit";
    $dbcp1 = $dbc->prepare("SELECT * FROM `article` WHERE `author_uid`=:uid ORDER BY `last_modified` DESC LIMIT $query_offset,$query_limit");
    $dbcp2 = $dbc->prepare("SELECT * FROM `discuss` WHERE `did`=:did");
    $is_success = $dbcp1->execute(array(':uid'=>$uid));
    if(!$is_success) {
        $errorInfo = $dbcp1->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    $result = $dbcp1;
    //显示
    $row_num = $result->rowCount();
    $row_cnt = 1;
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //article
        $user_article[$row_cnt]['content_part'] = $row['content_part'];
        $user_article[$row_cnt]['last_modified'] = $row['last_modified'];
        $user_article[$row_cnt]['issue_num'] = $row['issue_num'];
        //discuss
        $did = $row['parent_did'];
        $user_article[$row_cnt]['did'] = $did;
        $is_success = $dbcp2->execute(array(':did'=>$did));
        if(!$is_success) {
            $errorInfo = $dbcp2->errorInfo();
            echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
            exit;
        }
        $row2 = $dbcp2->fetch(PDO::FETCH_ASSOC);
        $user_article[$row_cnt]['title_discuss'] = $row2['title'];
        $user_article[$row_cnt]['involve_num'] = $row2['involve_num'];
        ++$row_cnt;
    }
    if($page_cnt == 0) echo '<div id="userid" uid="'.$uid.'"></div>';
    foreach($user_article as $a) {
    echo '<div id="post-list">
        <div class="row">
        <div id="post-info" class="col-md-2">
        	<div id="post-info-in">参与 | '.$a['involve_num'].'</div>
        	<div id="post-info-in">讨论 | '.$a['issue_num'].'</div>
        </div>
        <div id="post-list-in" class="col-md-10 post-preview">
            <a href="'.$web_url.'/discuss/?did='.$a['did'].'">
                <h2 class="post-title">'
                    .$a['title_discuss'].
                '</h2>
                <div class="post-content-preview">'
                    .$a['content_part'].
                '</div>
            </a>
            <p class="post-meta">'."最后修改时间".$a['last_modified'].'</p>
        </div>
        </div>
        </div>';
    }
?>
