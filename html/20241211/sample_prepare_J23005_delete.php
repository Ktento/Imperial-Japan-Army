<?php
// エラーメッセージと成功メッセージの初期化
$errors = [];
$success_message = "";
$confirm_message = [];

// GETパラメータからIDを取得
$student_id = trim($_GET['id'] ?? '');
$student_name = "";
$student_furigana = "";
$button_label = "削除";

/**
 * データベース接続関数
 * @return PDO|null データベース接続オブジェクトまたはnull
 */
function getDatabaseConnection(): ?PDO {
    $dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
    $user = 'root';
    $pass = '';

    try {
        return new PDO($dsn, $user, $pass);
    } catch (PDOException $e) {
        global $errors;
        $errors[] = "データベースへの接続に失敗しました。";
        return null;
    }
}

if (!empty($student_id)) {
    $pdo = getDatabaseConnection();

    if ($pdo) {
        try {
            $sql = 'SELECT seito_name, seito_furigana FROM seito_tbl WHERE seito_no = :student_id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':student_id', $student_id);
            $stmt->execute();
            $result = $stmt->fetch();

            if ($result) {
                $student_name = $result['seito_name'];
                $student_furigana = $result['seito_furigana'];
            } else {
                $errors[] = "指定された学籍番号の生徒情報が見つかりません。";
            }
        } catch (PDOException $e) {
            $errors[] = "データベースエラー: 処理を完了できませんでした。";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted_action = $_POST['submit'] ?? '';

    if ($submitted_action !== "本当に削除") {
        $confirm_message[] = "本当に削除する場合は「本当に削除」ボタンを押してください。";
        $button_label = "本当に削除";
    } else {
        $student_id = trim($_POST['seito_no'] ?? $student_id);

        if (empty($student_id)) {
            $errors[] = "学籍番号を入力してください。";
        }

        if (empty($errors)) {
            $pdo = getDatabaseConnection();

            if ($pdo) {
                try {
                    $sql = 'DELETE FROM seito_tbl WHERE seito_no = :student_id';
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindValue(':student_id', $student_id);
                    $stmt->execute();

                    $success_message = "$student_name ($student_id) を削除しました。";
                } catch (PDOException $e) {
                    $errors[] = "データベースエラー: 処理を完了できませんでした。";
                }
            }
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
    <div style="color: orange;">
        <ul>
            <?php foreach ($confirm_message as $message): ?>
                <li><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div style="color: green;">
        <?= htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<a href="sample_prepare_J23005_delete.php">一覧に戻る</a>

<form action="" method="POST">
    <div>
        <label for="seito_no">学籍番号:</label>
        <input type="text" id="seito_no" name="seito_no" value="<?= htmlspecialchars($student_id, ENT_QUOTES, 'UTF-8') ?>" readonly>
    </div>
    <div>
        <label for="seito_name">生徒氏名:</label>
        <input type="text" id="seito_name" name="seito_name" value="<?= htmlspecialchars($student_name, ENT_QUOTES, 'UTF-8') ?>" readonly>
    </div>
    <div>
        <label for="seito_furigana">フリガナ:</label>
        <input type="text" id="seito_furigana" name="seito_furigana" value="<?= htmlspecialchars($student_furigana, ENT_QUOTES, 'UTF-8') ?>" readonly>
    </div>
    <div>
        <button type="submit" name="submit" value="<?= htmlspecialchars($button_label, ENT_QUOTES, 'UTF-8') ?>">
            <?= htmlspecialchars($button_label, ENT_QUOTES, 'UTF-8') ?>
        </button>
    </div>
</form>

</body>
</html>
