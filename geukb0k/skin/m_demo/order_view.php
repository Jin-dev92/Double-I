<?php
include_once $nfor[skin_path]."head.php";
include_once $nfor[path]."/lib/div.lib.php";
?>

<style>
.order_banking { border:solid 1px #d8d5d5; margin-bottom:10px; background:#fff; padding:20px 10px; }


.order_banking_msg { background-color:#f5f5f5; padding:10px; font-size:12px; color:#444; line-height:18px; }
.order_banking_msg .notice { color:#888; }

.order_top { position:relative; font-size:13px; }
.order_top .od_id { position:absolute; right:0px; top:0px; font-size:13px; }


.order_list_top_wrap { padding:20px 10px; }
.order_list_tab  { border-top:solid 1px #999999; border-left:solid 1px #999999; overflow:hidden; }
.order_list_tab li { margin:0px 0px 0px -2px; background-color:#fff; float:left; width:33.3333%; border-bottom:solid 1px #999999; border-right:solid 1px #999999; border-left:solid 1px #999999; }
.order_list_tab li a{ display:block; height:36px; line-height:36px; text-align:center; font-size:14px; letter-spacing:-1px; text-decoration:none; color:#999999; }
.order_list_tab li.on { background-color:#999999; }
.order_list_tab li.on a { color:#fff; font-weight:bold; }

#order_list_wrap { padding:10px; background-color:#fff; }

.item_head { padding:3px 0px; color:#999; font-size:12px; }
.item_body { border:solid 1px #d8d5d5; margin-bottom:10px; background:#fff;  }
.item_title { position:relative; font-size:14px; color:#616161; padding:7px; border-bottom:1px solid #f1f1f1; background:#eee; }
.item_content { display:block; overflow:hidden; border-top:solid 1px #eee;  }
.item_content li { position:relative; }
.item_img { position:absolute; left:10px; top:10px; width:75px; height:75px; }
.item_info_wrap { padding:10px 10px 10px 95px; }
.item_name1{ height:14px; font-size:14px; line-height:14px; overflow:hidden; color:#000; font-weight:bold; }
.item_name2{ height:36px; font-size:14px; line-height:18px; margin:3px 0px 5px 0px; color:#3a3a3a; overflow:hidden; }
.item_name3{ font-size:14px; line-height:18px; margin:3px 0px 0px 0px; color:#3a3a3a;}

.item_tail { border-top:solid 1px #e1e1e1; }



</style>









<div id="order_list_wrap">

<!-- 
		<div class="item_head"><?=date("Y.m.d",strtotime($order[od_datetime]))?></div>

		<div class="order_top">
			<?=date("Y.m.d",strtotime($order[od_datetime]))?>
			<span class="od_id"><?=$order[od_id]?></span>
		</div>

 -->


		<? if($order[pay_step]=="4"){ ?>
		<div class="order_banking">
			<div class="order_banking_msg">
				<p>입금계좌 : <?=$order[bank_number]?></p>
				<p>입금금액 : <?=number_format($order[$order[payment_type]."_price"])?>원</p>
				<p>입금기한 : <?=$order[bank_date]?></p>
				<p class="notice">입금기한 내에 입금하지 않으면 자동취소됩니다.</p>
			</div>
		</div>
		<? } ?>








<style>
.price_wrap { border:solid 1px #d8d5d5; padding:10px; margin:10px 0px; }
.price_wrap table { margin:5px 0px 5px 0px; width:100%; }
.price_wrap table th { font-size:14px; text-align:left; font-weight:normal; padding:3px 3px; }
.price_wrap table td { font-size:14px; padding:3px 3px; text-align:right; font-weight:bold; }
.price_wrap table .border_top { border-top:solid 1px #eee; }

</style>


<div class="price_wrap">


	<table>
	<colgroup>
		<col width="80">
		<col>
	</colgroup>
	<tbody>
	<tr>
		<th>상품금액</th>
		<td><?=number_format($order[it_price])?>원</td>
	</tr>
	<tr>
		<th>배송금액</th>
		<td><?=number_format($order[delivery_price])?>원</td>
	</tr>
	<tr>
		<th class="border_top">합산금액</th>
		<td class="border_top"><?=number_format($order[total_price])?>원</td>
	</tr>
	<tr>
		<th>적립금사용</th>
		<td><?=number_format($order[money_price])?>원</td>
	</tr>
	<tr>
		<th>쿠폰사용</th>
		<td><?=number_format($order[coupon_price])?>원</td>
	</tr>
	<tr>
		<th class="border_top">결제금액</th>
		<td class="border_top"><?=$order[payment_type]=="money"?"0":number_format($order[$order[payment_type]."_price"])?>원</td>
	</tr>
	<? if($order[cancel_price]){ ?>
	<tr>
		<th>취소금액</th>
		<td><?=number_format($order[cancel_price])?>원</td>
	</tr>
	<? } ?>
	</tbody>
	</table>


</div>


<?
echo item_div_print($order);
?>



<?
$is_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and it_delivery='1'");	
if($is_delivery[cnt]){
?>
<style>
.delivery_wrap { border:solid 1px #d8d5d5; padding:10px; }
.delivery_wrap table { margin:5px 0px 10px 0px; }
.delivery_wrap table th { font-size:14px; text-align:left; font-weight:normal; padding:3px 3px; }
.delivery_wrap table td { font-size:14px; padding:3px 3px; }
</style>

<div class="delivery_wrap">

	<table>
	<colgroup>
		<col width="80">
		<col>
	</colgroup>
	<tbody>
	<tr>
		<th>받는분</th>
		<td><?=$order[dy_name]?></td>
	</tr>
	<tr>
		<th>휴대전화</th>
		<td><?=$order[dy_hp]?></td>
	</tr>
	<tr>
		<th>추가연락처</th>
		<td><?=$order[dy_tel]?></td>
	</tr>
	<tr>
		<th>받는주소</th>
		<td><?=$order[dy_zip]?> <?=$order[dy_addr1]?> <?=$order[dy_addr2]?></td>
	</tr>
	</tbody>
	</table>



	<?
	$chk_delivery = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and it_delivery='1' and delivery_step='0' and pay_step='1'");	// 결제완료이고 배송상품이면서 배송대기인 상품이 있을때만 배송지변경가능
	if($chk_delivery[cnt]){	
	?>
	<a id="delivery_chage_btn" class="table-btn">배송지 변경</a>

	<SCRIPT LANGUAGE="JavaScript">
	<!--
	function close_delivery_chage(){
		$(".txt_title").html("주문상세");
		$(".btn_back").attr("href","javascript:history.back()");
		$("#order_list_wrap").show();	
		$("#delivery_chage_wrap").hide();
	}

	$(document).on("click","#delivery_chage_btn",function(){
		$(".txt_title").html("배송지 변경");
		$(".btn_back").attr("href","javascript:close_delivery_chage()");
		$("#order_list_wrap").hide();	
		$("#delivery_chage_wrap").show();
	});
	//-->
	</SCRIPT>
	<? } ?>




</div>
<? } else{ ?>
<style>
.ticket_wrap { border:solid 1px #d8d5d5; padding:10px; margin:10px 0px; }
.ticket_wrap table { margin:5px 0px 5px 0px; }
.ticket_wrap table th { font-size:14px; text-align:left; font-weight:normal; padding:3px 3px; }
.ticket_wrap table td { font-size:14px; padding:3px 3px; }
</style>

<div class="ticket_wrap">

	<table>
	<colgroup>
		<col width="80">
		<col>
	</colgroup>
	<tbody>
	<tr>
		<th>구매한사람</th>
		<td><?=$order[od_name]?></td>
	</tr>
	<tr>
		<th>휴대전화</th>
		<td><?=$order[od_hp]?></td>
	</tr>
	</tbody>
	</table>


</div>
<? } ?>













		<div class="table spacing10">
		<div class="table-row">
			<?
			if($order[payment_type]=="banking" or $order[payment_type]=="iche" or $order[payment_type]=="vbanking"){
			?>

				<!-- <? if($order[pg_cash_yn]=="Y"){ ?>
				<div class="table-cell"><a href="javascript:kcp_cash_receipt( '<?=$nfor[pg_id]?>', '<?=$order[od_id]?>', '<?=$order[pg_cash_yn]?>', '<?=$order[pg_cash_authno]?>' )" class="table-btn" style="width:150px;">현금영수증출력</a></div>
				<? } else{ ?>
				<div class="table-cell"><a href="javascript:kcp_cash_receipt( '<?=$nfor[pg_id]?>', '<?=$order[od_id]?>', '<?=$order[pg_cash_yn]?>', '<?=$order[pg_cash_authno]?>' )" class="table-btn" style="width:150px;">현금영수증발급</a></div>
				<? } ?> -->

			<? } elseif($order[payment_type]=="card"){ ?>
			<!-- <div class="table-cell"><a href="javascript:kcp_card_receipt( '<?=$order[pg_tid]?>', '<?=$order[od_id]?>', '<?=$order[card_price]?>' )" class="table-btn" style="width:150px;">카드영수증출력</a></div> -->
			<? } else{ ?>

			<? } ?>

			<?
			if(date("Ymd",strtotime("+1 days",strtotime($order[od_datetime]))) <= date("Ymd")){
			?>
			<div class="table-cell"><a id="order_hide_btn" class="table-btn">주문내역 숨김</a></div>
			<? } ?>
		</div>
		</div>








</div>




<script type="text/javascript">
  /* 신용카드 영수증 연동 스크립트 */
  function kcp_card_receipt( tno, ordr_idxx, amount ){
	<? if($nfor[test]){ ?>
	receiptWin = "https://testadmin8.kcp.co.kr/assist/bill.BillAction.do?cmd=card_bill&tno=";
	<? } else{ ?>
	receiptWin = "https://admin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=card_bill&tno=";
	<? } ?>
	receiptWin += tno + "&";
	receiptWin += "order_no=" + ordr_idxx + "&"; 
	receiptWin += "trade_mony=" + amount ;
	window.open(receiptWin, "", "width=455, height=815"); 
}

  /* 현금영수증 연동 스크립트 */
  function kcp_cash_receipt( site_cd, order_id, bill_yn, auth_no ){
	<? if($nfor[test]){ ?>
    receiptWin2 = "https://testadmin8.kcp.co.kr/Modules/Service/Cash/Cash_Bill_Common_View.jsp";
	<? } else{ ?>
	receiptWin2 = "https://admin.kcp.co.kr/Modules/Service/Cash/Cash_Bill_Common_View.jsp";
	<? } ?>
    receiptWin2 += "?";
    receiptWin2 += "term_id=PGNW" + site_cd + "&";
    receiptWin2 += "orderid=" + order_id + "&";
    receiptWin2 += "bill_yn=" + bill_yn + "&";
    receiptWin2 += "authno=" + auth_no ;

    window.open(receiptWin2, "", "width=370, height=625");
  }

  /* 가상 계좌 모의입금 페이지 호출 */
  /* 테스트시에만 사용가능 */
  /* 실결제시 해당 스크립트 주석처리 */
  function receiptView3(){
    receiptWin3 = "http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti.jsp"; 
    window.open(receiptWin3, "", "width=520, height=300"); 
  }
</script>




<?
include_once $nfor[skin_path]."inc_delivery_chage.php";
?>



<?
include_once $nfor[skin_path]."tail.php";
?>