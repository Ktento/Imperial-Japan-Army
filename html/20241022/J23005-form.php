<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>画面名称</title>
</head>
<body>
    <?php if (isset($_POST['display'])) :
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $hobbies = isset($_POST['hobby']) ? $_POST['hobby'] : array();
        $hobbiesString = implode('、', $hobbies);
        
        $area = $_POST["area"];
        $comment = $_POST["comment"];
        
        echo("氏名: ".$name."<br>");
        echo("性別: ".$gender."<br>");
        echo("趣味: ".$hobbiesString."<br>");
        echo("地区: ".$area."<br>");
        echo("コメント");
        echo("<pre>".$comment."</pre>")
    ?>
    <?php else: ?>
        <form action="J23005-form.php" method="POST">
            <div>
                <label for="name">氏名</label>
                <input type="text" name="name">
            </div>
            <div>
                <label for="gender">性別</label>
                <input type="radio" name="gender" value="男">男
                <input type="radio" name="gender" value="女">女
            </div>
            <div>
                <label for="hobby">趣味</label>
                <input type="checkbox" name="hobby[]" value="釣り">釣り
                <input type="checkbox" name="hobby[]" value="バイク">バイク
                <input type="checkbox" name="hobby[]" value="バレー">バレー
            </div>
            <div>
                <label for="are">地区</label>
                <select name="area">
                    <option value="">---</option>
                    <option value="東部">東部</option>
                    <option value="中部">中部</option>
                    <option value="西部">西部</option>
                </select>
            </div>
            <div>
                <div>コメント</div>
                <div>
                    <textarea name="comment" cols="50" rows="5"></textarea>
                </div>
            </div>
            <div>
                <input type="submit" value="表示して" name="display">
            </div>
        </form>
    <?php endif ?>
</body>
</html>