<?php	// 티켓목록
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&ct_is_mobile=$ct_is_mobile&ct_payment_type=$ct_payment_type&payment_ok=$payment_ok&ticket_state=$ticket_state&supply_no=$supply_no&it_id=$it_id&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		if($_POST['payment_ok_state'][$k]=="2"){
			$payment_date = date("Y-m-d");
		} else{
			$payment_date = "";
		}
		sql_query("update nfor_cart set payment_ok='{$_POST['payment_ok_state'][$k]}', payment_date='$payment_date', payment_chk='{$_POST['payment_chk'][$k]}' where ct_id='{$_POST['ct_id'][$k]}'");
	}	
	alert("정산 상태를 변경하였습니다","ticket_auto_list.php?$qstr");
}

if($sfl=="old_password(ct_id)"){
	$stx = strtolower($stx);
}

$sql_common = " from nfor_cart ";
$sql_search = " where pay_step='1' and delivery_step='0' and it_delivery='0' ";
if($ct_payment_type) $sql_search .= " and ct_payment_type='$ct_payment_type' ";
if($ct_is_mobile) $sql_search .= " and ct_is_mobile='$ct_is_mobile' ";
if($member[is_supply]=="1"){
	$sql_search .= " and supply_no='$member[mb_no]' ";
} else{
	if($supply_no) $sql_search .= " and supply_no='$supply_no' ";
}
if($od_sdate and $od_edate and $date_type){
	$sql_search .= " and date_format($date_type,'%Y-%m-%d')>='$od_sdate' and date_format($date_type,'%Y-%m-%d')<='$od_edate' ";
}
if($payment_ok) $sql_search .= " and payment_ok='$payment_ok' ";
if($ticket_state){
	if($ticket_state=="1"){
		$sql_search .= " and option_cnt <= ticket_used";
	} elseif($ticket_state=="2"){
		$sql_search .= " and option_cnt > ticket_used";
	} else{
		
	}
}

if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		$sql_search .= " and mb_no = '$mb[mb_no]' ";
	} elseif($sfl=="od_id"){
		$order = sql_fetch("select cart_id from nfor_order where od_id='$stx'");
		$sql_search .= " and cart_id = '$order[cart_id]' ";
	} elseif($sfl=="name"){
		$sql_search .= " and (ct_mb_name = '$stx' or ct_od_name = '$stx' or ct_dy_name = '$stx') ";
	} elseif($sfl=="hp"){
		$sql_search .= " and (ct_mb_hp = '$stx' or ct_od_hp = '$stx' or ct_dy_hp = '$stx') ";
	} elseif($sfl=="email"){
		$sql_search .= " and (ct_mb_email = '$stx' or ct_od_email = '$stx') ";
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}

if(!$sst){
	$sst = "ct_id";
	$sod = "desc";
}
$sql_order = " order by $sst $sod ";
$sql = " select count(*) as cnt
						 $sql_common
						 $sql_search
						 $sql_order ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = $config[cf_page_rows];
$total_page  = ceil($total_count / $rows);
if(!$page) $page = 1;
$from_record = ($page - 1) * $rows;
$sql = " select *
			  $sql_common
			  $sql_search
			  $sql_order";

if($mode=="excel"){

	require_once "$nfor[path]/PHPExcel.php";
	$objPHPExcel = new PHPExcel();

	$result = sql_query($sql);
	$cnt = @sql_num_rows($result);
	if(!$cnt) alert("출력할 내역이 없습니다.");

	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue("A1", "고유번호")
				->setCellValue("B1", "주문번호")
				->setCellValue("C1", "주문자아이디")
				->setCellValue("D1", "주문자이름")
				->setCellValue("E1", "주문자연락처")
				->setCellValue("F1", "주문자이메일")
				->setCellValue("G1", "상품명")
				->setCellValue("H1", "옵션명")
				->setCellValue("I1", "사용자이름")
				->setCellValue("J1", "사용자연락처")
				->setCellValue("K1", "사용자이메일")
				->setCellValue("L1", "구매수량")
				->setCellValue("M1", "사용수량")
				->setCellValue("N1", "결제일자")
				->setCellValue("O1", "티켓번호")
				->setCellValue("P1", "판매가격")
				->setCellValue("Q1", "공급가격")
				->setCellValue("R1", "결제수단")
				->setCellValue("S1", "결제구분")
				->setCellValue("T1", "카드종류")
				->setCellValue("U1", "정산상태")
				->setCellValue("V1", "정산수량")
				->setCellValue("W1", "정산일자");

	for($i=2; $data=sql_fetch_array($result); $i++){    
		$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
		$row = array_merge($data, $order);

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[ct_id]")
					->setCellValue("B$i", "$row[od_id]")
					->setCellValue("C$i", mb_id($row[mb_no]))
					->setCellValue("D$i", "$row[mb_name]")
					->setCellValue("E$i", nfor_echo("mb_hp",$row[mb_hp]))
					->setCellValue("F$i", nfor_echo("mb_email",$row[mb_email]))
					->setCellValue("G$i", item_name($row[it_id]))
					->setCellValue("H$i", option_select($row))
					->setCellValue("I$i", "$row[od_name]")
					->setCellValue("J$i", nfor_echo("od_hp",$row[od_hp]))
					->setCellValue("K$i", nfor_echo("od_email",$row[od_email]))
					->setCellValue("L$i", "$row[option_cnt]")
					->setCellValue("M$i", "$row[ticket_used]")
					->setCellValue("N$i", substr($row[od_paydatetime],0,10))
					->setCellValue("O$i", $row[ticket_number]?$row[ticket_number]:strtoupper(sql_old_password($row[ct_id])))
					->setCellValue("P$i", "$row[option_price]")
					->setCellValue("Q$i", "$row[supply_price]")
					->setCellValue("R$i", payment_type($row[payment_type]))
					->setCellValue("S$i", $row[is_mobile]?"(모바일웹)":"")
					->setCellValue("T$i", card_info($row))
					->setCellValue("U$i", $row[payment_ok]=="2"?"정산완료":"정산대기")
					->setCellValue("V$i", $row[payment_chk])
					->setCellValue("W$i", $row[payment_date]);

	}
 


	// 시트이름
	$objPHPExcel->getActiveSheet()->setTitle($menu_code[access_text]);

	$objPHPExcel->setActiveSheetIndex(0);

	// 파일명
	$filename = urlencode($menu_code[access_text]);

	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	header('Cache-Control: max-age=0');

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');

	exit;
}





$sql .= " limit $from_record, $rows ";
$result = sql_query($sql);

include "head.php";
?>		

<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="left" height="50">	
	티켓수량 : <?=number_format($total_count)?>개
	</td>
	<td align="right">
	<form name="fsearch" method="get">

	<select name="date_type">
		<option value="">일자구분
		<option value="ct_od_date" <?=$date_type=="ct_od_date"?"selected":""?>>주문일자
		<option value="ct_od_paydate" <?=$date_type=="ct_od_paydate"?"selected":""?>>결제일자
		<option value="payment_date" <?=$date_type=="payment_date"?"selected":""?>>정산일자
	</select> 
	<input type="text" name="od_sdate" id="od_sdate" value="<?=$od_sdate?>"> ~ <input type="text" name="od_edate" id="od_edate" value="<?=$od_edate?>">


	<select name="ticket_state">
	<option value="">사용구분
	<option value="1" <? if($ticket_state=="1") echo "selected"; ?>>사용
	<option value="2" <? if($ticket_state=="2") echo "selected"; ?>>미사용
	</select>

	<select name="payment_ok">
	<option value="">정산구분
	<option value="1" <? if($payment_ok==1) echo "selected"; ?>>정산대기
	<option value="2" <? if($payment_ok==2) echo "selected"; ?>>정산완료
	</select>	

	<select name="ct_payment_type">
		<option value="">결제수단
		<option value="card" <?=$ct_payment_type=="card"?"selected":""?>>신용카드
		<option value="iche" <?=$ct_payment_type=="iche"?"selected":""?>>계좌이체
		<option value="hp" <?=$ct_payment_type=="hp"?"selected":""?>>휴대폰결제
		<option value="vbanking" <?=$ct_payment_type=="vbanking"?"selected":""?>>가상계좌
		<option value="banking" <?=$ct_payment_type=="banking"?"selected":""?>>무통장입금
		<option value="money" <?=$ct_payment_type=="money"?"selected":""?>>적립금
		<option value="coupon" <?=$ct_payment_type=="coupon"?"selected":""?>>쿠폰
	</select>

	<select name="ct_is_mobile">
		<option value="">결제구분
		<option value="1" <?=$ct_is_mobile=="1"?"selected":""?>>모바일
		<option value="2" <?=$ct_is_mobile=="2"?"selected":""?>>PC
	</select>



	<? if($member[is_supply]=="10"){ ?>
	<select name="supply_no">
		<option value=''>전체
		<?
		$que = sql_query("select * from nfor_member where is_supply='1' order by ( case when  supply_name between '가' and  '金' then 1  else 2  end ), supply_name asc");
		while($data = sql_fetch_array($que)){
		?>
		<option value='<?=$data[mb_no]?>' <?=$data[mb_no]==$supply_no?"selected":""?>><?=$data[supply_name]?>
		<?}?>
	</select>
	<? } else{ ?>
	<select name="it_id">
		<option value=''>전체
		<?
		$que = sql_query("select * from nfor_item where supply_no='$member[mb_no]' order by it_datetime desc");
		while($data = sql_fetch_array($que)){
		?>
		<option value='<?=$data[it_id]?>' <?=$data[it_id]==$it_id?"selected":""?>><?=$data[it_name]?>
		<?}?>
	</select>
	<? } ?>	
	<select name="sfl">
	<?
	$sfl_txt_array = array("이름","연락처","이메일","아이디","주문번호","상품코드","수동티켓번호","자동티켓번호");
	$sfl_val_array = array("name","hp","email","mb_id","od_id","it_id","ticket_number","old_password(ct_id)");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type=text name=stx class=ed itemname='검색어' value='<? echo $stx ?>'><input type="image" src="img/gum_btn.gif" align="absmiddle"> 
	<a href="<?=$PHP_SELF?>?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>




	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="<?=$PHP_SELF?>">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="date_type" value="<?=$date_type?>">
<input type="hidden" name="od_sdate" value="<?=$od_sdate?>">
<input type="hidden" name="od_edate" value="<?=$od_edate?>">
<input type="hidden" name="supply_no" value="<?=$supply_no?>">
<input type="hidden" name="it_id" value="<?=$it_id?>">
<input type="hidden" name="ticket_state" value="<?=$ticket_state?>">
<input type="hidden" name="payment_ok" value="<?=$payment_ok?>">
<input type="hidden" name="ct_payment_type" value="<?=$ct_payment_type?>">
<input type="hidden" name="ct_is_mobile" value="<?=$ct_is_mobile?>">
<table class="tbl_typeB" cellpadding="0" cellspacing="0">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>주문번호</th>
	<th>주문자정보</th>
	<th>사용자정보</th>
	<th>상품명</th>
	<th>옵션명</th>
	<th>금액</th>
	<th>구매수량</th>
	<th>사용수량</th>
	<th>사용수량변경</th>
	<th>정산수량</th>
	<th>티켓번호</th>
	<th>결제일자</th>
	<th>결제수단</th>
	<th>정산상태</th>
	<th>정산일자</th>
</tr>
<?								
for($i=0; $data=sql_fetch_array($result); $i++){
	$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
	$row = array_merge($data, $order);
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type=hidden name=ct_id[<?=$i?>] value='<?=$row[ct_id]?>'></td>
	<td><a href="<?=order_view_link($row)?>"><?=$row[od_id]?></a></td>
	<td><?=order_mb($row)?></td>
	<td><?=order_us($row)?></td>
	<td><a href="<?=item_link($row[it_id])?>" target="_blank"><?=item_name($row[it_id])?></a></td>
	<td><?=option_select($row)?></td>
	<td><?=number_format($row[option_price]*$row[option_cnt])?>원</td>
	<td><?=$row[option_cnt]?></td>
	<td>
	<a href="javascript:ticket_chage_win('<?=$row[ct_id]?>')"><?=$row[ticket_used]?></a>	
	</td>
	<td><a href="javascript:ticket_chage_win('<?=$row[ct_id]?>')" class="btn_sml"><span>사용수량변경</span></a></td>
	<td>
		<? if($is_admin){ ?>
		<select name="payment_chk[]">
		<? for($s=0; $s<=$row[option_cnt]; $s++){ ?>
		<option value="<?=$s?>" <? if($row[payment_chk]==$s) echo "selected"; ?>><?=$s?>
		<? } ?>
		</select>
		<? } else{ ?>
		<?=$row[payment_chk]?>
		<? } ?>
	</td>	
	<td><?=$row[ticket_number]?$row[ticket_number]:strtoupper(sql_old_password($row[ct_id]))?></td>
	<td><?=substr($row[od_paydatetime],0,10)?></td>
	<td><?=payment_type($row[payment_type])?><br><?=$row[is_mobile]?"(모바일웹)":""?><?=card_info($row)?></td>
	<td>
	<? if($is_admin){ ?>
		<select name="payment_ok_state[]">
			<option value="1" <? if($row[payment_ok]=="1") echo "selected"; ?>>정산대기
			<option value="2" <? if($row[payment_ok]=="2") echo "selected"; ?>>정산완료
		</select>	
	<? } else{ ?>	
		<?=$row[payment_ok]=="2"?"정산완료":"정산대기"?>
		<input type="hidden" name="payment_ok_state[]" value="<?=$row[payment_ok]?>">
	<? } ?>
	</td>	
	<td><?=$row[payment_date]?$row[payment_date]:"-"?></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<? if($is_admin){ ?><div class="btn_cen"><a href="javascript:nfor_list('정산상태변경','list_update')"><img src="img/chjong_btn.jpg"></a></div><? } ?> 
</form>

<script type="text/javascript">
<!--
function ticket_chage_win(ct_id){
    window.open("ticket_change.php?ct_id="+ct_id, "ticket_chage", "left=50,top=50,width=540,height=600,scrollbars=1");
}
//-->
</script>
<?
include "tail.php";
?>