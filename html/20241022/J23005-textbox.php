<?php

$X=$_POST["word"];
$Y=$_POST["display"];

if($Y)
echo("入力された変数は".$X."です");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J23005-textbox.php" method = "POST">
	<input type="text" width="10" name="word">
	<input type="submit" value="表示して" name="display">
</form>
</body>
</html>