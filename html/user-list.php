<body>
<a href="user-ins.php">新規登録</a>
<form action="user-list.php" method="post">
	<input type="text" width="10" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
	<input type="submit" value="部分一致検索">
</form>	

<?php
//SQL文
$sql='select * from users where user_name LIKE :username order by created_at DESC';
//DBへの接続
//DBへの接続
$dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
$user="user01";
$pass="user01";
try {
	$username = $_POST['username'];
    $pdo = new PDO($dsn,$user,$pass);
	//SQLの実行
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':username', '%'.$username.'%');
	$stmt->execute();

	//結果の処理
	echo "<table border=1>";
	print("<tr>");
	echo("<th>ログインID</th>ユーザ氏名<th>レベル</th><th>編集</th><th>削除</th>");
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		print("<tr>");
		print("<td>" . $result['user_id'] . "</td>");
		print("<td>" . $result['user_name'] . "</td>");
		print("<td><a href='user-upd.php?id=" . $result['user_id'] . "'>編集</a></td>");
		print("<td><a href='user-del.php?id=" . $result['user_id'] . "'>削除</a></td>");
		print("</tr>");
	}
	print("</tr>");
	echo "</table>";

// foreachの値を変数に格納したい
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
} finally{
    // DB接続を閉じる
    $pdo = null;
}
?>
</body>