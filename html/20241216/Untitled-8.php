<?php
// データベース接続
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

$conn = new mysqli($servername, $username, $password, $dbname);

// 接続確認
if ($conn->connect_error) {
    die("データベース接続に失敗しました: " . $conn->connect_error);
}

// エラーメッセージ用変数
$error = "";

// フォーム送信時の処理
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action']; // ボタンによる動作（Insert, Update, Delete）
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $level = $_POST['level'] ?? '';
    $login_id = $_POST['login_id'] ?? null;

    // 入力チェック（必須項目）
    if (empty($username) || empty($password) || empty($level)) {
        $error = "ユーザー氏名、パスワード、レベルは必須項目です。";
    } else {
        if ($action === "insert") {
            // 新規登録処理
            $stmt = $conn->prepare("INSERT INTO users (username, password, level) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, password_hash($password, PASSWORD_DEFAULT), $level);
            if ($stmt->execute()) {
                echo "ユーザーを新規登録しました。";
            } else {
                echo "登録に失敗しました: " . $conn->error;
            }
            $stmt->close();
        } elseif ($action === "update") {
            // 更新処理
            if (!empty($login_id)) {
                $stmt = $conn->prepare("UPDATE users SET username = ?, password = ?, level = ? WHERE login_id = ?");
                $stmt->bind_param("sssi", $username, password_hash($password, PASSWORD_DEFAULT), $level, $login_id);
                if ($stmt->execute()) {
                    echo "ユーザー情報を更新しました。";
                } else {
                    echo "更新に失敗しました: " . $conn->error;
                }
                $stmt->close();
            } else {
                $error = "ログインIDが指定されていません。";
            }
        } elseif ($action === "delete") {
            // 削除処理
            if (!empty($login_id)) {
                $stmt = $conn->prepare("DELETE FROM users WHERE login_id = ?");
                $stmt->bind_param("i", $login_id);
                if ($stmt->execute()) {
                    echo "ユーザーを削除しました。";
                } else {
                    echo "削除に失敗しました: " . $conn->error;
                }
                $stmt->close();
            } else {
                $error = "ログインIDが指定されていません。";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー管理</title>
</head>
<body>
    <h1>ユーザー管理</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="login_id">ログインID（編集不可）:</label>
        <input type="number" id="login_id" name="login_id" value="<?php echo isset($_POST['login_id']) ? htmlspecialchars($_POST['login_id'], ENT_QUOTES, 'UTF-8') : ''; ?>" <?php echo isset($_POST['action']) && $_POST['action'] !== 'insert' ? 'readonly' : ''; ?>><br>

        <label for="username">ユーザー氏名:</label>
        <input type="text" id="username" name="username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>"><br>

        <label for="password">パスワード:</label>
        <input type="password" id="password" name="password"><br>

        <label for="level">レベル:</label>
        <input type="radio" id="admin" name="level" value="管理者" <?php echo isset($_POST['level']) && $_POST['level'] === '管理者' ? 'checked' : ''; ?>>
        <label for="admin">管理者</label>
        <input type="radio" id="general" name="level" value="一般" <?php echo isset($_POST['level']) && $_POST['level'] === '一般' ? 'checked' : ''; ?>>
        <label for="general">一般</label><br>

        <button type="submit" name="action" value="insert">登録</button>
        <button type="submit" name="action" value="update">更新</button>
        <button type="submit" name="action" value="delete">削除</button>
    </form>
</body>
</html>