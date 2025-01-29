<?php
require_once 'includes/auth.php';
require_once 'includes/topics.php';
require_once 'includes/helpers.php';

$register_num = sanitizeInput($_GET['ti'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');
$tags = sanitizeInput($_GET['g'] ?? '');

// エラーメッセージの初期化
$errors = [];
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $register_num = trim($_POST['number'] ?? '');

    if (empty($register_num)) {
        $errors[] = "登録番号を入力してください。";
    }

    if (empty($errors)) {
        $result = deleteTopic($register_num);
        if (is_array($result)) {
            $errors = $result;
        } else {
            $success_message = "トピックが正常に削除されました (ID: $result)";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トピック削除</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/path/to/common.css">
</head>
<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <?php include 'templates/header.php'; ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">トピックス削除</h2>
            <form action="topics-del.php" method="POST" class="space-y-3">
                <fieldset>
                    <dl>
                        <dt class="float-left"></dt>
                        <dd class="ml-64">
                            <?php if (!empty($success_message)): ?>
                                <div class="mb-4 p-3 text-green-600">
                                    <?= htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
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
                            <label for="" class="">登録番号:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="number" placeholder="省略可能" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500" value="<?= $register_num ?>" readonly>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">タイトル:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="title" id="title" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500" value="<?= $title ?>" readonly>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input <?= $category == "お知らせ" ? 'checked' : '' ?> type="radio" name="category" value="お知らせ" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" disabled>
                                    <span class="ml-2 text-gray-700">お知らせ</span>
                                </label>
                                <label class="">
                                    <input <?= $category == "ニュース" ? 'checked' : '' ?> type="radio" name="category" value="ニュース" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" disabled>
                                    <span class="ml-2 text-gray-700">ニュース</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">対象:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input <?= $target == "学生" ? 'checked' : '' ?> type="radio" name="target" value="学生" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" disabled>
                                    <span class="ml-2 text-gray-700">学生</span>
                                </label>
                                <label class="">
                                    <input <?= $target == "教員" ? 'checked' : '' ?> type="radio" name="target" value="教員" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800" disabled>
                                    <span class="ml-2 text-gray-700">教員</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60">
                            <label for="" class="">タグ:</label>
                            <br>
                            <span class="text-xs text-gray-900">
                                タグをコンマ(,)で区切って入力してください<br> 例: PHP, MySQL, プログラミング
                            </span>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="tags" placeholder="PHP, MySQL, プログラミング" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500" value="<?= $tags ?>" readonly>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60"></dt>
                        <dd class="ml-64">
                            <button type="submit" class="border border-black py-2 px-4 hover:text-gray-700 bg-white">
                               削除
                            </button>
                        </dd>
                    </dl>
                </fieldset>
            </form>
        </main>
        <?php include 'templates/footer.php'; ?>
    </div>
</body>
</html>
