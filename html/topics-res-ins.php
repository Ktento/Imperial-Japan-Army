<?php
// エラーを出力する
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
?>
<?php
//ログイン状態の有無などの確認
require_once 'includes/auth.php';
//ヘルパー関数
require_once 'includes/helpers.php';
//GETパラメータの取得
//初回呼び出し時 or フォームが送信された際に取得する
$topic_id = sanitizeInput($_GET['ti'] ?? '');
$title = sanitizeInput($_GET['t'] ?? '');
$category = sanitizeInput($_GET['c'] ?? '');
$target = sanitizeInput($_GET['a'] ?? '');

?>
<?php
// エラーメッセージの初期化
$errors = [];
$success_message = "";
//コメント登録の処理をまとめたヘルパー関数を呼び出す
//挿入更新削除の処理はtopics-comment.phpにまとめている
require_once 'includes/topics-comment.php';
//登録ボタンがおされsubmitされた際の処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //フォームから送信されたデータを取得
    $topic_comment_id = trim($_POST['comment_id'] ?? '');
    $comment_category = trim($_POST['comment_category'] ?? '');
    $topic_comment = trim($_POST['topic_comment'] ?? '');

    //コメントが空の場合はエラーを返す
    if (empty($topic_comment)) {
        $errors[] = "コメントは必須です。";
    }
    //種類が空の場合はエラーを返す
    if (empty($comment_category)) {
        $errors[] = "種類は必須です。";
    }
    //エラーがない場合はコメントを登録する
    if (empty($errors)) {
        $result = insertComments($topic_comment_id, $topic_id, $user_id, $comment_category, $topic_comment);
        if (is_array($result)) {
            $errors = $result;
        } else {
            //コメントが正常に登録された場合はトピック詳細ページにリダイレクトする
            $success_message = "コメントが正常に登録されました (ID: $result)";
            //トピック詳細ページにリダイレクトする
            //元の情報を表示したいのでGETパラメータを渡す
            header("Location: topics-dtl.php?ti=$topic_id&t=$title&c=$category&a=$target");
            exit();
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
    <link rel="stylesheet" href="/path/to/common.css">
</head>

<body>
    <div class="p-4 mx-12 max-w-6xl min-w-80 mx-auto">
        <?php include 'templates/header.php'; ?>
        <main class="bg-gray-100 p-4 mt-4">
            <h2 class="border-b-2 mb-2 py-2 text-lg">コメント登録</h2>
            <!-- 登録ボタンがおされた後再度詳細を表示するためにGETパラメータを渡す -->
            <form action="topics-res-ins.php?ti=<?= $topic_id ?>&t=<?= $title ?>&c=<?= $category ?>&a=<?= $target ?>" method="POST" class="space-y-3">
                <fieldset>
                    <dl>
                        <dt class="float-left"></dt>
                        <dd class="ml-64">
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
                            <!-- 初回読み取り時に取得したGETパラメータを表示する -->
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