<?php
    // エラーログを表示するコード
    error_reporting(E_ALL); ini_set('display_errors', '1');
    ini_set('display_errors', 1);
    ini_set("error_reporting",E_ALL);

?>
<?php
$X = $_POST['word'] ?? '';
setcookie("save_message", $X, time() + 3600);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cookie_J23005.php" method="post">
        <input type="text" width="10" name="word">
        <input type="submit" value="保存して">
    </form>
</body>
</html>