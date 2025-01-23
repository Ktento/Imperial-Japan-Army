<?php

$color=$_POST["word"];
$color2=$_POST["display"];
if($color2){
	echo($color);
}
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J22027-radio.php" method="POST">
	<input type="radio" name="signal" value="青">青
	<input type="radio" name="signal" value="黄">黄
	<input type="radio" name="signal" value="赤">赤
	<input type="submit" value="表示して">
</form>

</body>
</html>