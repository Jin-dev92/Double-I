<?php
include_once "path.php";

$nfor[title] = "주문취소";

$order = sql_fetch("select * from nfor_order where od_id='$od_id' and mb_no='$member[mb_no]'");


if($mode=="order_cancelrequest"){

	if(!$order[od_id]) json_return("주문서가 존재하지 않습니다");
	if($order[mb_no] <> $member[mb_no]) json_return("회원정보가 일치하지 않습니다");
	if($order[pay_step]=="2") json_return("이미 취소 접수된 주문서입니다");
	if($order[pay_step]=="3") json_return("이미 취소된 주문서입니다");

	if($it_id){


		$chk_cnt = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and	it_id='$it_id' and delivery_step='3'");

		sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where cart_id='$order[cart_id]' and it_id='$it_id'");
		sql_query("update nfor_cart set delivery_step='3' where cart_id='$order[cart_id]' and it_id='$it_id' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리

		$chk_cart = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='1'");
		if(!$chk_cart[cnt]){
			sql_query("update nfor_order set pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경
		}


	} else{


		if($order[pay_step]=="1"){
			sql_query("update nfor_order set pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경
			sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where cart_id='$order[cart_id]' and pay_step='1'");
			sql_query("update nfor_cart set delivery_step='3' where cart_id='$order[cart_id]' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리
		} elseif($order[pay_step]=="4"){
			sql_query("update nfor_order set pay_step='5', od_cancelrequest=NOW(), od_canceldatetime=NOW() where od_id='$order[od_id]'");	// 주문상태를 입금대기취소(5) 으로 변경
			sql_query("update nfor_cart set pay_step='5', od_cancelrequest=NOW(), od_canceldatetime=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where cart_id='$order[cart_id]'");
			sql_query("update nfor_coupon_use set cp_state='2' where od_id='$order[od_id]'");
			if($order[money_price]) insert_money($order[mb_no],$order[money_price],"적립금 상품구매 취소","7",$order[od_id]);
			


		} else{


		}

	}

	nfor_send("cancel_request",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);

	sql_query("update nfor_order set is_cancel='1' where od_id='$order[od_id]'");



	$return[od_id] = $order[od_id];
	json_return("","ok");
	exit;
}

if(!$member[mb_no]) alert("로그인하셔야 이용가능합니다");

$ymd = date("Y-m-d",strtotime("+7 day", strtotime($order[od_paydatetime])));
if($nfor[ymd] > $ymd) {
	$is_expiry = 1;
}

include_once $nfor[skin_path].basename($_SERVER[PHP_SELF]);
?>