<?php
$X = $_POST["word"];
setcookie('save_message',$X,time() + 60*60*24*14);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset = "utf-8" />
<title>画面名称</title>
</head>
<body>
<?php
print($_COOKIE['save_message']);
?>
</body>
</html>
    