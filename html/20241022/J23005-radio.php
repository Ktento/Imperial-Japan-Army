<?php

$X=$_POST["signal"];
$Y=$_POST["display"];

if($Y) echo("選ばれた色は".$X."です");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J23005-radio.php" method = "POST">
	<input type="radio" name="signal" value="青">青
	<input type="radio" name="signal" value="黄">黄
	<input type="radio" name="signal" value="赤">赤
	<input type="submit" name="display" value="表示して">
</form>
</body>
</html>