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
            echo "<td>" . htmlspecialchars($row['コメント件数'], ENT_QUOTES, 'UTF-8') . "</td>";
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
    $media_sql = 'SELECT medias.media_id,media_category.media_category_name,media_target.media_target_name,medias.media_title,COALESCE(A.コメント件数,0) AS コメント件数 FROM `medias` 
                    LEFT JOIN (SELECT media_id,COUNT(*) as コメント件数 FROM media_comment GROUP BY media_id) as A ON medias.media_id=A.media_id 
                    LEFT JOIN media_target ON medias.media_id=media_target.media_id 
                    LEFT JOIN `media_category` ON medias.media_id = media_category.media_id 
                    LEFT JOIN `media_tags` ON medias.media_id = media_tags.media_id 
                    ORDER BY medias.created_at DESC LIMIT 5';
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
            $id = htmlspecialchars($row['media_id'], ENT_QUOTES, 'UTF-8');
            $title = htmlspecialchars($row['media_title'], ENT_QUOTES, 'UTF-8');
            $target = htmlspecialchars($row['media_target_name'], ENT_QUOTES, 'UTF-8');
            $category = htmlspecialchars($row['media_category_name'], ENT_QUOTES, 'UTF-8');

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