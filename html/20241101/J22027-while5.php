<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>‰æ–Ê–¼Ì</title>
</head>
<body>
<form action="J22027-while5.php" method="POST">
	<input type="textbox" name = "loop">
	<input type="submit" value="•\Ž¦‚µ‚Ä">
</form>




</body>
</html>





<?php

$kaiten=$_POST["loop"];
$i = 0;
while($i <= $kaiten){
	echo $i."<br>";
	$i++;
}
?>