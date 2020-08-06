<?php
include "path.php";

// DB 주문취소 처리
if($mode=="cancel"){

	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	$delivery_chk = sql_fetch("select * from nfor_cart where cart_id='$order[cart_id]' and (delivery_step='2' or delivery_step='3')");
	if($delivery_chk[cart_id]){

		$alert = "1";
		echo $alert;

		return false;
		
	}

	$cancel_chk = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='3'");
	if($cancel_chk[cnt]){
		$alert = "2";
		echo $alert;

		return false;
	}

	sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW() where od_id='$order[od_id]'");
	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW() where cart_id='$order[cart_id]' and pay_step='2'");
	
	coupon_again($order[od_id]);

	if($order[money_price]){
		insert_money($order[mb_no],$order[money_price],"적립금 상품구매 취소","7",$order[od_id]);
	}

	nfor_send("cancel",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);

	$alert = "3";
	echo $alert;
	return false;

	// exit;
}


if($mode=="asign"){
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	sql_query("update nfor_order set pay_step='1', od_cancelrequest='', od_canceldatetime='' where od_id='$order[od_id]'");
	sql_query("update nfor_cart set delivery_step='2' where cart_id='$order[cart_id]' and (delivery_step='3' or delivery_step='4')");	//  반품신청(3) 또는 반품완료(4)일경우 배송완료(2) 처리
	sql_query("update nfor_cart set pay_step='1', cancel_why_msg='', cancel_why='', od_cancelrequest='' where cart_id='$order[cart_id]' and pay_step='2'");	//  주문완료 수정

	$is_cancel = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and (pay_step='2' or pay_step='3')");
	if($is_cancel[cnt]){
		sql_query("update nfor_order set is_cancel='1' where od_id='$order[od_id]'");
	} else{
		sql_query("update nfor_order set is_cancel='0' where od_id='$order[od_id]'");
	}


	$sql_cart_id = sql_fetch("select * from nfor_order where od_id = '$od_id'");
	$cart_id = $sql_cart_id[cart_id];

	$sql_it_id = sql_fetch("select * from nfor_cart where cart_id = '$cart_id'");
	$it_id = $sql_it_id[it_id];

	// 현재 판매량
	$current_volume = sql_fetch("select it_sales_volume from nfor_item where it_id = '$it_id'");
	$update_volume = $current_volume[it_sales_volume] + 1;

	// 판매량 업데이트
	sql_query("update nfor_item set it_sales_volume = '$update_volume' where it_id = '$it_id'");


	$alert = "5";
	echo $alert;
	return false;
}

?>

