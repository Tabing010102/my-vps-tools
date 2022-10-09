<?php
    $dbType = 'mysql';
    $dbHost = 'localhost';
    $dbName = 'fd';
    $dbUser = 'fd';
    $dbPass = 'fd';
    $dsn = "$dbType:host=$dbHost;dbname=$dbName";
    try {
        $dbc = new PDO($dsn, $dbUser, $dbPass);
        $dbc->exec('SET NAMES utf8');

        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO `sss`(`ip`, `time`) VALUES (:ip, NOW())";
        $dbcp = $dbc->prepare($sql);
        $is_success = $dbcp->execute(array(':ip' => $ip));
        echo $ip.": ".(bool)$is_success;
    } catch(Exception $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
?>