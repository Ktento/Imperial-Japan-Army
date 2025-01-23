<?php
$X = $_POST["word"];
setcookie('save_message', $X, time() + 60*60*24*14);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>

<form action = "cookie_J23029.php" method = "POST">
<INPUT TYPE = "text" width = "10" name = "word">
<input type = "submit" value = "保存して">
</form>

</body>
</html>
