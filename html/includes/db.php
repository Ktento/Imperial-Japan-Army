<?php
function getPDOConnection() {
    try {
        return new PDO('mysql:host=localhost;dbname=artifact;charset=utf8', 'user01', 'user01', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        die("データベース接続エラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8'));
    }
}
?>
