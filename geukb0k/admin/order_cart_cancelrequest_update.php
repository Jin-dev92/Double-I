<?php
include "path.php";

// DB 주문취소 처리
if($mode=="cancel"){
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	$cart_id = $order[cart_id];

	$delivery_chk = sql_fetch("select * from nfor_cart where cart_id='$cart_id' and (delivery_step='2' or delivery_step='3')");
	if($delivery_chk[cart_id]){

		$alert = "1";
		echo $alert;

		return false;
		
	}

	$cancel_price = return_price($cart_id);
	sql_query("update nfor_cart set pay_step='3', od_canceldatetime=NOW(), cancel_price='$cancel_price' where cart_id='$cart_id'");

	$ct = sql_fetch("select * from nfor_cart where cart_id='$cart_id'");
	$total_ct1 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]'");
	$total_ct2 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and pay_step='3'");
	if($total_ct1[cnt]==$total_ct2[cnt]){
		sql_query("update nfor_order set pay_step='3', od_canceldatetime=NOW() where cart_id='$ct[cart_id]'");
	}

	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

	$total_ct3 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]'");
	$total_ct4 = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and it_id='$ct[it_id]' and pay_step='3'");
	if($total_ct3[cnt]==$total_ct4[cnt]){
		coupon_again($order[od_id],$ct[it_id]);
	}

	sql_query("update nfor_cart set my_cancel_price='".return_money_coupon($ct[cart_id])."' where cart_id='$ct[cart_id]'");
	insert_money($order[mb_no],return_money_coupon($ct[cart_id]),"적립금 상품구매 부분취소","8",$order[od_id],$ct[cart_id]);

	$cancel_price = $order[cancel_price]+return_price($cart_id);	// 취소된금액 + 지금취소되는금액
	sql_query("update nfor_order set cancel_price='$cancel_price' where cart_id='$ct[cart_id]'");

	$alert = "3";
	echo $alert;
	return false;

	// exit;
}


if($mode=="asign"){
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	$cart_id = $order[cart_id];

	sql_query("update nfor_cart set pay_step='1', cancel_why_msg='', cancel_why='', od_cancelrequest='' where cart_id='$cart_id'");	//  주문완료 수정
	sql_query("update nfor_cart set delivery_step='2' where cart_id='$cart_id' and (delivery_step='3' or delivery_step='4')");	//  반품신청(3) 또는 반품완료(4)일경우 배송완료(2) 처리

	$ct = sql_fetch("select * from nfor_cart where cart_id='$cart_id'");
	sql_query("update nfor_order set pay_step='1', od_canceldatetime='' where cart_id='$ct[cart_id]'");

	$is_cancel = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$ct[cart_id]' and (pay_step='2' or pay_step='3')");
	if($is_cancel[cnt]){
		sql_query("update nfor_order set is_cancel='1' where cart_id='$ct[cart_id]'");
	} else{
		sql_query("update nfor_order set is_cancel='0' where cart_id='$ct[cart_id]'");
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

