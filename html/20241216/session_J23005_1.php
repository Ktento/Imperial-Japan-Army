<?php
session_start();
$_SESSION['session_message'] = $_POST['word'] ?? '';
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="session_J23005_1.php" method="post">
        <input type="text" width="10" name="word">
        <input type="submit" value="保存して">
    </form>
</body>
</html>