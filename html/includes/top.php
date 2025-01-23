<?php
require_once 'db.php';

function fetchTotalTopics() {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Topics');
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchTotalMedium() {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Medias');
    $stmt->execute();
    return $stmt->fetchColumn();
}
?>