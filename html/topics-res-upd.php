<?php
// エラーを出力する
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>
<?php

require_once 'includes/auth.php';
require_once 'includes/helpers.php';

$topic_comment_id = sanitizeInput($_GET['tci'] ?? '');
$topic_id = sanitizeInput($_GET['ti'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');
$content = sanitizeInput($_GET['con'] ?? '');

?>
<?php
// エラーメッセージの初期化
$errors = [];
$success_message = "";
require_once 'includes/topics-comment.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_category = trim($_POST['comment_category'] ?? '');
    $topic_comment = trim($_POST['topic_comment'] ?? '');

    if (empty($topic_comment)) {
        $errors[] = "コメントは必須です。";
    }
    if (empty($comment_category)) {
        $errors[] = "種類は必須です。";
    }
    if (empty($errors)) {
        $result = updateComments($topic_comment_id, $comment_category, $topic_comment);
        if (is_array($result)) {
            $errors = $result;
            echo $errors;
        } else {
            $success_message = "コメントが正常に更新されました (ID: $result)";
            header("Location: topics-dtl.php?ti=$topic_id&t=$title&c=$category&a=$target");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トピック登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/path/to/common.css">
</head>

<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <?php include 'templates/header.php'; ?>
        <?php if (!$isAdmin): ?>
            <div class="bg-gray-100 p-4 mt-4 text-gray-700">
                <h2 class="border-b-2 mb-2 py-2 text-lg">インフォメーション</h2>
                <p class="text-sm">管理者権限が必要です</p>
            </div>
        <?php else: ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">コメント登録</h2>
            <form action="topics-res-upd.php?ti=<?= htmlspecialchars($topic_id) ?>&tci=<?= htmlspecialchars($topic_comment_id) ?>&t=<?= htmlspecialchars($title) ?>&c=<?= htmlspecialchars($category) ?>&a=<?= htmlspecialchars($target) ?>" method="POST" class="space-y-3">
                <fieldset>
                    <dl>
                        <dt class="float-left"></dt>
                        <dd class="ml-64">
                            <?php if (!empty($errors)): ?>
                                <div class="mb-4 p-3 text-red-600">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">コメント登録番号:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= $topic_comment_id ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">タイトル:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($title) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($category) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">対象:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($target) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input type="radio" name="comment_category" value="感想" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" <?= ($category === '感想') ? 'checked' : '' ?>>
                                    <span class="ml-2 text-gray-700">感想</span>
                                </label>
                                <label class="">
                                    <input type="radio" name="comment_category" value="質問" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" <?= ($category === '質問') ? 'checked' : '' ?>>
                                    <span class="ml-2 text-gray-700">質問</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60">
                            <label for="" class="">コメント:</label>
                        </dt>
                        <dd class="ml-64">
                            <textarea name="topic_comment" class="w-80 h-40 overflow-y-scroll p-2 text-left resize-none" style="resize: none;"><?= htmlspecialchars($content) ?></textarea>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60"></dt>
                        <dd class="ml-64">
                            <button type="submit" class="border border-black py-2 px-4 hover:text-gray-700 bg-white">
                                更新
                            </button>
                        </dd>
                    </dl>
                </fieldset>
            </form>
        </main>
        <?php endif; ?>
        <?php include 'templates/footer.php'; ?>
    </div>
</body>

</html>