<?php
// エラーを出力する
ini_set( 'display_errors', 1 );
ini_set('error_reporting', E_ALL);
?>

<?php
require_once 'includes/auth.php';
require_once 'includes/helpers.php';
require_once 'includes/media.php';

$filename = "media";

$media_id = sanitizeInput($_GET['mi'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');

$comments = null;

if ($media_id) {
    $total_comments = fetchTotalComments($media_id);
    $comments = fetchComments($media_id);
    $tags = fetchTags($media_id);
}

// デバック用
require_once 'test/tests.php';
?>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>media詳細</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <!-- ヘッダー -->
        <?php include 'templates/header.php'; ?>

        <?php if (isset($total_comments)): ?>
            <!-- メディア情報 -->
            <?php include 'views/media-details.php'; ?>

            <!-- タイトル -->
            <div class="my-2 mt-5">
                <h2 class="text-2xl"><?= $title ?></h2>
            </div>

            <!--- タグの一覧 -->
            <div class="mt-6">
                <div class="flex flex-wrap gap-2 mb-2">
                    <?php include 'views/tags.php'; ?>
                </div>
            </div>
            <hr>

            <!-- アクションボタン -->
            <div class="text-sm text-gray-600 mt-6 flex justify-between mb-2">
                <a href="media-res-ins.php?mi=<?= $media_id ?>&t=<?= $title ?>&c=<?= $category ?>&a=<?= $target ?>" class="border p-2">コメント新規登録</a>
                <?php include 'views/pagenation.php'; ?>
            </div>

            <!-- コメント一覧 -->
            <?php include 'views/media-comments.php'; ?>

            <!-- アクションボタン -->
            <div class="text-sm text-gray-600 mt-6 flex justify-between">
                <a href="top.php">トップ画面へ戻る</a>
                <?php include 'views/pagenation.php'; ?>
            </div>
        <?php else: ?>
            <div class="bg-gray-100 p-4 mt-4 text-gray-700">
                <h2 class="border-b-2 mb-2 py-2 text-lg">インフォメーション</h2>
                <p class="text-sm">指定されたメディアは存在しません。</p>
            </div>
            <div class="text-sm text-gray-600 mt-6 flex justify-between">
                <a href="top.php">トップ画面へ戻る</a>
            </div>
        <?php endif; ?>

        <!-- フッター -->
        <?php include 'templates/footer.php'; ?>
    </div>
</body>
</html>