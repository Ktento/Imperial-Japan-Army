<body>
<form action="sample_prepare_J23005_4.php" method="post">
	<input type="text" width="10" name="seito_name" value="<?php echo htmlspecialchars($_POST['seito_name'] ?? ''); ?>">
	<input type="submit" value="部分一致検索">
</form>	

<?php
//SQL文
$sql='select seito_no,seito_name from seito_tbl where seito_name like :seito_name';
//DBへの接続
//DBへの接続
$dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
$user="user01";
$pass="user01";
try {
	$seito_name = $_POST['seito_name'];
    $pdo = new PDO($dsn,$user,$pass);
	//SQLの実行
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':seito_name', '%'.$seito_name.'%');
	$stmt->execute();

	//結果の処理
	$i=1;
	echo "<table border=1>";
	print("<tr>");
	echo("<th>No</th><th>生徒番号</th><th>氏名</th>");
	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
		print("<tr>");
		print("<td>" . $i . "</td>");
		print("<td>" . $result['seito_no'] . "</td>");
		print("<td>" . $result['seito_name'] . "</td>");
		print("</tr>");
		$i++;
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