<?php
require_once 'includes/auth.php';

// comment insert.php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // SQL文
    $sql = 'INSERT INTO media_comment (media_id, media_comment, media_category, media_target) VALUES(:media_id, :media_comment, :media_category, :media_target)';
    // DBへの接続
    $config = require_once 'config/config.php';
    $dsn = $config['dsn'];
    $user= $config['user'];
    $pass= $config['password'];
    try {
        // POSTデータの取得
        $media_id = $_POST['registration-number'];
        $media_comment = $_POST['comment'];
        $media_category = $_POST['category']; // ラジオボタンから取得
        $media_target = $_POST['target']; // 対象データの取得
        $pdo = new PDO($dsn, $user, $pass);
        
        // SQLの実行
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':media_id', $media_id);
        $stmt->bindValue(':media_comment', $media_comment);
        $stmt->bindValue(':media_category', $media_category); // カテゴリ
        $stmt->bindValue(':media_target', $media_target); // 対象
        
        if ($stmt->execute()) {
            echo "インサート成功";
        } else {
            echo "インサート失敗";
        }
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
}
?> 
<?php
// GETメソッドで値を取得
$i = isset($_GET['i']) ? $_GET['i'] : null;
$t = isset($_GET['t']) ? $_GET['t'] : null;
$c = isset($_GET['c']) ? $_GET['c'] : null;
$a = isset($_GET['a']) ? $_GET['a'] : null;

// 取得した値を表示
echo "i: " . var_dump($i) . "<br>";
echo "t: " . var_dump($t) . "<br>";
echo "c: " . var_dump($c) . "<br>";
echo "a: " . var_dump($a) . "<br>";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メディアへコメント登録</title>
</head>
<body>
<?php include 'templates/header.php'; ?>
    <div class="container">
        <form method="POST" action="">
            <!-- メディア登録番号などのフィールド -->
            <label for="registration-number">登録番号（※元のメディアのデータを表示）</label><br>

            <label for="media-title">タイトル（※元のメディアのデータを表示）</label><br>

            <label for="media-category">種類（※元のメディアのデータを表示）</label><br>


            <label for="media-target">対象（※元のメディアのデータを表示）</label><br>


            <label for="media-comment-number">コメント番号（※オートインクリメント</label><br>
            <input type="text" id="media-comment-number" name="media-comment-number" required><br>

            <label for="media-comment-category">種類</label><br>
            <input type="radio" id="question" name="category" value="質問" required> 質問<br>
            <input type="radio" id="kansou" name="category" value="感想" required> 感想<br>

            <label for="comment">コメント</label><br>
            <textarea id="comment" name="comment" rows="5" required></textarea><br>

            <div class="buttons">
                <button type="submit" id="insert" name="action" value="insert">登録</button>
            </div>
        </form>
    </div>
</body>
</html>
