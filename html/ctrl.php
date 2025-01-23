<?php
session_start();

// セッション変数の操作
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['set_session'])) {
        $_SESSION['username'] = $_POST['username'] ?? 'ゲスト';
        $_SESSION['user_id'] = $_POST['user_id'] ?? null;
        $message = "セッション変数を設定しました。";
    } elseif (isset($_POST['clear_session'])) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        $message = "セッション変数をクリアしました。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>セッションコントロールパネル</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">
    <header class="w-full bg-indigo-600 text-white py-4 mb-6">
        <div class="container mx-auto flex justify-center">
            <h1 class="text-xl font-bold">セッションコントロールパネル</h1>
        </div>
    </header>

    <main class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <?php if (!empty($message)): ?>
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <form action="ctrl.php" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">ユーザー名</label>
                <input type="text" name="username" id="username" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">ユーザーID</label>
                <input type="text" name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex space-x-4">
                <button type="submit" name="set_session" class="w-full bg-green-600 text-white py-2 px-4 rounded-md shadow hover:bg-green-700 focus:ring-2 focus:ring-green-500">
                    セッション設定
                </button>
                <button type="submit" name="clear_session" class="w-full bg-red-600 text-white py-2 px-4 rounded-md shadow hover:bg-red-700 focus:ring-2 focus:ring-red-500">
                    セッションクリア
                </button>
            </div>
        </form>

        <div class="mt-6 p-4 bg-gray-50 rounded shadow-sm">
            <h2 class="text-lg font-semibold mb-2">現在のセッション変数</h2>
            <pre class="text-sm bg-gray-100 p-2 rounded"><?php print_r($_SESSION); ?></pre>
        </div>
    </main>
</body>
</html>
