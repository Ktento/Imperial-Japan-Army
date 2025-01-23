<?php
$Y=$_POST["display"];

if($Y){
    $checkboxes = isset($_POST['sports']) ? $_POST['sports'] : array();
    foreach($checkboxes as $value) {
        echo("<li>".$value."</li>");
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8" />
    <title>画面名称</title>
</head>
<body>
<form action="J23005-checkbox1.php" method="POST">
    <input type="checkbox" name="sports[]" value="soccker">サッカー
    <input type="checkbox" name="sports[]" value="baseball">野球
    <input type="checkbox" name="sports[]" value="tennis">テニス
    <input type="submit" name="display" value="表示して">
</form>
</body>
</html>
