<?php
//SQL文
$sql="select student_blood ,student_sex, COUNT(*) as 'sum' FROM sample_tbl GROUP BY student_blood,student_sex ORDER BY student_blood";
//DBへの接続
//DBへの接続
$dsn = 'mysql:host=localhost;dbname=study_db;charset=utf8';
$user="user01";
$pass="user01";
try {
    $pdo = new PDO($dsn,$user,$pass);
//SQLの実行
$stmt = $pdo->prepare($sql);
$stmt->execute();

//結果の処理
$i=1;
echo "<table border=1>";
print("<tr>");
echo("<th>No</th><th>性別</th><th>血液型</th><th>人数</th>");
while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
	print("<tr>");
	print("<td>" . $i . "</td>");
	print("<td>" . $result['student_sex'] . "</td>");
	print("<td>" . $result['student_blood'] . "</td>");
	print("<td>" . $result['sum'] . "</td>");
	print("</tr>");
	$i++;
}
print("</tr>");
echo "</table>";

// foreachの値を変数に格納したい
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
} finally{
    // DB接続を閉じる
    $pdo = null;
}
?>