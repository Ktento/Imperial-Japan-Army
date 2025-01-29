<?php
require_once 'includes/auth.php';
require_once 'includes/top.php';

$config = require_once 'config/config.php';

// DBへの接続設定
$dsn = $config['dsn'];
$user = $config['user'];
$pass = $config['password'];

// SQL文
$tags_sql = 'SELECT DISTINCT tag_name FROM tags WHERE tag_name IS NOT NULL';
$topic_sql = 'SELECT * FROM view_topic_comments';
$media_sql = 'SELECT * FROM view_media_comments';

try {
    // PDOオブジェクトを生成して接続
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // タグ取得
    $stmt = $pdo->prepare($tags_sql);
    $stmt->execute();
    $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // フィルタリング条件を動的に作成
    $params = [];
    $conditions = [];

    if (!empty($_GET['qc'])) {
        $conditions[] = "category = :category";
        $params[':category'] = $_GET['qc'];
    }

    if (!empty($_GET['qt'])) {
        $conditions[] = "target = :target";
        $params[':target'] = $_GET['qt'];
    }

    // 'tag_name' フィルタリング条件
    if (!empty($_GET['tags'])) {
        $topic_sql .= " WHERE id IN (
                            SELECT t.topic_id
                            FROM topics t
                            JOIN topic_tags tt ON t.topic_id = tt.topic_id
                            JOIN tags tg ON tt.tag_id = tg.tag_id
                            WHERE tg.tag_name = :tag_name
                        )";
        $media_sql .= " WHERE id IN (
                            SELECT m.media_id
                            FROM media m
                            JOIN media_tags mt ON m.media_id = mt.media_id
                            JOIN tags tg ON mt.tag_id = tg.tag_id
                            WHERE tg.tag_name = :tag_name
                        )";

                        
        $params[':tag_name'] = $_GET['tags'];
    }

    // WHERE 句を組み立て
    if (!empty($conditions)) {
        $where_clause = " WHERE " . implode(" AND ", $conditions);
    } else {
        $where_clause = " LIMIT 5";
    }

    // SQLを組み立てる
    $topic_sql .= $where_clause;
    $media_sql .= $where_clause;

    // SQLを実行（トピック）
    $stmt = $pdo->prepare($topic_sql);
    $stmt->execute($params);
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $topic_count = count($topics);

    // SQLを実行（メディア）
    $stmt = $pdo->prepare($media_sql);
    $stmt->execute($params);
    $media = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $media_count = count($media);

} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "<br>";
} finally {
    // DB接続を閉じる
    $pdo = null;
}
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
    <div class="container mx-auto flex mt-8">
        <aside class="w-1/4  p-4 hidden lg:block space-y-2 text-gray-600">
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-bold mb-4">種類</h2>
                <ul class="space-y-2">
                    <li><a href="top.php?qc=お知らせ" class="hover:text-green-500">お知らせ</a></li>
                    <li><a href="top.php?qc=ニュース" class="hover:text-green-500">ニュース</a></li>
                    <li><a href="top.php?qc=本" class="hover:text-green-500">本</a></li>
                    <li><a href="top.php?qc=動画" class="hover:text-green-500">動画</a></li>
                </ul>
            
            </div>
            <div class="bg-white shadow rounded p-4">
                <h2 class="text-lg font-bold mb-4">対象</h2>
                <ul class="space-y-2">
                    <li><a href="top.php?qt=学生" class="hover:text-green-500">学生</a></li>
                    <li><a href="top.php?qt=教員" class="hover:text-green-500">教員</a></li>
                </ul>
            </div>
            <div class="p-4">
                <h2 class="text-lg font-bold mb-4">タグ一覧</h2>
                <ul class="space-y-2">
                    <?php foreach ($tags as $tag): ?>
                        <li><a href="top.php?tags=<?= $tag['tag_name'] ?>" class="hover:text-green-500"><?= htmlspecialchars($tag['tag_name'], ENT_QUOTES, 'UTF-8') ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </aside>
        <div class="w-full lg:w-3/4 px-4">
            <?php
                $name = "トピック";
                $filename = "topics";
                $rows = $topics;
                $count = $topic_count;
                include 'views/table.php'; 
            ?>
            <?php 
                $name = "メディア";
                $filename = "media";
                $rows = $media;
                $count = $media_count;
                include 'views/table.php';
            ?>
        </div>
    </div>
</body>

</html>