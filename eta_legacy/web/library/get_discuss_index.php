<?php
    require_once("PDO_dbconnect.php");
    require_once("site_info.php");
    $page_cnt = 0;
    if($_POST['page_cnt']) { $page_cnt = (int)$_POST['page_cnt']; }
    $row_per_page = 20;
    $query_offset = $page_cnt*$row_per_page;
    $query_limit = $row_per_page;
    $dbcp1 = $dbc->prepare("SELECT * FROM `article` ORDER BY `last_modified` DESC LIMIT $query_offset,$query_limit");
    $dbcp2 = $dbc->prepare("SELECT * FROM `discuss` WHERE `did`=:did");
    $is_success = $dbcp1->execute();
    if(!$is_success) {
        $errorInfo = $dbcp1->errorInfo();
        echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
        exit;
    }
    while($row = $dbcp1->fetch(PDO::FETCH_ASSOC)) {
        $did = $row['parent_did'];
        $content_part = $row['content_part'];
        $issue_num = $row['issue_num'];
        $last_modified = $row['last_modified'];
        $is_success2 = $dbcp2->execute(array(':did'=>$did));
        if(!$is_success2) {
            $errorInfo = $dbcp2->errorInfo();
            echo "数据库存取失败，错误信息：<br>$errorInfo[2]";
            exit;
        }
        $row2 = $dbcp2->fetch(PDO::FETCH_ASSOC);
        $title = $row2['title'];
        $involve_num = $row2['involve_num'];
        //显示
        echo '<div id="post-list">
            <div class="row">
                <div id="post-info" class="col-md-2">
                    <div id="post-info-in">参与 | '.$involve_num.'</div>
                    <div id="post-info-in">讨论 | '.$issue_num.'</div>
                </div>
                <div id="post-list-in" class="col-md-10 post-preview">
                    <a href="'.$web_url.'/discuss/?did='.$did.'">
                        <h2 class="post-title">'.$title.'</h2>
                        <div class="post-content-preview">'.$content_part.'</div>
                    </a>
                    <p class="post-meta">最后修改日期'.$last_modified.'</p>
                </div>
            </div>
        </div>
        <hr>';
    }
?>
