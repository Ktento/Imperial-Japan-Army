<?php
// エラーメッセージの初期化
$errors = [];
$success_message = "";

// GETパラメータからIDを取得
$seito_no = trim($_GET['id'] ?? '');
$seito_name = "";
$seito_furigana = "";

if (!empty($seito_no)) {
    // DB接続情報
    $dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
    $user = 'user01';
    $pass = 'user01';

    try {
        $pdo = new PDO($dsn, $user, $pass);

        // 生徒情報を取得
        $sql = 'SELECT seito_name, seito_furigana FROM seito_tbl WHERE seito_no = :seito_no';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':seito_no', $seito_no);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $seito_name = $result['seito_name'];
            $seito_furigana = $result['seito_furigana'];
        } else {
            $errors[] = "指定された学籍番号の生徒情報が見つかりません。";
        }
    } catch (PDOException $e) {
        $errors[] = "データベースエラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    } finally {
        $pdo = null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seito_no = trim($_POST['seito_no'] ?? $seito_no);
    $seito_name = trim($_POST['seito_name'] ?? '');
    $seito_furigana = trim($_POST['seito_furigana'] ?? '');

    // 入力チェック
    if (empty($seito_no)) {
        $errors[] = "学籍番号を入力してください。";
    }
    if (empty($seito_name)) {
        $errors[] = "氏名を入力してください。";
    }
    if (empty($seito_furigana)) {
        $errors[] = "フリガナを入力してください。";
    }

    if (empty($errors)) {
        $dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
        $user = 'user01';
        $pass = 'user01';

        try {
            $pdo = new PDO($dsn, $user, $pass);

            $sql = 'UPDATE seito_tbl SET seito_name=:seito_name, seito_furigana=:seito_furigana WHERE seito_no = :seito_no';
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':seito_no', $seito_no);
            $stmt->bindValue(':seito_name', $seito_name);
            $stmt->bindValue(':seito_furigana', $seito_furigana);

            $stmt->execute();
            $success_message = "$seito_name ($seito_no) を更新しました。";
        } catch (PDOException $e) {
            $errors[] = "データベースエラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        } finally {
            $pdo = null;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php if (!empty($errors)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div style="color: green;">
        <?= htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <div>
        <label for="seito_no">学籍番号:</label>
        <input type="text" id="seito_no" name="seito_no" value="<?= htmlspecialchars($seito_no, ENT_QUOTES, 'UTF-8')?>" readonly>
    </div>
    <div>
        <label for="seito_name">生徒氏名:</label>
        <input type="text" id="seito_name" name="seito_name" value="<?= htmlspecialchars($seito_name, ENT_QUOTES, 'UTF-8') ?>">
    </div>
    <div>
        <label for="seito_furigana">フリガナ:</label>
        <input type="text" id="seito_furigana" name="seito_furigana" value="<?= htmlspecialchars($seito_furigana, ENT_QUOTES, 'UTF-8') ?>">
    </div>
    <div>
        <button type="submit">更新</button>
    </div>
</form>

</body>
</html>
