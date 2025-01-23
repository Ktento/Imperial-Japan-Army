<?php
// エラーを出力する
ini_set( 'display_errors', 1 );
ini_set('error_reporting', E_ALL);
?>
<?php
require_once 'includes/auth.php';

// エラーメッセージの初期化
$errors = [];
$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $register_num = trim($_POST['number'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $target = trim($_POST['target'] ?? '');

    // バリデーション
    if (empty($title)) {
        $errors[] = "タイトルを入力してください。";
    }

    if (empty($category)) {
        $errors[] = "種類を選択してください。";
    }

    if (empty($target)) {
        $errors[] = "対象を選択してください。";
    }

    if (empty($errors)) {
        try {
            $pdo = new PDO(
                'mysql:host=localhost;dbname=artifact;charset=utf8',
                'user01',
                'user01',
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $sql = empty($register_num) 
                ? "INSERT INTO media (user_id, media_title) VALUES (:user_id, :title)"
                : "INSERT INTO media (media_id, user_id, media_title) VALUES (:num, :user_id, :title)";

            

            $stmt = $pdo->prepare($sql);
            if (!empty($register_num)) {
                $stmt->bindValue(':num', $register_num, PDO::PARAM_INT);
            }
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title, PDO::PARAM_STR);
            $stmt->execute();
            
            $media_id = $pdo->lastInsertId();
            $stmt = $pdo->prepare("
                INSERT INTO media_category (media_id, media_category_name) VALUES (:media_id, :category)
            ");
            $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            $stmt->execute();

            $stmt = $pdo->prepare("
                INSERT INTO media_target (media_id, media_target_name) VALUES (:media_id, :target)
            ");
            $stmt->bindValue(':media_id', $media_id, PDO::PARAM_STR);
            $stmt->bindValue(':target', $target, PDO::PARAM_STR);
            $stmt->execute();

            $success_message = "データが正常に登録されました。";
        } catch (PDOException $e) {
            $errors[] = "データベースエラー: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トピック登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="mx-12 p-15">
        <?php include 'templates/header.php'; ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">トピックス登録</h2>
            <form action="media-ins.php" method="POST" class="space-y-3">
                <fieldset>
                    <dl>
                        <dt class="float-left"></dt>
                        <dd class="ml-64">
                            <?php if (!empty($success_message)): ?>
                                <div class="mb-4 p-3 text-green-600">
                                    <?= htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($errors)): ?>
                                <div class="mb-4 p-3 text-red-600">
                                    <ul>
                                        <?php foreach ($errors as $error): ?>
                                            <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="text-sm font-medium">登録番号:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="number" id="number" placeholder="省略可能" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500">
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="text-sm font-medium">タイトル:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="title" id="title" class="border text-sm p-1">
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="font-medium">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input type="radio" name="category" value="本" class="h-4 w-4 text-gray-600 border-gray-300">
                                    <span class="ml-2 text-gray-700">本</span>
                                </label>
                                <label class="">
                                    <input type="radio" name="category" value="動画" class="h-4 w-4 text-gray-600 border-gray-300">
                                    <span class="ml-2 text-gray-700">動画</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="font-medium">対象:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input type="radio" name="target" value="学生" class="h-4 w-4 text-gray-600 border-gray-300">
                                    <span class="ml-2 text-gray-700">学生</span>
                                </label>
                                <label class="">
                                    <input type="radio" name="target" value="教員" class="h-4 w-4 text-gray-600 border-gray-300">
                                    <span class="ml-2 text-gray-700">教員</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60">
                            <label for="" class="font-medium">タグ:</label>
                            <br>
                            <span class="text-xs text-gray-900">
                                タグをコンマ(,)で区切って入力してください<br> 例: PHP, MySQL, プログラミング
                            </span>
                        </dt>
                        <dd class="ml-64">
                            <input size="25" type="text" name="number" id="number" placeholder="PHP, MySQL, プログラミング" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500">
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60"></dt>
                        <dd class="ml-64">
                            <button type="submit" class="border border-black py-2 px-4 hover:text-gray-700 bg-white">
                                登録
                            </button>
                        </dd>
                    </dl>
                </fieldset>
            </form>
        </main>
        <?php include 'templates/footer.php'; ?>
    </div>
</body>
</html>