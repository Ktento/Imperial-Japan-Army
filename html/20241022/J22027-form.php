<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
<title>画面名称</title>
</head>
<body>
<form action="J22027-form.php" method = "POST">
	<div>
		氏名
		<textarea name="namae" cols="10" rows="1"></textarea>
	</div>
	<div>性別<input type="radio" name="gender" value="男">男
			 <input type="radio" name="gender" value="女">女
	</div>
	<div>
		趣味<input type="checkbox"name="hobby[]" value="釣り">釣り
		    <input type="checkbox"name="hobby[]" value="バイク">バイク
		    <input type="checkbox"name="hobby[]" value="スキー">スキー
	</div>
	<div>
		地区
		<select name="place">
			<option value = "">---</option>
			<option value = "東部">東部</option>
			<option value = "中部">中部</option>
			<option value = "西部">西部</option>
		</select>
	</div>
	<div>
		コメント
		<textarea name="comment" cols="50" rows="5"></textarea>
		<input type="submit" value="表示して">
	</div>
</form>
<?php
	$namae = $_POST["namae"];
	$gender = $_POST["gender"];
	$hobby = $_POST["hobby"];
	$place = $_POST["place"];
	$comment = $_POST["comment"];
	echo $namae."<br>";
	echo $gender."<br>";
	echo $hobby[0].",";
	echo $hobby[1].",";
	echo $hobby[2]."<br>";
	echo $place."<br>";
	echo"<pre>".$comment."</pre>";
?>




</body>
</html>