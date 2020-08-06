<?php	// 일대일문의 답변보기
include "path.php";

$nfor[title] = "1:1문의";

if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=customer_view.php");

$customer = sql_fetch("select * from nfor_customer where wr_id='$wr_id'");

if(!$member[mb_no] or ($member[mb_no] and $customer[mb_no] <> $member[mb_no])) alert("잘못된 접속입니다");


if($customer[it_id]){ 
	$item = sql_fetch("select it_name from nfor_item where it_id='$customer[it_id]'");
	$customer[it_name] = $item[it_name];
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>