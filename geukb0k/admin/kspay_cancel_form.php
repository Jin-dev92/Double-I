<?php
include_once "path.php";



$delivery_chk = sql_fetch("select * from nfor_cart where ct_id='$ct_id' and (delivery_step='2' or delivery_step='3')");
if($delivery_chk[cart_id]){
	alert("배송된 상품이 존재하여 취소가 불가능합니다\\n반품 처리후 진행해주세요");
}

$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");

$item_price = $ct[option_price]*$ct[option_cnt];

$pg_cancel_price = sql_fetch("select sum(pg_cancel_price) as pg_cancel_price_s from nfor_cart where pay_step='3' and cart_id='$order[cart_id]'");
$my_cancel_price = sql_fetch("select sum(my_cancel_price) as my_cancel_price_s from nfor_cart where pay_step='3' and cart_id='$order[cart_id]'");

$pg_price_now = $order[pg_price] - $pg_cancel_price[pg_cancel_price_s];

$cancel = sql_fetch("select count(*) as cnt from nfor_cart where pay_step='3' and cart_id='$order[cart_id]' and pg_cancel_price>0");
$cancel_count = $cancel[cnt]+1;
?><html>
<head>
<title>KSPay</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	BODY{font-size:9pt line-height:160%}
	TD{font-size:9pt line-height:160%}
	A {color:blueline-height:160% background-color:#E0EFFE}
	INPUT{font-size:9pt}
	SELECT{font-size:9pt}
	.emp{background-color:#FDEAFE}
	.white{background-color:#FFFFFF color:black border:1x solid white font-size: 9pt}

	.nfor_tbl th { text-align:left; }
</style>
</head>

<body onload="" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onFocus="" >
<form name=KSPayAuthForm method=post action="./kspay_cancel_form_update.php">
<!--기본-------------------------------------------------------------------------------------------->
<input type="hidden" name="storeid"    	  value="<?=$nfor[pg_id]?>">
<input type="hidden" name="storepasswd" 	  value="<?=$storepasswd?>">
<input type="hidden" name="authty" value="1010">
<input type="hidden" name="canc_type" value="3">
<input type="hidden" name="canc_seq" value="<?=$cancel_count?>">
<input type="hidden" name="trno" value="<?=$order[pg_tid]?>">
<input type="hidden" name="ct_id" value="<?=$ct_id?>"/>




<table border=0 width=0>
<tr>
<td align=center>
<table width=380 cellspacing=0 cellpadding=0 border=0 bgcolor=#4F9AFF>
<tr>
<td>
<table width=100% cellspacing=1 cellpadding=2 border=0>
<tr bgcolor=#4F9AFF height=25>
<td align=left><font color="#FFFFFF">
KSPay 신용카드 취소
</font></td>
</tr>
<tr bgcolor=#FFFFFF>
<td valign=top>
<table width=100% cellspacing=0 cellpadding=2 border=0>
<tr>
<td align=left>


		<table class="nfor_tbl">
		<tr>
			<th width="100">주문번호</th>
			<td><?=$order[od_id]?></td>
		</tr>
		<tr>
			<th>전체결제금액</th>
			<td><?=number_format($order[pg_price])?>원</td>
		</tr>
		<tr>
			<th>합산배송금액</th>
			<td><?=number_format($order[delivery_price])?>원</td>
		</tr>
		<tr>
			<th>적립금결제금액</th>
			<td><?=number_format($order[money_price])?>원</td>
		</tr>
		<tr>
			<th>적립금취소된금액</th>
			<td><?=number_format($my_cancel_price[my_cancel_price_s])?>원</td>
		</tr>
		<tr>
			<th>PG 남은 결제금액</th>
			<td><?=number_format($pg_price_now)?>원</td>
		</tr>
		<tr>
			<th width="100">상품 금액 </th>
			<td><?=number_format($item_price)?>원</td>
		</tr>
		<tr>
			<th>부분취소할 적립금 금액</th>
			<td><input type="text" name="my_cancel_price" class="inp" value=""/>원</td>
		</tr>
		<tr>
			<th>PG 부분취소 금액 :</th>
			<td>
				<input type="text" name="canc_amt" maxlength="9">
			</td>
		</tr>
		<tr>
			<th>합산결제금액</th>
			<td><?=number_format($order[total_price])?>원</td>
		</tr>


<tr>
<td colspan=2 align=center>
		<input type=submit  value=" 취 소 ">
</tr>
</td>
</tr>
</table>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
</table>
</form>
</body>
</html>