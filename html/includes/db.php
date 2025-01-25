<?php

function getPDOConnection() {
    $config = require 'config/config.php';
    try {
        return new PDO($config['dsn'], $config['user'], $config['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        die("データベース接続エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
    }
}
?>
