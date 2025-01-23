<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>

<form action="J22027-checkbox2.php" method="POST">
	<input type="checkbox"name="fruit[]" value="orange">みかん
	<input type="checkbox"name="fruit[]" value="apple">りんご
	<input type="checkbox"name="fruit[]" value="grape">ぶどう
	<input type="submit" value="表示して">
</form>
<?php
$X = $_POST["fruit"];
echo $X[0];
echo $X[1];
echo $X[2];

?>

</body>
</html>