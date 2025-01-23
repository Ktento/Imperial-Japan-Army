<?php

$X=$_POST["word"];
$Y=$_POST["display"];
if($Y){
echo("入力された変数は".$X."です");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head charset="utf-8" />
<title></title>
</head>
<body>


<form action="J23029-textbox.php" method="POST">
<INPUT TYPE="test" width="10" name="word">
<input type="submit" value="表示して"name="display">
</form>
</body>
<html>