<?php
include "path.php";
if($member[is_supply]=="1"){
	goto_url("ticket_auto_list.php");
	exit;
}

include "head.php";

$sql_search = "";
if($member[is_supply]=="1") $sql_search .= " and supply_no='$member[mb_no]'";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td  valign="top">



	<? if($is_admin){ ?>
	<table width="100%" cellpadding="0" cellspacing="5">
	<TR valign="top">
		<TD width="25%">
			<!-- 결제현황 -->
			<table  width="100%" cellpadding="0" cellspacing="0"border="0" >
			<tr><td height="10"  class="tex02"><img src="img/dot.gif" align="absmiddle">결제현황</td></tr>
			</table>

			<table class="tbl_type" border="1" cellspacing="0">
			<colgroup>
				<col width="80" align="center">
				<col align="right"style="padding:5px 0 0 10px;">
				</colgroup>
			<?
			$ymd = date("Y-m-d");
			$today = sql_fetch("select count(*) as cnt from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y-%m-%d')='$ymd'");
			?>
			<tr >
				<th scope="row" >오늘결제</th>
				<td><a href="order_list.php?od_sdate=<?=$ymd?>&od_edate=<?=$ymd?>"><?=number_format($today[cnt])?>건</a></td>
			</tr>
			<?
			$ymd = date("Y-m-d",strtotime("-1 day"));
			$yesterday = sql_fetch("select count(*) as cnt from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y-%m-%d')='$ymd'");
			?>
			<tr >
				<th scope="row">어제결제</th>
				<td><a href="order_list.php?od_sdate=<?=$ymd?>&od_edate=<?=$ymd?>"><?=number_format($yesterday[cnt])?>건</a></td>
			</tr>
			<?
			$ymd = date("Y-m-d");
			$today = sql_fetch("select sum(total_price) as total_price_sum from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y-%m-%d')='$ymd'");
			?>
			<tr >
				<th scope="row">오늘매출</th>
				<td><?=number_format($today[total_price_sum])?>원</td>
			</tr>
			<?
			$ymd = date("Y-m-d",strtotime("-1 day"));
			$yesterday = sql_fetch("select sum(total_price) as total_price_sum from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y-%m-%d')='$ymd'");
			?>
			<tr >
				<th scope="row">어제매출</th>
				<td><?=number_format($yesterday[total_price_sum])?>원</td>
			</tr>
			</table>
			<!-- //결제현황 -->
		</td>
		<TD width="25%">
		<!-- 회원현황 -->
			<table >
			<tr><td height="10"  class="tex02"><img src="img/dot.gif" align="absmiddle">회원현황</td></tr>
			</table>
		<table class="tbl_type" border="1" cellspacing="0">
			<colgroup>
				<col width="80" align="center">
				<col align="right"style="padding: 5px 0 0 10px;">
				</colgroup>
		<tr >
			<th scope="row">오늘가입</th>
			<td><?
			$ymd = date("Y-m-d");
			$today = sql_fetch("select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and DATE_FORMAT(mb_datetime,'%Y-%m-%d')='$ymd'");
			echo number_format($today[cnt]);
			?>명</td>
		</tr>
		<tr >
			<th scope="row">어제가입</th>
			<td><?
			$ymd = date("Y-m-d",strtotime("-1 day"));
			$yesterday = sql_fetch("select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and DATE_FORMAT(mb_datetime,'%Y-%m-%d')='$ymd'");
			echo number_format($yesterday[cnt]);
			?>명</td>
		</tr>
		<tr >
			<th scope="row">전체가입</th>
			<td><?
			$total = sql_fetch("select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime=''");
			echo number_format($total[cnt]);
			?>명</td>
		</tr>
		<tr >
			<th scope="row">탈퇴신청</th>
			<td><?
			$total = sql_fetch("select count(*) as cnt from nfor_member where mb_level > 1 and mb_leavedatetime <> ''");
			echo number_format($total[cnt]);
			?>명</td>
		</tr>
		</table>
		<!-- //회원현황 -->	
		</td>
		<TD width="25%">
			<!-- 방문현황 -->
			<table >
			<tr><td height="10"  class="tex02"><img src="img/dot.gif" align="absmiddle">방문현황</td></tr>
			</table>
			<table class="tbl_type" border="1" cellspacing="0">
				<colgroup>
				<col width="80" align="center">
				<col align="right"style="padding: 5px 10px 0 0;">
				</colgroup>
			<tr >
				<th scope="row">오늘방문</th>
				<td><?=number_format($count[1])?>명</td>
			</tr>
			<tr >
				<th scope="row" >어제방문</th>
				<td><?=number_format($count[2])?>명</td>
			</tr>
			<tr >
				<th  scope="row">최대방문</th>
				<td><?=number_format($count[3])?>명</td>
			</tr>
			<tr >
				<th scope="row">전체방문</th>
				<td><?=number_format($count[4])?>명</td>
			</tr>
			</table>
			<!-- //방문현황 -->
		</td>
		<TD width="25%">
			<!-- 구독현황 -->
			<table >
			<tr><td height="10"  class="tex02"><img src="img/dot.gif" align="absmiddle">구독현황</td></tr>
			</table>
			<table class="tbl_type" border="1" cellspacing="0">
				<colgroup>
				<col width="80" align="center">
				<col align="right"style="padding: 5px 0 0 10px;">
				</colgroup>
			<tr >
				<th scope="row">오늘메일</th>
				<td ><?
				$ymd = date("Y-m-d");
				$today = sql_fetch("select count(*) as cnt from nfor_subscribe where DATE_FORMAT(wr_datetime,'%Y-%m-%d')='$ymd' and wr_email<>''");
				echo number_format($today[cnt]);
				?>명</td>
			</tr>
			<tr >
				<th scope="row">어제메일</th>
				<td ><?
				$ymd = date("Y-m-d",strtotime("-1 day"));
				$yesterday = sql_fetch("select count(*) as cnt from nfor_subscribe where DATE_FORMAT(wr_datetime,'%Y-%m-%d')='$ymd' and wr_email<>''");
				echo number_format($yesterday[cnt]);
				?>명</td>
			</tr>
			<tr >
				<th scope="row">오늘문자</th>
				<td ><?
				$ymd = date("Y-m-d");
				$today = sql_fetch("select count(*) as cnt from nfor_subscribe where DATE_FORMAT(wr_datetime,'%Y-%m-%d')='$ymd' and wr_hp<>''");
				echo number_format($today[cnt]);
				?>명</td>
			</tr>
			<tr >
				<th scope="row">어제문자</th>
				<td ><?
				$ymd = date("Y-m-d",strtotime("-1 day"));
				$yesterday = sql_fetch("select count(*) as cnt from nfor_subscribe where DATE_FORMAT(wr_datetime,'%Y-%m-%d')='$ymd' and wr_hp<>''");
				echo number_format($yesterday[cnt]);
				?>명</td>
			</tr>
			</table>
			<!-- //구독현황 -->	
		</td>
	</tr>
	</table><BR>
	<? } ?>



	<table width="100%">
	<tr>
		<td height="10" class="tex02"><img src="img/dot.gif" align="absmiddle">오늘의 결제현황</td>
		<td align="right">
		<img src="img/ico01.gif" align="absmiddle"> 적립금 
		<img src="img/ico02.gif" align="absmiddle"> 신용카드 
		<img src="img/ico03.gif" align="absmiddle">계좌이체 
		<img src="img/ico04.gif" align="absmiddle"> 핸드폰
		</td>
	</tr>
	</table>


	<table class="tbl_typeB" cellpadding="0" cellspacing="0">
	<tr>
		<th>주문번호</th>
		<th>주문자정보</th>
		<th>상품정보</th>
		<th>상품금액</th>
		<th>배송금액</th>
		<th>합산금액</th>
		<th>결제수단</th>
		<th>적립금사용금액</th>
		<th>결제일자</td>
	</tr>
	<?	
	$ymd = date("Y-m-d");
	$result = sql_query("select * from nfor_order where pay_step='1' and DATE_FORMAT(od_paydatetime,'%Y-%m-%d')='$ymd' order by od_id desc");
	for($i=0; $row=sql_fetch_array($result); $i++){
	?>
	<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
		<td><a href="order_form.php?od_id=<?=$row[od_id]?>&<?=$qstr?>"><?=$row[od_id]?></a></td>
		<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[mb_name]?><br><?=$row[mb_hp]?><br><?=$row[mb_email]?></a></td>
		<td><a href="order_form.php?od_id=<?=$row[od_id]?>&<?=$qstr?>"><?=it_name($row[od_id])?></a></td>
		<td><?=number_format($row[it_price])?>원</td>
		<td><?=number_format($row[delivery_price])?>원</td>
		<td><?=number_format($row[total_price])?>원</td>
		<td><?=payment_type($row[payment_type])?></td>
		<td><?=number_format($row[money_price])?>원</td>
		<td><?=substr($row[od_paydatetime],0,10)?></td>
	</tr>
	<?
	}
	?>
	</table>







	</td>
</tr>
</table>


<?
include "tail.php";
?>
