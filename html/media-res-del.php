<?php
require_once 'includes/auth.php';
require_once 'includes/helpers.php';
require_once 'includes/media-comment.php';
$media_comment_id = sanitizeInput($_GET['mci'] ?? '');
$media_id = sanitizeInput($_GET['mi'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');
$errors = [];
if ($media_comment_id) {
    $result = deleteComments($media_comment_id);
    if (is_array($result)) {
        $errors = $result;
    } else {
        $success_message = "メディアが正常に削除されました (ID: $result)";
        header("Location: media-dtl.php?mi=$media_id&t=$title&c=$category&a=$target");
        exit();
    }
}

header("Location: media-dtl.php?mi=$media_id&t=$title&c=$category&a=$target");
exit();
