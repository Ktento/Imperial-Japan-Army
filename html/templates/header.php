<header class="w-full bg-slate-800 text-white">
    <div class="container mx-auto flex justify-between items-center px-4 py-1">
        <a class="text-xl font-bold" href="top.php">大日本帝国陸軍</a>
        <p class="text-sm">こんにちは、<?= htmlspecialchars($username ?? 'ゲスト', ENT_QUOTES, 'UTF-8') ?> さん</p>
    </div>
    <div class="container mx-auto flex items-center px-4 pb-2 gap-2">
        <a href="top.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">トップ</a>
        <a href="login.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">ログイン</a>
        <a href="topics-ins.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">トピック登録</a>
        <a href="media-ins.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">メディア登録</a>
        <a href="user-ins.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">ユーザ登録</a>
        <a href="user-list.php" class="px-4 py-1 hover:bg-slate-700 rounded text-white text-sm">ユーザ一覧</a>
    </div>
</header>