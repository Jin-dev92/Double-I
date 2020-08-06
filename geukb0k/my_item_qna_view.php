<?php
include "path.php";

$nfor[title] = "내가작성한문의";

if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=my_item_qna_view.php");

$qna = sql_fetch("select * from nfor_item_qna where wr_id='$wr_id'");

if(!$member[mb_no] or ($member[mb_no] and $qna[mb_no] <> $member[mb_no])) alert("잘못된 접속입니다");


if($qna[it_id]){ 
	$item = sql_fetch("select it_name from nfor_item where it_id='$qna[it_id]'");
	$qna[it_name] = $item[it_name];
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>