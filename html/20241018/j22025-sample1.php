<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<?php
//日本のタイムゾーンに変更
date_default_timezone_set('Asia/Tokyo');

echo("今日は".date("Y年m月d日のh:i:s")."です");
?>

</body>
</html>
