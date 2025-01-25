<!DOTYPE html>
	<html lang="ja">

	<head>
		<meta charset="utf-8" />
		<title>ログイン</title>
	</head>

	<body>
		<form method="POST">
			<label for="loginid">ログインID:</label>
			<input type="textbox" id="loginid" name="loginid" required><br>
			<label for="password">パスワード:</label>
			<input type="password" id="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" require><br>
			<input type="submit" value="ログイン">
		</form>
		<?php
		if ($_SERVER["REQUEST_METHOD"] === "POST") {
			$config = require_once 'config/config.php';
			//SQL文
			$sql = 'select * from users where user_id = :loginid and user_password =:password';
			//DBへの接続
			try {
				//SQLの実行
				$loginid = $_POST['loginid'];
				$password = $_POST['password'];
				$pdo = new PDO($config['dsn'], $config['user'], $config['password']);
				//SQLの実行
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':loginid', $loginid);
				$stmt->bindValue(':password', $password);
				$stmt->execute();

				//結果の処理
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				//SQLの結果が存在するかの確認
				if ($result) {
					session_start();
					//権限とuser_nameを結果から取得
					$rool = $result["user_level"];
					$user_name = $result["user_name"];
					//SESSIONに保存
					$_SESSION['loginid'] = $loginid;
					$_SESSION['is_logged_in'] = true;
					$_SESSION['user_name'] = $user_name;
					$_SESSION['role'] = $rool;
					header("Location: top.php");
					exit();
				} else {
					echo $result;
					echo "ログイン失敗";
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
	</body>

	</html>