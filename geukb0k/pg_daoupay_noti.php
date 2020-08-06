<?php
include_once "path.php";
	
$PAYMETHOD = $_REQUEST['PAYMETHOD'];
$CPID = $_REQUEST['CPID'];
$DAOUTRX = $_REQUEST['DAOUTRX'];
$ORDERNO = $_REQUEST['ORDERNO'];
$AMOUNT = $_REQUEST['AMOUNT'];
$CARDCODE = $_REQUEST['CARDCODE'];
$CARDNAME = $_REQUEST['CARDNAME'];
$BANKNAME = iconv("euc-kr","utf-8",$_REQUEST['BANKNAME']);
$ACCOUNTNO = $_REQUEST['ACCOUNTNO'];



$pg_tid = $DAOUTRX;
$pg_price = $AMOUNT;
$od_id = $ORDERNO;
$pg_method = $PAYMETHOD;
$pg_card_info1 = $CARDCODE;
$pg_card_info2 = $CARDNAME;
$pg_cash_yn = $cash_yn;
$pg_cash_authno = $cash_authno;
$pg_id = $nfor[pg_id];

		
$bank_number = $BANKNAME." ".$ACCOUNTNO;


$order = sql_fetch("select * from nfor_order where od_id='$od_id'");

if($order[od_id]){


	if($PAYMETHOD=="VACCOUNTISSUE"){


		sql_query("update nfor_order set bank_number='$bank_number', pay_step='4', od_datetime=NOW() where od_id='$order[od_id]'");
		sql_query("update nfor_cart set ct_od_date=NOW(), pay_step='4' where cart_id='$order[cart_id]'");
		
		coupon_use($order[od_id]);
		
		if($order[money_price]) insert_money($order[mb_no],$order[money_price]*-1,"상품구매","2",$order[od_id]);
		
		nfor_send("order",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
		nfor_send("banking_request",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
		

	} else{


		sql_query("update nfor_order set pg_card_info1='$pg_card_info1', pg_card_info2='$pg_card_info2', pg_id='$pg_id', pay_step='1', pg_type='$nfor[pg_type]', pg_tid='$pg_tid', pg_method='$pg_method', pg_price='$pg_price', od_paydatetime=NOW(), od_datetime=NOW(),pg_cash_yn='$pg_cash_yn',pg_cash_authno='$pg_cash_authno' where od_id='$od_id'");
		sql_query("update nfor_cart set ct_od_date=NOW(), ct_od_paydate=NOW(), pay_step='1', delivery_step='$nfor[delivery_step]' where cart_id='$order[cart_id]'");

		coupon_use($order[od_id]);

		if($order[money_price]) insert_money($order[mb_no],$order[money_price]*-1,"상품구매","2",$order[od_id]);

		nfor_send("order",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
		$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_delivery='0'");
		while($ct = sql_fetch_array($que)){
			nfor_send("ticket",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id], $ct[ct_id]);
		}

	}

	echo "<html><body><RESULT>SUCCESS</RESULT></body></html>";

}
?>