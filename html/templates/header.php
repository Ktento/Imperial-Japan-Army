<header class="w-full bg-slate-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a class="text-xl font-bold" href="top.php">大日本帝国陸軍</a>
        <a href="login.php" class="px-4 py-2 bg-blue-500 hover:bg-blue-700 rounded text-white text-sm">ログイン</a>
        <a href="user-ins.php" class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded text-white text-sm">新規登録</a>
        <p class="text-sm">こんにちは、<?= htmlspecialchars($username ?? 'ゲスト', ENT_QUOTES, 'UTF-8') ?> さん</p>
    </div>
</header>