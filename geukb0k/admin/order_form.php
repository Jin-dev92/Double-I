<?php	// 주문서
include "path.php";
$qstr .= "&od_sdate=$od_sdate&od_edate=$od_edate";

$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and it_delivery='1'");


if($mode=="update"){
	
	$dy_hp = $dy_hp1."-".$dy_hp2."-".$dy_hp3;
	$od_hp = $od_hp1."-".$od_hp2."-".$od_hp3;
	sql_query("update nfor_order set dy_name='$dy_name',dy_hp='$dy_hp',dy_zip='$dy_zip',dy_addr1='$dy_addr1',dy_addr2='$dy_addr2',dy_msg='$dy_msg',od_memo='$od_memo', od_name='$od_name', od_hp='$od_hp', od_email='$od_email', od_refund_bank='$od_refund_bank', od_refund_account='$od_refund_account', od_refund_name='$od_refund_name' where od_id='$od_id'");

	alert("정상적으로 수정되었습니다","$PHP_SELF?od_id=$od_id&$qstr");
	exit;
}


$list_btn = sql_fetch("select access_file from nfor_access where access_code='$menu_code[access_code]' and access_path='0'");


include "head.php";

$dy_hp = explode("-",$order[dy_hp]);
$od_hp = explode("-",$order[od_hp]);
?>
<style>
.cart_it_img { width:100px; }
</style>



<form name="fsubmit" id="fsubmit" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" value="update">
<input type="hidden" name="od_id" value="<?=$order[od_id]?>">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="od_sdate" value="<?=$od_sdate?>">
<input type="hidden" name="od_edate" value="<?=$od_edate?>">



<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">주문상품목록</span></div>





<style>
.order_list_tbl { border-top:solid 1px #000000; border-right:solid 1px #e4e4e4; }
.order_list_tbl th{ background-color:#f5f7f9; height:45px; color:#353638; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; }
.order_list_tbl td{ background-color:#ffffff; height:74px; color:#333333; border-bottom:solid 1px #e4e4e4; border-left:solid 1px #e4e4e4; text-align:center; }


.tbl_ct td:first-child { border-left:solid 1px #fff;   }

.tbl_ct td { border-top:solid 1px #e4e4e4; border-bottom:solid 1px #fff;   }
</style>
<table cellspacing="0" cellpadding="0" border="0" width="100%" class="order_list_tbl" align="center">
<tr>
	<th>상품명 / 옵션정보</th>

	<th>상품금액</th>
	<th>배송비</th>
</tr>
<?
$que = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' group by it_id");
while($cart = sql_fetch_array($que)){
	$item = sql_fetch("select * from nfor_item where it_id='$cart[it_id]'");
	$dy_price = sql_fetch("select * from nfor_dy_price where cart_id='$cart[cart_id]' and it_id='$cart[it_id]'");	
?>
<tr>
	<td>
	
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tr>
			<td style="border:0px; width:70px;"><a href="<?=$nfor[load]?>?it_id=<?=$cart[it_id]?>" target="_blank"><img src="<?=$item[it_img_l]?"$nfor[path]/data/list/$item[it_img_l]":"$nfor[path]/img/it_img_l_no.jpg"?>" style="width:50px;"></a></td>
			<td style="border:0px; text-align:left;">
			<a href="<?=$nfor[load]?>?it_id=<?=$cart[it_id]?>" style="font-weight:bold;" target="_blank"><?=$item[it_name]?></a>
			</td>
		</tr>
		</table>
	
		<table cellspacing="0" cellpadding="0" border="0" width="100%" class="tbl_ct">
		<?
		$que2 = sql_query("select * from nfor_cart where cart_id='$order[cart_id]' and it_id='$cart[it_id]'");
		while($ct = sql_fetch_array($que2)){
		?>
		<tr>
			<td><?=$ct[option_select1]?> <?=$ct[option_select2]?> <?=$ct[option_select3]?> <?=$ct[option_select4]?></td>
			<td><?=number_format($ct[option_price])?>원</td>
			<td>구매 : <?=number_format($ct[option_cnt])?>개</td>
			<td>사용 : <?=number_format($ct[ticket_used])?>개</td>
			<td><?=number_format($ct[option_price]*$ct[option_cnt])?>원</td>
			<td><?=pay_step($ct[pay_step])?></td>
		</tr>
		<? } ?>
		</table>

	
	</td>
	<td><?
	echo number_format($dy_price[it_price])."원";
	?></td>
	<td><?
	echo $dy_price[dy_state];
	?></td>	
</tr>
<? } ?>
</table>



<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">주문정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>주문번호</th>
	<td><?=$order[od_id]?></td>
</tr>
<tr>
	<th>PG코드</th>
	<td><?=$order[pg_tid]?></td>
</tr>
<tr>
	<th>주문상품</th>
	<td><?=it_name($order[od_id])?></td>
</tr>
<tr>
	<th>주문일시</th>
	<td><?=$order[od_datetime]?></td>
</tr>
<tr>
	<th>결제방법</th>
	<td><?=payment_type($order[payment_type])?><?=$order[is_mobile]?"(모바일웹)":""?></td>
</tr>
<tr>
	<th>상품금액</th>
	<td><?=number_format($order[it_price])?>원</td>
</tr>
<tr>
	<th>배송금액</th>
	<td><?=number_format($order[delivery_price])?>원</td>
</tr>
<tr>
	<th>합산금액</th>
	<td><?=number_format($order[total_price])?>원</td>
</tr>
<tr>
	<th>적립금사용</th>
	<td><?=number_format($order[money_price])?>원</td>
</tr>
<tr>
	<th>결제금액</th>
	<td><?=number_format($order[$order[payment_type]."_price"])?>원</td>
</tr>
<? if($order[cancel_price]){ ?>
<tr>
	<th>취소금액</th>
	<td><?=number_format($order[cancel_price])?>원</td>
</tr>
<? } ?>
</table>














<? if($order[payment_type]=="banking"){ ?>
<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">무통장입금정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>입금은행</th>
	<td><?=$order[bank_number]?></td>
</tr>
<? if($order[bank_date]){ ?>
<tr>
	<th>입금예정일자</th>
	<td><?=$order[bank_date]?></td>
</tr>
<? } ?>
<tr>
	<th>입금자명</th>
	<td><?=$order[bank_name]?></td>
</tr>
</table>
<? } ?>




<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">주문자정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>주문자 이름</th>
	<td><?=$order[mb_name]?></td>
</tr>
<tr>
	<th>주문자 연락처</th>
	<td><?=$order[mb_hp]?></td>
</tr>
<tr>
	<th>주문자 이메일</th>
	<td><?=$order[mb_email]?></td>
</tr>
</table>


<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">티켓사용자정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>사용자 이름</th>
	<td><input type="text" name="od_name" id="od_name" value="<?=$order[od_name]?>" style="width:100px;"></td>
</tr>
<tr>
	<th>사용자 연락처</th>
	<td>
	<input type="text" name="od_hp1" id="od_hp1" value="<?=$od_hp[0]?>" style="width:30px;"> -
	<input type="text" name="od_hp2" id="od_hp2" value="<?=$od_hp[1]?>" style="width:30px;"> -
	<input type="text" name="od_hp3" id="od_hp3" value="<?=$od_hp[2]?>" style="width:30px;">	
	</td>
</tr>
<tr>
	<th>사용자 이메일</th>
	<td><input type="text" name="od_email" id="od_email" value="<?=$order[od_email]?>" style="width:150px;"></td>
</tr>
</table>



<?
if($chk_delivery[cnt]){
?>
<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">배송지정보</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>배송지 이름</th>
	<td><input type="text" name="dy_name" id="dy_name" value="<?=$order[dy_name]?>" style="width:100px;"></td>
</tr>
<tr>
	<th>배송지 연락처</th>
	<td>
	<input type="text" name="dy_hp1" id="dy_hp1" value="<?=$dy_hp[0]?>" style="width:30px;"> -
	<input type="text" name="dy_hp2" id="dy_hp2" value="<?=$dy_hp[1]?>" style="width:30px;"> -
	<input type="text" name="dy_hp3" id="dy_hp3" value="<?=$dy_hp[2]?>" style="width:30px;">
	</td>
</tr>
<tr>
	<th>배송지 주소</th>
	<td>	
	<input type="text" name="dy_zip" id="dy_zip" value="<?=$order[dy_zip]?>" size="6">
	<input type="button" onclick="zipcode('dy_zip', 'dy_addr1', 'dy_addr2')" value="우편번호 찾기"><br>
	<input type="text" name="dy_addr1" id="dy_addr1" value="<?=$order[dy_addr1]?>" style="width:400px;"><br>
	<input type="text" name="dy_addr2" id="dy_addr2" value="<?=$order[dy_addr2]?>" style="width:400px;">
	</td>
</tr>
<tr>
	<th>배송요청사항</th>
	<td><textarea name="dy_msg" rows="4" style="width:400px;"><?=$order[dy_msg]?></textarea></td>
</tr>
</table>
<? } ?>






<? if($order[payment_type]=="banking" or $order[payment_type]=="vbanking"){ ?>

<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">환불계좌설정 ※ 미입력시 고객이 설정한 환불계좌로 자동 설정됩니다</span></div>
<table class="tbl_type" cellpadding="0" cellspacing="0">	
<colgroup>
<col width="180" align="center">
<col align="left" style="padding: 5px 0 0 10px;">
</colgroup>
<tr>
	<th>환불 은행</th>
	<td>	

	<select name="od_refund_bank" id="od_refund_bank">
	<option value="">은행선택
	<?
	$que = sql_query("select * from nfor_pg_code where pg_type='$nfor[pg_type]' and pg_payment_type='vbanking'");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[pg_code]?>" <?=$order[od_refund_bank]==$data[pg_code]?"selected":""?>><?=$data[pg_name]?>(<?=$data[pg_code]?>)
	<? } ?>
	</select>


	</td>
</tr>
<tr>
	<th>환불 계좌번호</th>
	<td>	
	<input type="text" name="od_refund_account" id="od_refund_account" value="<?=$order[od_refund_account]?>" style="width:200px;">
	</td>
</tr>
<tr>
	<th>환불 예금주</th>
	<td>	
	<input type="text" name="od_refund_name" id="od_refund_name" value="<?=$order[od_refund_name]?>" style="width:100px;">
	</td>
</tr>
</table>


<? } ?>











<div class="s_title"><img src="img/dot.gif" align="absmiddle"><span class="tex02">관리메모</span></div>
<textarea name="od_memo" rows="5" style="width:100%"><?=$order[od_memo]?></textarea>



<div class="btn_cen">
<input type="image" src="img/dong_btn.gif" alt="수정하기">
<a href="<?=$list_btn[access_file]?>?od_id=<?=$order[od_id]?>&<?=$qstr?>"><img src="img/list.gif" alt="목록보기"></a>
</div>



</form>
<?
include "tail.php";
?>