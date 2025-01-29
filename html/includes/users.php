<?php
require_once 'db.php';

function updateUser($id, $name, $role) {
    $pdo = getPDOConnection();
    $stmt = $pdo->prepare("UPDATE users SET user_name = :name, user_level = :role WHERE user_id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':role', $role, PDO::PARAM_STR);

    $stmt->execute();
}

function deleteUser($id) {
    $pdo = getPDOConnection();
    $errors = [];

    // ユーザの存在チェック
    $checkStmt = $pdo->prepare("SELECT 1 FROM users WHERE user_id = :id");
    $checkStmt->bindValue(':id', $id, PDO::PARAM_STR);
    $checkStmt->execute();

    if (!$checkStmt->fetch(PDO::FETCH_ASSOC)) {
        $errors[] = "指定されたユーザは存在しません";
        return $errors;
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        $errors[] = "トピックの削除に失敗しました";
        return $errors;
    }

    return $id;
}

?>