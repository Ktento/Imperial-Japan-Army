<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>

<form action="J22027-pulldown1.php" method = "POST">
<select name = "car">
	<option value = "">---</option>
	<option value = "TOYOTA">トヨタ</option>
	<option value = "LEXUS">レクサス</option>
	<option value = "SUBARU">スバル</option>
</select>
<input type="submit" value="表示して">
</form>
<?php
 $X=$_POST["car"];
 echo("あなたが選んだメーカーは".$X."です");
 
?>



</body>
</html>