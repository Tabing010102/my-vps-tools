<?php
    $dbType = 'mysql';
    $dbHost = 'localhost';
    $dbName = 'jzdk';
    $dbUser = 'jzdk';
    $dbPass = 'jzdk';
    $dsn = "$dbType:host=$dbHost;dbname=$dbName";
    try {
        $dbc = new PDO($dsn, $dbUser, $dbPass);
        $dbc->exec('SET NAMES utf8');
    } catch(PDOException $exception) {
        $message = "数据库连接失败，错误信息：<br>" . $exception->getMessage();
        $retr = array(
            'result' => 'failed',
            'message' => $message
        );
        exit(json_encode($retr));
    }
?>