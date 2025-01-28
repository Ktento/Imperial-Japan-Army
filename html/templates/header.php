<header class="w-full bg-slate-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
        <a class="text-xl font-bold" href="top.php">大日本帝国陸軍</a>
        <p class="text-sm">こんにちは、<?= htmlspecialchars($username ?? 'ゲスト', ENT_QUOTES, 'UTF-8') ?> さん</p>
    </div>
    <div class="container mx-auto flex items-center px-4 gap-2">
        <a href="login.php" class="px-4 py-2 text-white text-sm">トップ</a>
        <a href="login.php" class="px-4 py-2 text-white text-sm">トピック登録</a>
        <a href="user-ins.php" class="px-4 py-2 hover:bg-slate-900 rounded text-white text-sm">メディア登録</a>
        <a href="user-ins.php" class="px-4 py-2 hover:bg-slate-900 rounded text-white text-sm">ユーザ登録</a>
        <a href="user-ins.php" class="px-4 py-2 hover:bg-slate-900 rounded text-white text-sm">ユーザ一覧</a>
    </div>
</header>