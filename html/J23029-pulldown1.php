<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<?php
$X=$_POST["car"];
$Y=$_POST["display"];
if($Y){
echo("入力された変数は".$X."です");
}
?>
<form action="J23029-pulldown1.php" method="POST">
<select name="car">
    <option value="TOYOTA">トヨタ</option>
    <option value="LEXUS">レクサス</option>
    <option value="SUBARU">スバル</option>
</select>
<input type="submit" name="display" value="表示して">
</form>


</body>
</html>
