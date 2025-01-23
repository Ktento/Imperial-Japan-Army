<?php
// ユーザー名を仮で設定
$userName = "ボボボーボ・ボーボボ";

// モード取得 (デフォルトは新規登録)
$mode = $_GET['mode'] ?? 'insert';

// 入力値の取得 (POSTから受け取る)
$registrationNumber = $_POST['registrationNumber'] ?? '';
$title = $_POST['title'] ?? '';
$type = $_POST['type'] ?? '';
$target = $_POST['target'] ?? '';

// エラーメッセージ・成功メッセージ
$message = "";

// フォーム送信時の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 必須チェック
    if (empty($title)) {
        $message = "エラー: タイトルは必須です。";
    } else {
        // モードに応じた処理
        if ($mode === 'insert') {
            
            $message = "新規登録が完了しました。";
        } elseif ($mode === 'update') {
            $message = "更新が完了しました。";
        } elseif ($mode === 'delete') {
            $message = "削除が完了しました。";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メディア</title>
    <style>
        /* 基本スタイル */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 400px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }
        h1 {
            text-align: center;
            font-size: 18px;
        }
        label {
            display: inline-block;
            margin: 5px 0;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="radio"] {
            margin-right: 10px;
        }
        .button {
            text-align: center;
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
        }
        .message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>こんにちは、<?= htmlspecialchars($userName); ?>さん</h1>
        
        <!-- メッセージ表示 -->
        <?php if (!empty($message)): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <!-- フォーム開始 -->
        <form method="POST">
            <label for="registrationNumber">登録番号:</label>
            <input type="text" name="registrationNumber" id="registrationNumber" 
                value="<?= htmlspecialchars($registrationNumber); ?>" 
                <?= $mode === 'insert' ? '' : 'readonly'; ?>>

            <label for="title">タイトル:</label>
            <input type="text" name="title" id="title" 
                value="<?= htmlspecialchars($title); ?>">

            <label>種類:</label><br>
            <input type="radio" name="type" value="テレビ" <?= $type === "テレビ" ? 'checked' : ''; ?>> テレビ
            <input type="radio" name="type" value="新聞" <?= $type === "新聞" ? 'checked' : ''; ?>> 新聞 

            <br><label>対象:</label><br>
            <input type="radio" name="target" value="学生" <?= $target === "学生" ? 'checked' : ''; ?>> 学生
            <input type="radio" name="target" value="教員" <?= $target === "教員" ? 'checked' : ''; ?>> 教員

            <div class="button">
                <button type="submit" name="mode" value="<?= $mode; ?>">
                    <?= $mode === 'insert' ? '登録' : ($mode === 'update' ? '更新' : '削除'); ?>
                </button>
            </div>
        </form>
    </div>
</body>
</html>