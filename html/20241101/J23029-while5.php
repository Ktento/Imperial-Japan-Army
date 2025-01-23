<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset = "utf-8"/>
	<title>画面表示</title>
</head>
<body>
	<form action = "J23029-while5.php" method = "POST">
	    <input type = "textbox" name = "loop">
	    <input type = "submit" value = "表示して">
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
