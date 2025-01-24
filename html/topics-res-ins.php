<?php
// エラーを出力する
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>
<?php
require_once 'includes/auth.php';
require_once 'includes/helpers.php';
require_once 'includes/topics.php';

$topic_id = sanitizeInput($_GET['i'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $topic_id = $_POST['comment_id'] ?? $topic_id;
    $title = $_POST['title'] ?? $title;
    $category = $_POST['category'] ?? $category;
    $target = $_POST['target'] ?? $target;
}
// エラーメッセージの初期化
$errors = [];
$success_message = "";

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>トピック登録</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/path/to/common.css">
</head>

<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <?php include 'templates/header.php'; ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">コメント登録</h2>
            <form action="topics-res-ins.php" method="POST" class="space-y-3">
                <fieldset>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">登録番号:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= $topic_id ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">タイトル:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($title) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($category) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">対象:</label>
                        </dt>
                        <dd class="ml-64">
                            <?= htmlspecialchars($target) ?>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">コメント番号:</label>
                        </dt>
                        <dd class="ml-64">
                            <input size="5" type="text" name="comment_id" id="comment_id" class="border text-sm p-1 focus:outline-none focus:border-gray-500 focus:ring-0 focus:ring-gray-500">
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left">
                            <label for="" class="">種類:</label>
                        </dt>
                        <dd class="ml-64">
                            <div class="mt-2 flex items-center gap-2">
                                <label class="">
                                    <input type="radio" name="comment_category" value="感想" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800">
                                    <span class="ml-2 text-gray-700">感想</span>
                                </label>
                                <label class="">
                                    <input type="radio" name="comment_category" value="質問" class="h-4 w-4 text-gray-600 border-gray-300 accent-gray-800">
                                    <span class="ml-2 text-gray-700">質問</span>
                                </label>
                            </div>
                        </dd>
                    </dl>
                    <dl class="py-2">
                        <dt class="float-left w-60">
                            <label for="" class="">コメント:</label>
                        </dt>
                        <dd class="ml-64">
                            <textarea name="topic_comment" class="w-80 h-40 overflow-y-scroll p-2 text-left resize-none" style="resize: none;">
                            </textarea>
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

<?php
require_once 'includes/auth.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //SQL文
    $sql = 'INSERT INTO topic_comment(topic_comment_id,topic_id, user_id, comment_category, topic_comment) VALUES(:topic_comment_id,:topic_id, :user_id, :comment_category, :topic_comment)';
    //DBへの接続
    $dsn = 'mysql:host=localhost;dbname=artifact;charset=utf8';
    $user = "user01";
    $pass = "user01";
    try {
        //SQLの実行
        $topic_comment_id = $_POST['comment_id'];
        $comment_category = $_POST['comment_category'];
        $topic_comment = $_POST['topic_comment'];
        $pdo = new PDO($dsn, $user, $pass);
        //SQLの実行
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':topic_comment_id', $topic_comment_id);
        $stmt->bindValue(':topic_id', $topic_id);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':comment_category', $comment_category);
        $stmt->bindValue(':topic_comment', $topic_comment);
        if ($stmt->execute()) {
            echo "挿入成功";
        } else {
            echo "挿入失敗";
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