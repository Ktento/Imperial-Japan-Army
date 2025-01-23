<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<?php
$Y=$_POST["display"];
if($Y) {
    $name=$_POST["name"];
    $seibetsu=$_POST["seibetsu"];
    $checkboxes = isset($_POST['favorite']) ? $_POST['favorite'] : array();
    $area=$_POST["area"];
    $comment=$_POST["comment"];

    echo("氏名: ".$name."<br>");
    echo("性別: ".$seibetsu."<br>");
    echo("趣味: ");

    echo join(", ", $checkboxes);

    echo("<br>");
    echo("地区: ".$area."<br>");

    echo("コメント<br><pre>".$comment."</pre>");
} else {
	echo <<< "EOD"
    <form action="J23029-form.php" method="POST">
        <div>
            氏名
            <input type="text" name="name">
        </div>
        <div>
            性別
            <input type="radio" name="seibetsu" value="男">男
            <input type="radio" name="seibetsu" value="女">女
        </div>
        <div>
            趣味
            <input type="checkbox" name="favorite[]" value="釣り">釣り
            <input type="checkbox" name="favorite[]" value="バイク">バイク
            <input type="checkbox" name="favorite[]" value="スキー">スキー
        </div>
        <div>
            地区
            <select name="area">
                <option value="">---</option>
                <option value="東部">東部</option>
                <option value="中部">中部</option>
                <option value="西部">西部</option>
            </select>
        </div>
        <div>
            <div>コメント
                <textarea name="comment" cols="50" rows="5"></textarea>
            </div>
        </div>
        <div>
            <input type="submit" value="表示して" name="display">
        </div>
    </form>
    EOD;
    }
?>


</body>
</html>