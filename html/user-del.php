<?php
require_once 'includes/auth.php';
require_once 'includes/users.php';
require_once 'includes/helpers.php';

$register_num = sanitizeInput($_GET['i'] ?? '');
$username = sanitizeInput($_GET['n'] ?? '');
$role = sanitizeInput($_GET['r'] ?? '');


// エラーメッセージの初期化
$errors = [];
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $register_num = trim($_POST['number'] ?? '');

    if (empty($register_num)) {
        $errors[] = "登録番号を入力してください。";
    }

    if (empty($errors)) {
        $result = deleteUser($register_num);
        if (is_array($result)) {
            $errors = $result;
        } else {
            $success_message = "ユーザが正常に削除されました";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザ削除</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/path/to/common.css">
</head>
<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <?php include 'templates/header.php'; ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">ユーザ削除</h2>
            <form action="user-del.php" method="POST" class="space-y-3">
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
                            <label for="" class="">ユーザーID:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="number" placeholder="省略可能" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500" value="<?= $register_num ?>" readonly>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">ユーザ名:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="name" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500" value="<?= $username ?>" readonly>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">役割:</label>
                        </dt>
                        <dd class="ml-64">
                            <span class="ml-2 text-gray-700"><?= $role ?></span>
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
        <div class="text-sm text-gray-600 mt-6 flex justify-between">
            <a href="user-list.php">ユーザ一覧へ戻る</a>
        </div>
        <?php include 'templates/footer.php'; ?>
    </div>
</body>
</html>