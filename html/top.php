<?php
// エラーを出力する
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>

<?php
require_once 'includes/auth.php';
require_once 'includes/top.php';

$config = require_once 'config/config.php';

// DBへの接続設定
$dsn = $config['dsn'];
$user = $config['user'];
$pass = $config['password'];

// SQL文
$topic_sql = 'SELECT topics.topic_id,topic_category.topic_category_name,topic_target.topic_target_name,topics.topic_title,COALESCE(A.コメント件数,0) AS コメント件数 FROM `topics` 
                LEFT JOIN (SELECT topic_id,COUNT(*) as コメント件数 FROM topic_comment GROUP BY topic_id) as A ON topics.topic_id=A.topic_id 
                LEFT JOIN topic_target ON topics.topic_id=topic_target.topic_id 
                LEFT JOIN `topic_category` ON topics.topic_id = topic_category.topic_id 
                LEFT JOIN `topic_tags` ON topics.topic_id = topic_tags.topic_id 
                ORDER BY topics.created_at DESC LIMIT 5';

try {
    // PDOオブジェクトを生成して接続
    $pdo = new PDO($dsn, $user, $pass);
    // SQLを実行
    $stmt = $pdo->prepare($topic_sql);
    $stmt->execute();
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "<br>";
} finally {
    // DB接続を閉じる
    $pdo = null;
}

// SQL文
// $media_sql = 'SELECT media.media_id,media_category.media_category_name,media_target.media_target_name,media.media_title,COALESCE(A.コメント件数,0) AS コメント件数 FROM `media` 
// LEFT JOIN (SELECT media_id,COUNT(*) as コメント件数 FROM media_comment GROUP BY media_id) as A ON media.media_id=A.media_id 
// LEFT JOIN media_target ON media.media_id=media_target.media_id 
// LEFT JOIN `media_category` ON media.media_id = media_category.media_id 
// LEFT JOIN `media_tags` ON media.media_id = media_tags.media_id 
// ORDER BY media.created_at DESC LIMIT 5';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>トップ画面</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <?php include 'templates/header.php'; ?>
    <div class="flex justify-between items-center space-x-4">
        <a href="topics-ins.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">トピックス新規登録</a>
        <p>登録されているトピックス(最新5件)</p>
    </div>
    <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">種類</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">対象</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">タイトル</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">コメント件数</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">編集</th>
                <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">削除</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topics as $topic):
                $topic_id = htmlspecialchars($topic['topic_id'] ?? "0", ENT_QUOTES, 'UTF-8');
                $title = htmlspecialchars($topic['topic_title'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
                $category = htmlspecialchars($topic['topic_category_name'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
                $target = htmlspecialchars($topic['topic_target_name'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');
                $comment_count = htmlspecialchars($topic['コメント件数'] ?? "取得できませんでした", ENT_QUOTES, 'UTF-8');

                $array_tags = fetchTopicTags($topic_id);
                $tags = htmlspecialchars(implode(',', $array_tags), ENT_QUOTES, 'UTF-8');
            ?>
            <tr class="bg-gray-50">
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $category ?></td>
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $target ?></td>
                <td class='py-2 px-4 border-b text-sm text-gray-600'>
                    <a href='topics-dtl.php?ti={$topic_id}&t={$title}&c={$category}&a={$target}'>
                        <?= $title ?>
                    </a>
                    <div class='flex flex-wrap gap-1'>
                        <?php foreach ($array_tags as $tag): ?>
                            <span class='px-1 border text-xs'><?= htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endforeach; ?>
                    </div>
                </td>
                <td class="py-2 px-4 border-b text-sm text-gray-600"><?= $comment_count ?></td>
                <td class='py-2 px-4 border-b text-sm text-gray-600'><a href='topics-upd.php?ti={$topic_id}&t={$title}&c={$category}&a={$target}&g={$tags}'>編集</a></td>
                <td class='py-2 px-4 border-b text-sm text-gray-600'><a href='topics-del.php?ti={$topic_id}&t={$title}&c={$category}&a={$target}&g={$tags}'>削除</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="flex justify-between items-center space-x-4">
        <a href="media-ins.php" class="inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">メディア新規登録</a>
        <p>登録されているメディア(最新5件)</p>
    </div>
</body>

</html>