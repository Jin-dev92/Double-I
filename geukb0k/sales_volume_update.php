<?php
include "path.php";
$datetime = date("Y-m-d H:i:s");
// 현재 판매개수
$total_sales = sql_fetch("select it_sales_volume as current_sales from nfor_item where it_id='$goodscode'"); 

$new_count = $total_sales[current_sales] + 1;
$c_cart_id = sql_fetch("select cart_id as current_cart_id from nfor_order where od_id='$m_Moid'");

// 주문수량 업데이트
sql_query("update nfor_item set it_sales_volume = '$new_count' where it_id='$goodscode'");

// 주문시간 업데이트
sql_query("update nfor_order set od_datetime = '$datetime' where od_id='$m_Moid'");

// nfor_sms_ck insert(문자 전송여부 업데이트)
sql_query("insert into nfor_sms_ck (od_id, mb_id, mb_hp, supply_no) values ('$od_id','$mb_id','$mb_hp','$supply_no')");

// 카드결제인 경우 paystep 과 결제시간 업데이트
if($payMethod == 'CARD'){
	sql_query("update nfor_order set od_paydatetime = '$datetime', pay_step = '1' where od_id='$m_Moid'");

	$ct_id = $c_cart_id[current_cart_id];
	sql_query("update nfor_cart set payment_date = '$datetime', pay_step = '1' where cart_id='$ct_id'");
}

// 가상계좌인 경우 pay_step를 입금대기(4)로 업데이트
else if($payMethod == 'VBANK'){
	sql_query("update nfor_order set pay_step = '4', bank_date = '$VbankExpDate' where od_id='$m_Moid'");
}

?>
