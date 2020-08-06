<?php
include "path.php";

if($cancel_kind=='2'){
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

} else if($cancel_kind=='1'){
	if($od_id){

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

	}

	$CPID = $nfor[pg_id];
	$DAOUTRX = $order[pg_tid];
	$AMOUNT = $order[pg_price];

	if($order[payment_type]=="card"){
		include_once $nfor[pg_path]."/library/Card_library.php";
	} elseif($order[payment_type]=="iche"){
		include_once $nfor[pg_path]."/library/Bank_library.php";
	} else{

	}

	include_once $nfor[pg_path]."/config/common_config.cfg";

	$CPID = $nfor[pg_id];
	$DAOUTRX = $order[pg_tid];
	$AMOUNT = $order[pg_price];


	if($order[payment_type]=="card"){
		CardCancel(  SERVER_IP, CARD_PORT, $CPID, ENCKEY, TIMEOUT );
	} elseif($order[payment_type]=="iche"){
		BankCancel(  SERVER_IP, BANK_PORT, $CPID, ENCKEY, TIMEOUT );
	} else{

	}

	if($res_resultcode == "0000"){

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


	} else{
		$alert = "4";
		echo $alert;

		return false;
		
	}
}


?>

