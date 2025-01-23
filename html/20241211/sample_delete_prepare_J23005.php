<?php
// エラーメッセージの初期化
$errors = [];
$success_message = "";

// GETパラメータからIDを取得
$seito_no = trim($_GET['id'] ?? '');
$seito_name = "";
$seito_furigana = "";
$btn_name = "削除";


if (!empty($seito_no)) {
    $dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
    $user = 'user01';
    $pass = 'user01';

    try {
        $pdo = new PDO($dsn, $user, $pass);

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
    if ($_POST['submit'] != "本当に削除") {
        $confirm_message[] = "本当に削除する場合は「本当に削除」ボタンを押してください。";
        $btn_name = "本当に削除";
        return;
    }
    $seito_no = trim($_POST['seito_no'] ?? $seito_no);
    $seito_name = trim($_POST['seito_name'] ?? '');
    $seito_furigana = trim($_POST['seito_furigana'] ?? '');

    if (empty($seito_no)) {
        $errors[] = "学籍番号を入力してください。";
    }

    if (empty($errors)) {
        $dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
        $user = 'user01';
        $pass = 'user01';

        try {
            $pdo = new PDO($dsn, $user, $pass);

            $sql = 'DELETE FROM seito_tbl WHERE seito_no = :seito_no';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':seito_no', $seito_no);
            $stmt->execute();
            $success_message = "$seito_name ($seito_no) を削除しました。";
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

<?php if (!empty($confirm_message)): ?>
    <div style="color: red;">
        <ul>
            <?php foreach ($confirm_message as $message): ?>
                <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div style="color: red;">
        <?= htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<a href="sample_prepare_J23005_delete.php">一覧に戻る</a>

<form action="" method="POST">
    <div>
        <label for="seito_no">学籍番号:</label>
        <input type="text" id="seito_no" name="seito_no" value="<?= htmlspecialchars($seito_no, ENT_QUOTES, 'UTF-8')?>" readonly>
    </div>
    <div>
        <label for="seito_name">生徒氏名:</label>
        <input type="text" id="seito_name" name="seito_name" value="<?= htmlspecialchars($seito_name, ENT_QUOTES, 'UTF-8') ?>" readonly>
    </div>
    <div>
        <label for="seito_furigana">フリガナ:</label>
        <input type="text" id="seito_furigana" name="seito_furigana" value="<?= htmlspecialchars($seito_furigana, ENT_QUOTES, 'UTF-8') ?>" readonly>
    </div>
    <div>
        <button type="submit"><?php $btn_name ?></button>
    </div>
</form>

</body>
</html>
