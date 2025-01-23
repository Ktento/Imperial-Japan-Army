<?php
$X=$_POST["comment"];
echo "<pre>".$X."</pre>";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J23029-textarea.php" method="POST">
<textarea name="comment" cols="50" rows="5"></textarea>
<input type="submit" value="表示して">
</form>


</body>
</html>