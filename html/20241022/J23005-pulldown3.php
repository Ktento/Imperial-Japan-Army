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
echo("あなた選んだメーカは".$X."です");
}
?>
<form action="J23005-pulldown1.php" method="POST">
<select name="car">
    <option value="">---</option>
    <option value="TOYOTA" <?php if($X == "TOYOTA") echo "selected"?>>トヨタ</option>
    <option value="LEXUS"  <?php if($X == "LEXUS") echo "selected"?>>レクサス</option>
    <option value="SUBARU" <?php if($X == "SUBARU") echo "selected"?>>スバル</option>
</select>
<input type="submit" name="display" value="表示して">
</form>


</body>
</html>
