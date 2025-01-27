<html lang="ja">

<head>
	<meta charset="utf-8" />
	<title>ユーザー一覧</title>
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<?php include 'templates/header.php'; ?>
	<form action="user-list.php" method="post" class="mb-4">
		<input type="text" class="border rounded p-2" name="user_name" value="<?php echo htmlspecialchars($_POST['user_name'] ?? ''); ?>">
		<input type="submit" class="bg-blue-500 text-white rounded p-2" value="部分一致検索">
	</form>

	<?php
	//SQL文
	$config = require_once 'config/config.php';

	$sql = 'select * from users where user_name LIKE :user_name order by created_at DESC';

	//DBへの接続
	$dsn = $config['dsn'];
	$user = $config['user'];
	$pass = $config['password'];
	try {
		$user_name = $_POST['user_name'] ?? '';
		$pdo = new PDO($dsn, $user, $pass);
		//SQLの実行
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':user_name', '%' . $user_name . '%');
		$stmt->execute();

		//結果の処理
		echo "<table class='min-w-full border-collapse border border-gray-200'>";
		print("<tr class='bg-gray-100'>");
		echo ("<th class='border border-gray-300 p-2'>ログインID</th><th class='border border-gray-300 p-2'>ユーザ氏名</th><th class='border border-gray-300 p-2'>レベル</th><th class='border border-gray-300 p-2'>編集</th><th class='border border-gray-300 p-2'>削除</th>");
		while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print("<tr class='border border-gray-300'>");
			print("<td class='border border-gray-300 p-2'>" . $result['user_id'] . "</td>");
			print("<td class='border border-gray-300 p-2'>" . $result['user_name'] . "</td>");
			print("<td class='border border-gray-300 p-2'><a class='text-blue-500 hover:underline' href='user-upd.php?id=" . $result['user_id'] . "'>編集</a></td>");
			print("<td class='border border-gray-300 p-2'><a class='text-blue-500 hover:underline' href='user-del.php?id=" . $result['user_id'] . "'>削除</a></td>");
			print("</tr>");
		}
		print("</tr>");
		echo "</table>";

		// foreachの値を変数に格納したい
	} catch (PDOException $e) {
		echo "接続失敗: " . $e->getMessage() . "\n";
	} finally {
		// DB接続を閉じる
		$pdo = null;
	}
	?>
</body>