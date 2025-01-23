<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>メディアへコメント登録</title>
</head>
<body>
こんにちはuser_nameさん。
<form action="media-ent.php" method="post">
<p>登録番号</p>
<p>タイトル</p>
<p>種類</p>
<p>対象</p>

    <label for="number">登録番号:</label>
    <input type="text" id="number" name="number" required><br>

    <label for="title">タイトル:</label>
    <input type="text" id="title" name="title" required><br>

    <label for="category">種類:</label>
    <input type="text" id="category" name="category" required><br>

    <label for="target">対象:</label>
    <input type="text" id="target" name="target" required><br>

    <input type="radio" id="coffee" name="drink" value="impression">
    <label for="impression">感想</label><br>

    <input type="radio" id="question" name="drink" value="question">
    <label for="tea">質問</label><br>

    <label for="comment">コメント</label><br>
    <textarea id="comment" name="comment" rows="5" cols="40" placeholder="ここに入力してください..."></textarea><br>

    <input type="submit" value="登録">

</form>
<?php
// DBへの接続設定
$dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
$user = "user01";
$pass = "user01";

// SQL文
$sql = 'SELECT * FROM medium ORDER BY update_time DESC LIMIT 5';

try {
    // PDOオブジェクトを生成して接続
    $pdo = new PDO($dsn, $user, $pass);

    // SQLを実行
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // 結果の出力

    echo "<table border='1'>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td>" . htmlspecialchars($row['update_time'], ENT_QUOTES, 'UTF-8') . "</td>";
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
