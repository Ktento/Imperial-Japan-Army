<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>画面名称</title>
</head>
<body>
    <form action="J23005-while5.php" method="POST">
        <input type="textbox" name="loop">
        <input type="submit" value="表示して" name="display">  
    </form>
</body>
</html>

<?php
$kaiten = $_POST["loop"];
$i = 0;
while ($i <= $kaiten) {
    echo $i."<br>";
    $i++;
}
?>