<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title></title>
</head>
<body>
<?php
    $post="";
    $post=$_SERVER["REQUEST_METHOD"];
    if($post=="POST"){
        $seito_no=$_POST['seito_no'];
        $seito_name=$_POST['seito_name'];
    }else{
        $seito_no=$_GET['seito_no'];
        $seito_name=$_GET['seito_name'];
    }
    //エラーチェックなどの事前処理
    if($post !="POST"){
        $btn_value="削除";
    }else{
        echo("本当に削除する場合は、[本当に削除]ボタンを押してください<br>");
        echo("<a href='sample_prepare_J23029.php'>やっぱり削除しない</a>")
        $btn_value="本当に削除";
    }
?>
<form action="sample_update_prepare_J23029.php" method ="POST">
<div>学籍番号<input type="text" width="10" name="seito_no" value="<?php echo($seito_no); ?>" readonly></div>
<div>生徒氏名<input type="text" width="10" name="seito_name"value="<?php echo($seito_name); ?>"></div>
<div>フリガナ<input type="text" width="10" name="seito_furigana"value="<?php echo($seito_furigana); ?>"></div>
<div><input type="submit" value="<?php echo($btn_value);?>" name="etn_btn"></div>
</form>
<?php
if($msg){exit;}
//SQL文
$sql='update seito_tbl set seito_name=:seito_name,seito_furigana=:seito_furigana where seito_no=:seito_no';

//DBへの接続
$dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
$user="user01";
$pass="user01";

try {
$pdo = new PDO($dsn,$user,$pass);
//SQLの実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':seito_no', $seito_no);
$stmt->bindValue(':seito_name', $seito_name);
$stmt -> bindValue(':seito_furigana',$seito_furigana);
$stmt->execute();


} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
} finally{
    // DB接続を閉じる
    // //結果の処理
    // echo $seito_name."(".$seito_furigana.")を登録しました";
    $pdo = null;
}

?>

</body>
</html>