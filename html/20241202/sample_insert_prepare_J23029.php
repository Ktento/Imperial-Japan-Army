<?php
//エラーチェックなどの事前処理
$seito_name = $_POST["seito_name"];
$seito_furigana = $_POST["seito_furigana"];
$ent_btn = $_POST["ent_btn"];

if(isset($ent_btn) && !$seito_name) {
    $msg = "<font color='red'>氏名が入力されていません</font>";
} else {
    $msg = "";
}

if ($msg) {
    echo $msg;
}
?>

<form action="sample_insert_prepare_J23029.php" method ="POST">
<div>生徒氏名<input type="text" width="10" name="seito_name" value="" ></div>
<div>フリガナ<input type="text" width="10" name="seito_furigana" value=""></div>
<div><input type="submit" value="登録" name="ent_btn"></div>
</form>

<?php
//POSTされていない時は登録処理はスルー

if ($msg) exit;
//押下されたボタンとエラー有無を確認
$sql='insert into seito_tbl(seito_name, seito_furigana) values(:seito_name, :seito_furigana)';

//DBへの接続
$dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
$user="user01";
$pass="user01";

try {
$pdo = new PDO($dsn,$user,$pass);
//SQLの実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':seito_name', $seito_name);
$stmt->bindValue(':seito_furigana', $seito_furigana);
$stmt->execute();
//結果の処理
echo $seito_name."(".$seito_furigana.")を登録しました";

} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
} finally{
    // DB接続を閉じる
    $pdo = null;
}

?>

</body>
</html>