<!DOTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8" />
        <title>ユーザー登録</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>

        <body class="bg-gray-100 p-8 flex items-center justify-center min-h-screen">
            <form method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h2 class="text-lg font-semibold mb-4">ユーザー登録</h2>
                <label for="user_id" class="block text-sm font-medium text-gray-700">ログインID:</label>
                <input type="text" id="user_id" name="user_id" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" /><br>
                <label for="user_name" class="block text-sm font-medium text-gray-700 mt-4">ユーザ氏名:</label>
                <input type="text" id="user_name" name="user_name" required class="mt-1 block w-full border border-gray-300 rounded-md p-2" /><br>
                <label for="user_password" class="block text-sm font-medium text-gray-700 mt-4">パスワード:</label>
                <input type="password" id="user_password" name="user_password" value="<?php echo isset($_POST['user_password']) ? $_POST['user_password'] : ''; ?>" class="mt-1 block w-full border border-gray-300 rounded-md p-2" /><br>
                <label for="user_level" class="block text-sm font-medium text-gray-700 mt-4">レベル:</label>
                <div class="flex items-center">
                    <input type="radio" id="admin_level" name="user_level" value="管理者" class="mr-2 h-5 w-5" /><span class="text-lg">管理者</span>
                    <input type="radio" id="user_level" name="user_level" value="一般" class="mr-2 h-5 w-5" /><span class="text-lg">一般</span>
                </div><br>
                <label for="favtag" class="block text-sm font-medium text-gray-700 mt-4"><span class="text-lg">タグ:</span></label>
                <div class="flex flex-center">
                    <?php
                    $config = require_once 'config/config.php';

                    //SQL文
                    $sql = 'select tag_name from tags';
                    //DBへの接続
                    $dsn = $config['dsn'];
                    $user = $config['user'];
                    $pass = $config['password'];

                    try {
                        //SQLの実行
                        $pdo = new PDO($dsn, $user, $pass);
                        //SQLの実行
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        //結果の処理
                        $i = 1;
                        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            print('<input type="radio" id="tag" class="mr-2 h-5 w-5"' . $i . '" name="tag" value=' . $result['tag_name'] . '>' . $result['tag_name']);
                            if ($i % 5 == 0) {
                                print("<br>");
                            }
                            $i++;
                        }
                        print("<br>");
                        // foreachの値を変数に格納したい
                    } catch (PDOException $e) {
                        echo "接続失敗: " . $e->getMessage() . "\n";
                    } finally {
                        // DB接続を閉じる
                        $pdo = null;
                    }
                    ?>
                </div>
                <input type="submit" value="登録" class="mt-6 w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600" />
            </form>
        </body>

    </html>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        //SQL文
        $sql = 'INSERT INTO users (`user_id`, `user_name`, `user_password`, `user_icon`, `favtag`, `user_level`)';
        $sql = $sql . 'VALUES (:user_id,:user_name,:user_password,:user_icon,:favtag,:user_level)';
        //DBへの接続
        $dsn = $config['dsn'];
        $user = $config['user'];
        $pass = $config['password'];
        try {
            //SQLの実行
            $user_id = $_POST['user_id'];
            $user_name = $_POST['user_name'];
            $user_password = $_POST['user_password'];
            //user_iconを登録する場合は取得しuser_icon変数に格納
            $user_icon = null;
            $favtag = $_POST['tag'];
            $user_level = $_POST['user_level'];
            $pdo = new PDO($dsn, $user, $pass);
            //SQLの実行
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':user_id', $user_id);
            $stmt->bindValue(':user_name', $user_name);
            $stmt->bindValue(':user_password', $user_password);
            $stmt->bindValue(':user_icon', $user_icon);
            $stmt->bindValue(':favtag', $favtag);
            $stmt->bindValue(':user_level', $user_level);
            //SQLの結果が存在するかの確認
            if ($stmt->execute()) {
                session_start();
                //SESSIONに保存
                $_SESSION['loginid'] = $user_id;
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['favtag'] = $favtag;
                $_SESSION['role'] = $user_level;
                header("Location: top.php");
                exit();
            } else {
                echo "既にアカウントが存在しています。";
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