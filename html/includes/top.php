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

function fetchTopicTags($topicId) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT tags.tag_name
        FROM tags
        INNER JOIN topic_tags 
            ON topic_tags.tag_id = tags.tag_id
        WHERE topic_tags.topic_id = :topic_id AND tags.tag_name IS NOT NULL
    ');
    $stmt->bindValue(':topic_id', $topicId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function fetchMediaTags($mediaId) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT tags.tag_name
        FROM tags
        INNER JOIN media_tags 
            ON media_tags.tag_id = tags.tag_id
        WHERE media_tags.media_id = :media_id AND tags.tag_name IS NOT NULL
    ');
    $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>