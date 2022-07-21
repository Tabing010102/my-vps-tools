<?php
    function failed_dberr(&$dbcp) {
        $errorInfo = $dbcp->errorInfo();
        echo "数据库错误：<br>$errorInfo[2]";
        exit();
    }

    function getStatus($st) {
        switch($st) {
        case -2:
            return "已放弃";
        case -1:
            return "已失败";
        case 0:
            return "正在进行";
        case 1:
            return "已完成";
        case 2:
            return "已取消";
        default:
            return "未知";
        }
    }
?>