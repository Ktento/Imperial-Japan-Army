<?php
require_once 'db.php';

function fetchTotalComments($mediaId)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM Media_comment WHERE media_id = :media_id');
    $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function fetchComments($mediaId, $itemsPerPage, $offset) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT 
            media_comment_id AS comment_id,
            comment_category,
            media_comment AS comment, 
            user_name, 
            media_comment.created_at 
        FROM media_comment 
        INNER JOIN users 
            ON media_comment.user_id = users.user_id 
        WHERE media_id = :media_id
        LIMIT :limit OFFSET :offset
    ');
    $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function fetchTags($mediaId)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare('
        SELECT Tags.tag_name
        FROM Tags
        INNER JOIN Media_tags ON Media_tags.media_tag_id = Tags.tag_id
        WHERE Media_tags.media_id = :media_id
    ');
    $stmt->bindValue(':media_id', $mediaId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function insertMedia($num, $title, $user_id, $category, $target, $tags)
{
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT media_id FROM Medias WHERE media_id = :media_id");
    $checkStmt->bindValue(':media_id', $num, PDO::PARAM_STR);
    $checkStmt->execute();

    if ($checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "すでに存在するトピックスの登録番号です";
        return $errors;
    }

    // SQL文の選択
    $sql = empty($num)
        ? "INSERT INTO Medias (user_id, media_title) VALUES (:user_id, :title)"
        : "INSERT INTO Medias (media_id, user_id, media_title) VALUES (:num, :user_id, :title)";

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

    $media_id = $pdo->lastInsertId();

    try {
        insertCategory($media_id, $category);
        insertTarget($media_id, $target);
        insertTags($media_id, $tags);
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
        return $errors;
    }

    return $media_id;
}

function insertTags($media_id, $tags)
{
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
        $stmt = $pdo->prepare("INSERT INTO Media_tags (media_id, tag_id) VALUES (:media_id, :tag_id)");
        $stmt->execute([':media_id' => $media_id, ':tag_id' => $hashtagId]);
    }
}

function insertCategory($media_id, $category)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("INSERT INTO Media_category (media_id, media_category_name) VALUES (:media_id, :category)");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
}

function insertTarget($media_id, $target)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("INSERT INTO Media_target (media_id, media_target_name) VALUES (:media_id, :target)");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindValue(':target', $target, PDO::PARAM_STR);
    $stmt->execute();
}

function updateMedia($num, $title, $user_id, $category, $target, $tags)
{
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT media_id FROM Medias WHERE media_id = :media_id");
    $checkStmt->bindValue(':media_id', $num, PDO::PARAM_STR);
    $checkStmt->execute();

    if (!$checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "指定されたメディアは存在しません";
        return $errors;
    }

    $stmt = $pdo->prepare("UPDATE Medias SET media_title = :title WHERE media_id = :num");
    $stmt->bindValue(':num', $num, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title, PDO::PARAM_STR);

    if (!$stmt->execute()) {
        $errors[] = "メディアの更新に失敗しました";
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

function updateCategory($media_id, $category)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("UPDATE Media_category SET media_category_name = :category WHERE media_id = :media_id");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTarget($media_id, $target)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("UPDATE Media_target SET media_target_name = :target WHERE media_id = :media_id");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
    $stmt->bindValue(':target', $target, PDO::PARAM_STR);
    $stmt->execute();
}

function updateTags($media_id, $tags)
{
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("DELETE FROM Media_tags WHERE media_id = :media_id");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_INT);
    $stmt->execute();

    insertTags($media_id, $tags);
}

function deleteMedia($media_id)
{
    $pdo = getPDOConnection();
    $errors = [];

    // トピックの存在チェック
    $checkStmt = $pdo->prepare("SELECT media_id FROM Medias WHERE media_id = :media_id");
    $checkStmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
    $checkStmt->execute();

    if (!$checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "指定されたメディアは存在しません";
        return $errors;
    }

    $stmt = $pdo->prepare("DELETE FROM Medias WHERE media_id = :media_id");
    $stmt->bindValue(':media_id', $media_id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $errors[] = "メディアの削除に失敗しました";
        return $errors;
    }

    return $media_id;
}
