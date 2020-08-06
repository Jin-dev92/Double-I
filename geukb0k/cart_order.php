<?php
include_once "path.php";

$nfor[title] = "주문/결제";

// 과거의 날짜
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

// 항상 변경됨
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");

// HTTP/1.1
header("Cache-Control: no-store, no-cache, must-reval!!idate");
header("Cache-Control: post-check=0, pre-check=0", false);

// HTTP/1.0
header("Pragma: no-cache");


if(!$config[cf_guest] and !$member[mb_no]) alert("로그인하셔야 이용가능합니다","login.php?url=cart_order.php");


$ss_cart_id = $_SESSION[cart_id];

/* 엔포솔루션 */
$ss_cart_id_new = date("ymdHis").substr(microtime(),2,4);
$sql = "select * from nfor_cart where cart_id='$ss_cart_id' and option_check='1'";
if($it_id){
	$sql .= " and it_id='$it_id'";
}
$que = sql_query($sql);
while($ct = sql_fetch_array($que)){

	sql_query("insert nfor_cart set cart_id='$ss_cart_id_new',
									it_id='$ct[it_id]',
									option_id='$ct[option_id]',
									option_cnt='$ct[option_cnt]',
									supply_no='$ct[supply_no]',
									it_delivery='$ct[it_delivery]',
									option_price='$ct[option_price]',
									supply_price='$ct[supply_price]',
									org_price='$ct[org_price]',
									option_select1='$ct[option_select1]',
									option_select2='$ct[option_select2]',
									option_select3='$ct[option_select3]',
									option_select4='$ct[option_select4]',
									option_check='$ct[option_check]'");


}
$ss_cart_id = $ss_cart_id_new;
/* 엔포솔루션 */

$cart_chk = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id' and option_check='1'");
if(!$cart_chk[cnt]) alert("장바구니가 비어 있습니다","cart.php");

$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ss_cart_id' and it_delivery='1' and option_check='1'");
$is_delivery = $chk_delivery[cnt];

if($member[mb_no]){

	// 최근배송지
	$last = sql_fetch("select * from nfor_order where mb_no='$member[mb_no]' and pay_step='1' order by od_id desc limit 1");
	$last_hp = explode("-",$last[dy_hp]);

	// 기본배송지
	$chk_myaddress = sql_fetch("select * from nfor_myaddress where mb_no='$member[mb_no]' and my_basic='1'");

	// 휴대폰번호
	$mb_hp = explode("-",$member[mb_hp]);

}


include_once $nfor[skin_path]."cart_order.php";

?>
