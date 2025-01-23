<?php
require_once 'includes/auth.php';
?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //SQL文
    $sql = 'DELETE FROM media_comment WHERE media_comment_id=:media_comment_id';
    //DBへの接続
    $dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
    $user = "user01";
    $pass = "user01";
    try {
        //SQLの実行
        $media_comment_id = $_POST['registration-number'];
        $pdo = new PDO($dsn, $user, $pass);
        //SQLの実行
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':media_comment_id', $media_comment_id);
        if ($stmt->execute()) {
            echo "削除成功";
        } else {
            echo $result;
            echo "削除失敗";
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
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // フォームの送信を停止
            if (confirm('本当に削除してよろしいですか？')) {
                alert('削除が実行されます。');
                // 実際に削除を行う処理をここに追加
            } else {
                alert('削除がキャンセルされました。');
            }
        }
    </script>
</head>
<body>
<?php include 'templates/header.php'; ?>
    <div class="container">
        <form onsubmit="confirmDelete(event)">
            <label for="registration-number">登録番号</label>
            <input type="text" id="registration-number" name="registration-number" value="" disabled><br>

            <label for="title">タイトル</label>
            <input type="text" id="title" name="title" value="" disabled><br>

            <label for="category">種類</label><br>
            <input type="radio" id="感想" name="category" value="感想" disabled>
            <label for="感想">感想</label><br>
            <input type="radio" id="質問" name="category" value="質問" disabled>
            <label for="質問">質問</label><br>

            <label for="comment">コメント</label><br>
            <textarea id="comment" name="comment" rows="5" disabled></textarea><br>

            <div class="buttons">
                <button type="submit" id="delete" name="action" value="delete">削除</button>
            </div>
        </form>
    </div>
</body>
</html>
