<?php	// 결제하기
include_once "path.php";

// 과거의 날짜
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// 항상 변경됨
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-reval!!idate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
header("Pragma: no-cache");

//if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=cart_order.php");
if(!$ss_cart_id_new) alert("잘못된 접속입니다");

$ss_cart_id = $ss_cart_id_new;

$cart_chk = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id'");
if(!$cart_chk[cnt]) alert("장바구니가 비어 있습니다","cart.php");

$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id' and it_delivery='1'");

$order = sql_fetch("select * from nfor_order where cart_id='$ss_cart_id'");
if($order[pay_step]) alert("잘못된 접속입니다");

if($order[payment_type]=="banking" or $order[payment_type]=="money"){
	$nfor[pg_type] = $order[payment_type];
}


include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>