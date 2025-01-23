<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>

<form action="J22027-checkbox1.php" method="POST">
	<input type="checkbox"name="soccer" value="サッカー">サッカー
	<input type="checkbox"name="baseball" value="野球">野球
	<input type="checkbox"name="tennis" value="テニス">テニス
	<input type="submit" value="表示して">
</form>
<?php
$X = $_POST["checkbox"];
echo("あなたが選んだのは".$X."です");
?>

</body>
</html>