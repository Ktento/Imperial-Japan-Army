<?php
require_once 'includes/auth.php';
?>
<!-- comment upd.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //SQL文
    $sql = 'UPDATE media_comment SET media_comment=:media_comment WHERE media_comment_id=:media_comment_id';
    //DBへの接続
    $config = require_once 'config/config.php';
    $dsn = $config['dsn'];
    $user= $config['user'];
    $pass= $config['password'];
    try {
        //SQLの実行
        $media_comment_id = $_POST['registration-number'];
        $media_comment = $_POST['*comment'];
        $pdo = new PDO($dsn, $user, $pass);
        //SQLの実行
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':media_comment_id', $media_comment_id);
        $stmt->bindValue(':media_comment', $media_comment);
        if ($stmt->execute()) {
            echo "更新成功";
        } else {
            echo $result;
            echo "更新失敗";
        }
        // foreachの値を変数に格納したい
    } catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "\n";
    } finally {
        // DB接続を閉じる
        $pdo = null;
    }
}
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
        <form>
            <label for="registration-number">登録番号</label>
            <input type="text" id="registration-number" name="registration-number" value="" disabled><br>

            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="" disabled><br>

            <label for="category">種類</label><br>
            <input type="radio" id="感想" name="category" value="感想" required>
            <label for="感想">感想</label><br>
            <input type="radio" id="質問" name="category" value="質問" required>
            <label for="質問">質問</label><br>

            <label for="comment">コメント</label><br>
            <textarea id="comment" name="comment" rows="5" required></textarea><br>

            <div class="buttons">
                <button type="submit" id="insert" name="action" value="insert">更新</button>
            </div>
        </form>
    </div>
</body>
</html>
