<?php
// エラーを出力する
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>

<?php
require_once 'includes/auth.php';
require_once 'includes/top.php';

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8" />
    <title>トップ画面</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
</head>

<body>
    <?php include 'templates/header.php'; ?>
    <p>登録されているトピックス(最新5件)</p>
    <a href="topics-ins.php">トピックス新規登録</a>
    <?php
    // DBへの接続設定
    $dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
    $user = "user01";
    $pass = "user01";

    // SQL文
    $topic_sql = 'SELECT 
    Users.user_id, 
    Users.user_name, 
    Users.user_level, 
    Medias.media_id, 
    Medias.media_title, 
    Media_category.media_category_name, 
    Media_target.media_target_name, 
    Topics.topic_id, 
    Topics.topic_title, 
    Topic_category.topic_category_name, 
    Topic_target.topic_target_name, 
    Topic_comment.topic_comment, 
    COUNT(Topic_comment.topic_comment) AS topic_comment_count, 
    Tags.tag_name, 
    Media_comment.media_comment
FROM 
    Users
INNER JOIN Medias ON Users.user_id = Medias.user_id
INNER JOIN Media_category ON Medias.media_category_id = Media_category.media_category_id
INNER JOIN Media_target ON Medias.media_target_id = Media_target.media_target_id
LEFT JOIN Topics ON Users.user_id = Topics.user_id
LEFT JOIN Topic_category ON Topics.topic_id = Topic_category.topic_id
LEFT JOIN Topic_target ON Topics.topic_id = Topic_target.topic_id
LEFT JOIN Topic_comment ON Topics.topic_id = Topic_comment.topic_id
LEFT JOIN Media_comment ON Medias.media_id = Media_comment.media_id
LEFT JOIN Media_tags ON Medias.media_id = Media_tags.media_id
LEFT JOIN Tags ON Media_tags.tag_id = Tags.tag_id
GROUP BY 
    Users.user_id, 
    Users.user_name, 
    Users.user_level, 
    Medias.media_id, 
    Medias.media_title, 
    Media_category.media_category_name, 
    Media_target.media_target_name, 
    Topics.topic_id, 
    Topics.topic_title, 
    Topic_category.topic_category_name, 
    Topic_target.topic_target_name, 
    Topic_comment.topic_comment, 
    Tags.tag_name, 
    Media_comment.media_comment
ORDER BY 
    Topics.created_at DESC,
    Medias.media_id DESC, 
    Topics.topic_id DESC
LIMIT 5;
;';

    try {
        // PDOオブジェクトを生成して接続
        $pdo = new PDO($dsn, $user, $pass);

        // SQLを実行
        $stmt = $pdo->prepare($topic_sql);
        $stmt->execute();

        // 結果の出力
        echo "<table border='1'>";
        echo "<tr>
                <th>種類</th>
                <th>対象</th>
                <th>タイトル</th>
                <th>コメント件数</th>
                <th>編集</th>
                <th>削除</th>
              </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars($row['topic_id'], ENT_QUOTES, 'UTF-8');
            $title = htmlspecialchars($row['topic_title'], ENT_QUOTES, 'UTF-8');
            $target = htmlspecialchars($row['topic_target_name'], ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['topic_category_name'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['topic_category_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['topic_target_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td><a href='topics-dtl.php?i={$id}&t={$title}&c={$category}&a={$target}'>{$title}</a></td>";
            echo "<td>" . htmlspecialchars($row['topic_comment_count'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td><a href='topics-upd.php?i={$id}&t={$title}&c={$category}&a={$target}'>編集</a></td>";
            echo "<td><a href='topics-del.php?i={$id}&t={$title}&c={$category}&a={$target}'>削除</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "<br>";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
    ?>
    <p>登録されているメディア(最新5件)</p>
    <a href="media-ins.php">メディア新規登録</a>
    <?php
    // DBへの接続設定
    $dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
    $user = "user01";
    $pass = "user01";

    // SQL文
    $media_sql = 'SELECT 
    Users.user_id, 
    Users.user_name, 
    Users.user_level, 
    Medias.media_id, 
    Medias.media_title, 
    Media_category.media_category_name, 
    Media_target.media_target_name, 
    Topics.topic_id, 
    Topics.topic_title, 
    Topic_category.topic_category_name, 
    Topic_target.topic_target_name, 
    Topic_comment.topic_comment, 
    COUNT(Media_comment.media_comment) AS media_comment_count, 
    Tags.tag_name, 
    Media_comment.media_comment
FROM 
    Users
INNER JOIN Medias ON Users.user_id = Medias.user_id
INNER JOIN Media_category ON Medias.media_category_id = Media_category.media_category_id
INNER JOIN Media_target ON Medias.media_target_id = Media_target.media_target_id
LEFT JOIN Topics ON Users.user_id = Topics.user_id
LEFT JOIN Topic_category ON Topics.topic_id = Topic_category.topic_id
LEFT JOIN Topic_target ON Topics.topic_id = Topic_target.topic_id
LEFT JOIN Topic_comment ON Topics.topic_id = Topic_comment.topic_id
LEFT JOIN Media_comment ON Medias.media_id = Media_comment.media_id
LEFT JOIN Media_tags ON Medias.media_id = Media_tags.media_id
LEFT JOIN Tags ON Media_tags.tag_id = Tags.tag_id
GROUP BY 
    Users.user_id, 
    Users.user_name, 
    Users.user_level, 
    Medias.media_id, 
    Medias.media_title, 
    Media_category.media_category_name, 
    Media_target.media_target_name, 
    Topics.topic_id, 
    Topics.topic_title, 
    Topic_category.topic_category_name, 
    Topic_target.topic_target_name, 
    Topic_comment.topic_comment, 
    Tags.tag_name, 
    Media_comment.media_comment
ORDER BY 
    Medias.created_at DESC,
    Medias.media_id DESC, 
    Topics.topic_id DESC
LIMIT 5
;';

    try {
        // PDOオブジェクトを生成して接続
        $pdo = new PDO($dsn, $user, $pass);

        // SQLを実行
        $stmt = $pdo->prepare($media_sql);
        $stmt->execute();

        // 結果の出力
        echo "<table border='1'>";
        echo "<tr>
                <th>種類</th>
                <th>対象</th>
                <th>タイトル</th>
                <th>コメント件数</th>
                <th>編集</th>
                <th>削除</th>
              </tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id = htmlspecialchars($row['topic_id'], ENT_QUOTES, 'UTF-8');
            $title = htmlspecialchars($row['topic_title'], ENT_QUOTES, 'UTF-8');
            $target = htmlspecialchars($row['topic_target_name'], ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['topic_category_name'], ENT_QUOTES, 'UTF-8');

            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['media_category_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['media_target_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td><a href='media-dtl.php?i={$id}&t={$title}&c={$category}&a={$target}'>{$title}</a></td>";
            echo "<td>" . htmlspecialchars($row['media_comment_count'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td><a href='media-upd.php?i={$id}&t={$title}&c={$category}&a={$target}'>編集</a></td>";
            echo "<td><a href='media-del.php?i={$id}&t={$title}&c={$category}&a={$target}'>削除</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "<br>";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
    ?>
</body>

</html>