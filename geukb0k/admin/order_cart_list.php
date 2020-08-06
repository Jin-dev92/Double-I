<?php	// 주문완료목록(개별)
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&ct_is_mobile=$ct_is_mobile&ct_payment_type=$ct_payment_type&payment_ok=$payment_ok&ticket_state=$ticket_state&supply_no=$supply_no&it_id=$it_id&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

if($mode=="cancelrequest"){
	$cancel_why = "관리자임의취소";
	$cancel_why_msg = "";
	sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where ct_id='$ct_id'");
	sql_query("update nfor_cart set delivery_step='3' where ct_id='$ct_id' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리

	$ct = sql_fetch("select * from nfor_cart where ct_id='$ct_id'");
	$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");
	$chk_cart = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='1'");
	if(!$chk_cart[cnt]){
		sql_query("update nfor_order set pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경
	}

	alert("주문취소신청이 처리되었습니다","$PHP_SELF?$qstr");
	exit;
}


if($mode=="list_cancelrequest"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$cancel_why = "관리자임의취소";
		$cancel_why_msg = "";
		sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where ct_id='{$_POST['ct_id'][$k]}'");
		sql_query("update nfor_cart set delivery_step='3' where ct_id='{$_POST['ct_id'][$k]}' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리

		$ct = sql_fetch("select * from nfor_cart where ct_id='{$_POST['ct_id'][$k]}'");
		$order = sql_fetch("select * from nfor_order where cart_id='$ct[cart_id]'");
		$chk_cart = sql_fetch("select count(*) as cnt from nfor_cart where cart_id='$order[cart_id]' and pay_step='1'");
		if(!$chk_cart[cnt]){
			sql_query("update nfor_order set pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경
		}

	}
	alert("주문취소신청이 처리되었습니다","$PHP_SELF?$qstr");	
	exit;
}

$sql_common = " from nfor_cart ";
$sql_search = " where pay_step='1' ";

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
				->setCellValue("C1", "아이디")
				->setCellValue("D1", "이름")
				->setCellValue("E1", "전화번호")
				->setCellValue("F1", "이메일")
				->setCellValue("G1", "상품명")
				->setCellValue("H1", "옵션명")
				->setCellValue("I1", "수량")
				->setCellValue("J1", "배송이름")
				->setCellValue("K1", "배송전화")
				->setCellValue("L1", "배송주소")
				->setCellValue("M1", "배송상태")
				->setCellValue("N1", "주문일자")
				->setCellValue("O1", "택배업체")
				->setCellValue("P1", "송장번호")
				->setCellValue("Q1", "티켓번호")
				->setCellValue("R1", "판매가격")
				->setCellValue("S1", "공급가격")
				->setCellValue("T1", "결제수단")
				->setCellValue("U1", "결제구분")
				->setCellValue("V1", "카드종류");

	for($i=2; $data=sql_fetch_array($result); $i++){    
		$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
		$row = array_merge($data, $order);

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[ct_id]")
					->setCellValue("B$i", "$row[od_id]")
					->setCellValue("C$i", mb_id($row[mb_no]))
					->setCellValue("D$i", "$row[mb_name]")
					->setCellValue("E$i", "$row[mb_hp]")
					->setCellValue("F$i", "$row[mb_email]")
					->setCellValue("G$i", item_name($row[it_id]))
					->setCellValue("H$i", option_select($row))
					->setCellValue("I$i", "$row[option_cnt]")
					->setCellValue("J$i", "$row[dy_name]")
					->setCellValue("K$i", "$row[dy_hp]")
					->setCellValue("L$i", "$row[dy_zip] $row[dy_addr1] $row[dy_addr2]")
					->setCellValue("M$i", delivery_step($row[delivery_step]))
					->setCellValue("N$i", "$row[od_datetime]")
					->setCellValue("O$i", "$row[delivery_company]")
					->setCellValue("P$i", "$row[delivery_number]")
					->setCellValue("Q$i", $row[ticket_number]?$row[ticket_number]:strtoupper(sql_old_password($row[ct_id])))
					->setCellValue("R$i", "$row[option_price]")
					->setCellValue("S$i", "$row[supply_price]")
					->setCellValue("T$i", payment_type($row[payment_type]))
					->setCellValue("U$i", $row[is_mobile]?"(모바일웹)":"")
					->setCellValue("V$i", card_info($row));
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
	<td align="left" height="50">주문서수 : <?=number_format($total_count)?>개</td>
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
		<option value="">전체
		<?
		$que = sql_query("select * from nfor_member where is_supply='1' order by ( case when  supply_name between '가' and  '金' then 1  else 2  end ), supply_name asc");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[mb_no]?>" <?=$data[mb_no]==$supply_no?"selected":""?>><?=$data[supply_name]?>
		<? } ?>
	</select>
	<? } else{ ?>
	<select name="it_id">
		<option value="">전체
		<?
		$que = sql_query("select * from nfor_item where supply_no='$member[mb_no]' order by it_datetime desc");
		while($data = sql_fetch_array($que)){
		?>
		<option value="<?=$data[it_id]?>" <?=$data[it_id]==$it_id?"selected":""?>><?=$data[it_name]?>
		<? } ?>
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
	<input type="text" name="stx" value="<?=$stx?>"><input type="image" src="img/gum_btn.gif" align="absmiddle"> 
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
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>주문번호</th>
	<th>주문자정보</th>
	<th>상품명</th>
	<th>옵션명</th>
	<th>수량</th>
	<th>가격</th>
	<th>합산</th>
	<th>배송정보</th>
	<th>배송상태</th>
	<th>티켓사용</th>
	<th>결제수단</th>
	<th>주문일자</th>
	<th>상태변경</th>
</tr>
<?								
for($i=0; $data=sql_fetch_array($result); $i++){
	$order = sql_fetch("select * from nfor_order where cart_id='$data[cart_id]'");
	$row = array_merge($data, $order);

	$it_name = item_name($row[it_id]);
	$msg = addslashes($it_name)."(".$row[od_id].")";

	$cancelrequest_btn = "javascript:order_cancelrequest_btn('{$PHP_SELF}?mode=cancelrequest&ct_id={$row[ct_id]}&{$qstr}','$msg')";
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="ct_id[<?=$i?>]" value="<?=$row[ct_id]?>"></td>
	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))."?od_id=$row[od_id]&".$qstr?>"><?=$row[od_id]?></a></td>
	<td><?=order_mb($order)?></td>
	<td><a href="<?=$nfor[load]?>?it_id=<?=$row[it_id]?>" target="_blank"><?=$it_name?></a></td>
	<td><?=option_select($row)?></td>
	<td><?=$row[option_cnt]?>개</td>

	<td><?=number_format($row[option_price])?>원</td>
	<td><?=number_format($row[option_price]*$row[option_cnt])?>원</td>


	<td><? if($row[it_delivery]){ ?><?=$row[dy_name]?><br><?=$row[dy_hp]?><br><?=$row[dy_zip]?> <?=$row[dy_addr1]?> <?=$row[dy_addr2]?><? } else{ echo "-";  } ?></td> 
	<td><? if($row[it_delivery]){ ?><?=delivery_step($row[delivery_step])?><? } else{ echo "-";  } ?></td>
	<td><? if($row[it_delivery]){ ?>-<? } else{ ?><?=$row[ticket_used]?>개<? } ?></td>
	
	<td><?=payment_type($row[payment_type])?><br><?=$row[is_mobile]?"(모바일웹)":""?><?=card_info($row)?></td>
	<td><?=substr($row[od_datetime],0,10)?></td>
	<td><a href="<?=$cancelrequest_btn?>"><img src="img/ju_btn02.jpg" align="absmiddle" alt="주문취소신청"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('주문취소신청','list_cancelrequest')"><img src="img/sun1_del.gif" alt="주문취소신청"></a></div>
</form>

<?
include "tail.php";
?>
