<?php
require_once 'db.php';

function fetchTotalComments($topicId) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Topic_comment WHERE topic_id = :topic_id');
    $stmt->bindValue(':topic_id', $topicId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchComments($topicId, $itemsPerPage, $offset) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT 
            topic_comment_id,
            comment_category,
            topic_comment AS comment, 
            user_name, 
            topic_comment.created_at 
        FROM topic_comment 
        INNER JOIN users 
            ON topic_comment.user_id = users.user_id 
        WHERE topic_id = :topic_id
        LIMIT :limit OFFSET :offset
    ');
    $stmt->bindValue(':topic_id', $topicId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchTags($topicId) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT Tags.tag_name
        FROM Tags
        INNER JOIN Topic_tags ON Topic_tags.topic_tag_id = Tags.tag_id
        WHERE Topic_tags.topic_id = :topic_id
    ');
    $stmt->bindValue(':topic_id', $topicId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function insertTopic($num, $title, $user_id, $category, $target, $tags) {
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT topic_id FROM Topics WHERE topic_id = :topic_id");
    $checkStmt->bindValue(':topic_id', $num, PDO::PARAM_STR);
    $checkStmt->execute();

    if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "すでに存在するトピックスの登録番号です";
        return $errors;
    }

    // SQL文の選択
    $sql = empty($num)
        ? "INSERT INTO Topics (user_id, topic_title) VALUES (:user_id, :title)"
        : "INSERT INTO Topics (topic_id, user_id, topic_title) VALUES (:num, :user_id, :title)";
    
    $stmt = $pdo->prepare($sql);

    // パラメータのバインディング
    if (!empty($num)) {
        $stmt->bindValue(':num', $num, PDO::PARAM_INT);
    }
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR); // ユーザーIDを取得する関数
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        $errors[] = "新しいトピックの挿入に失敗しました";
        return $errors;
    }

    $topic_id = $pdo->lastInsertId();

    try {
        insertCategory($topic_id, $category);
        insertTarget($topic_id, $target);
        //insertTags($topic_id, $tags);
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
        return $errors;
    }

    return $topic_id;
}

function insertTags($topic_id, $tags) {
    $pdo = getPDOConnection();
    foreach ($tags as $tag) {
        // タグを保存（存在しない場合のみ）
        $stmt = $pdo->prepare("INSERT IGNORE INTO Tags (tag_name) VALUES (:name)");
        $stmt->execute([':name' => $tag]);
        
        // ハッシュタグIDを取得
        $stmt = $pdo->prepare("SELECT tag_id FROM Tags WHERE tag_name = :name");
        $stmt->execute([':name' => $tag]);
        $hashtagId = $stmt->fetchColumn();
        
        // 関連付けを保存
        $stmt = $pdo->prepare("INSERT INTO Topic_tags (topic_id, tag_id) VALUES (:topic_id, :tag_id)");
        $stmt->execute([':topic_id' => $topic_id, ':tag_id' => $hashtagId]);
    }
}

function insertCategory($topic_id, $category) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("INSERT INTO Topic_category (topic_id, topic_category_name) VALUES (:topic_id, :category)");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
}

function insertTarget($topic_id, $target) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("INSERT INTO Topic_target (topic_id, topic_target_name) VALUES (:topic_id, :target)");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_STR);
    $stmt->bindValue(':target', $target, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTopic($num, $title, $user_id, $category, $target, $tags) {
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT topic_id FROM Topics WHERE topic_id = :topic_id");
    $checkStmt->bindValue(':topic_id', $num, PDO::PARAM_STR);
    $checkStmt->execute();

    if (!$checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "指定されたトピックは存在しません";
        return $errors;
    }

    $stmt = $pdo->prepare("UPDATE Topics SET topic_title = :title WHERE topic_id = :num");
    $stmt->bindValue(':num', $num, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        $errors[] = "トピックの更新に失敗しました";
        return $errors;
    }

    try {
        updateCategory($num, $category);
        updateTarget($num, $target);
        updateTags($num, $tags);
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
        return $errors;
    }

    return $num;

}

function updateCategory($topic_id, $category) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("UPDATE Topic_category SET topic_category_name = :category WHERE topic_id = :topic_id");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTarget($topic_id, $target) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("UPDATE Topic_target SET topic_target_name = :target WHERE topic_id = :topic_id");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_STR);
    $stmt->bindValue(':target', $target, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTags($topic_id, $tags) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("DELETE FROM Topic_tags WHERE topic_id = :topic_id");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
    $stmt->execute();

    insertTags($topic_id, $tags);
}

function deleteTopic($topic_id) {
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT topic_id FROM Topics WHERE topic_id = :topic_id");
    $checkStmt->bindValue(':topic_id', $topic_id, PDO::PARAM_STR);
    $checkStmt->execute();

    if (!$checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "指定されたトピックは存在しません";
        return $errors;
    }

    $stmt = $pdo->prepare("DELETE FROM Topics WHERE topic_id = :topic_id");
    $stmt->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $errors[] = "トピックの削除に失敗しました";
        return $errors;
    }

    return $topic_id;
}

?>
