<?php
require_once 'db.php';
function insertComments($topic_comment_id, $topic_id, $user_id, $comment_category, $topic_comment)
{
    try {
        $pdo = getPDOConnection();
        if (empty($topic_comment_id)) {
            $stmt = $pdo->prepare('
            INSERT INTO topic_comment(topic_id, user_id, comment_category, topic_comment) 
            VALUES(:topic_id, :user_id, :comment_category, :topic_comment)
            ');
            $stmt->bindValue(':topic_id', $topic_id);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_category', $comment_category);
            $stmt->bindValue(':topic_comment', $topic_comment);
        } else {

            $stmt = $pdo->prepare('
            INSERT INTO topic_comment(topic_comment_id,topic_id, user_id, comment_category, topic_comment) 
            VALUES(:topic_comment_id,:topic_id, :user_id, :comment_category, :topic_comment)
            ');
            $stmt->bindValue(':topic_comment_id', $topic_comment_id);
            $stmt->bindValue(':topic_id', $topic_id);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':comment_category', $comment_category);
            $stmt->bindValue(':topic_comment', $topic_comment);
        }
        if (!$stmt->execute()) {
            $errors[] = "新しいトピックの挿入に失敗しました";
            return $errors;
        }
        return $topic_comment_id;
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
}

function deleteComments($topic_comment_id)
{
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("DELETE FROM topic_comment WHERE topic_comment_id = :topic_comment_id");
        $stmt->bindValue(':topic_comment_id', $topic_comment_id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $errors[] = "コメントの削除に失敗しました";
            return $errors;
        }
        return $topic_comment_id;
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        $pdo = null;
    }
}
function updateComments($topic_comment_id, $topic_comment)
{
    try {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("UPDATE topic_comment SET topic_comment = :topic_comment WHERE topic_comment_id = :topic_comment_id");
        $stmt->bindValue(':topic_comment_id', $topic_comment_id, PDO::PARAM_INT);
        $stmt->bindValue(':topic_comment', $topic_comment, PDO::PARAM_STR);
        if (!$stmt->execute()) {
            $errors[] = "コメントの更新に失敗しました";
            return $errors;
        }
        return $topic_comment_id;
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        $pdo = null;
    }
}
