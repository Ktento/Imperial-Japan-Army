<?php
require_once 'db.php';
//トピックスのコメントの登録を行うヘルパー関数
function insertComments($media_comment_id, $media_id, $user_id, $comment_category, $media_comment)
{
    try {
        $pdo = getPDOConnection();
        if (empty($media_comment_id)) {
            $stmt = $pdo->prepare('
            INSERT INTO media_comment(media_id, user_id, comment_category, media_comment) 
            VALUES(:media_id, :user_id, :comment_category, :media_comment)
            ');
            $stmt->bindValue(':media_id', $media_id);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_category', $comment_category);
            $stmt->bindValue(':media_comment', $media_comment);
        } else {

            $stmt = $pdo->prepare('
            INSERT INTO media_comment(media_comment_id,media_id, user_id, comment_category, media_comment) 
            VALUES(:media_comment_id,:media_id, :user_id, :comment_category, :media_comment)
            ');
            $stmt->bindValue(':media_comment_id', $media_comment_id);
            $stmt->bindValue(':media_id', $media_id);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_category', $comment_category);
            $stmt->bindValue(':media_comment', $media_comment);
        }
        if (!$stmt->execute()) {
            $errors[] = "新しいトピックの挿入に失敗しました";
            return $errors;
        }
        return $media_comment_id;
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
}
//トピックスのコメントの削除を行うヘルパー関数
function deleteComments($media_comment_id)
{
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("DELETE FROM media_comment WHERE media_comment_id = :media_comment_id");
        $stmt->bindValue(':media_comment_id', $media_comment_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $errors[] = "コメントの削除に失敗しました";
            return $errors;
        }
        return $media_comment_id;
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        $pdo = null;
    }
}
//トピックスのコメントの更新を行うヘルパー関数
function updateComments($media_comment_id, $comment_category, $media_comment)
{
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("UPDATE media_comment SET comment_category = :comment_category, media_comment = :media_comment WHERE media_comment_id = :media_comment_id");
        $stmt->bindValue(':media_comment_id', $media_comment_id, PDO::PARAM_INT);
        $stmt->bindValue(':comment_category', $comment_category, PDO::PARAM_STR);
        $stmt->bindValue(':media_comment', $media_comment, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $errors[] = "コメントの更新に失敗しました";
            return $errors;
        }
        return $media_comment_id;
    } catch (PDOException $e) {
        $errors[] = "接続失敗: " . $e->getMessage() . "\n";
        return $errors;
    } finally {
        $pdo = null;
    }
}
