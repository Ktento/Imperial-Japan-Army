<?php
require_once 'includes/auth.php';
require_once 'includes/helpers.php';
require_once 'includes/topics-comment.php';
$topic_comment_id = sanitizeInput($_GET['tci'] ?? '');
$topic_id = sanitizeInput($_GET['ti'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');
$errors = [];
if ($topic_comment_id) {
    $result = deleteComments($topic_comment_id);
    if (is_array($result)) {
        $errors = $result;
    } else {
        $success_message = "トピックが正常に削除されました (ID: $result)";
        header("Location: topics-dtl.php?ti=$topic_id&t=$title&c=$category&a=$target");
        exit();
    }
}

header("Location: topics-dtl.php?ti=$topic_id&t=$title&c=$category&a=$target");
exit();
