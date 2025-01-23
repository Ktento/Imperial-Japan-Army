<?php
//BODY定義
function makeBody(){
//定義値
 $bodytag='<body bgcolor="#ffffff" text="#000000" link="" alink="" vlink="">';
//チームタグ
 $teamtag='<div style="background:#ff0000;color:#ffffff;">チーム：大・日・本・帝・国・陸・軍♡</div>';
//最終的に出力するタグ
$returntag=$bodytag."<br>".$teamtag;
return $returntag;
}

?>