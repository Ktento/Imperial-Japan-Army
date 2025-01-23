<?php

$X=$_POST["word"];
$Y=$_POST["display"];
if($Y){
	echo($X);
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J22027-textbox.php" method = "POST">
	<INPUT TYPE = "text" width = "10" name="word">
	<input type = "submit" value="表示して" name = "display">
</form>
<?php
	if(isset($_POST["word"])){
		echo("渡された変数は".$X."です");
	}
	$X=$_GET["word"];


?>




</body>
</html>