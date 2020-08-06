<?php	// 주문목록
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&is_mobile=$is_mobile&payment_type=$payment_type&od_sdate=$od_sdate&od_edate=$od_edate&date_type=$date_type";

// 주문취소신청
if($mode=="cancelrequest"){
	$order = sql_fetch("select * from nfor_order where od_id='$od_id'");
	sql_query("update nfor_order set is_cancel='1', pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경

	$cancel_why = "관리자임의취소";
	$cancel_why_msg = "";
	sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where cart_id='$order[cart_id]' and pay_step='1'");

	sql_query("update nfor_cart set delivery_step='3' where cart_id='$order[cart_id]' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리
	nfor_send("cancel_request",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	alert("주문취소신청이 처리되었습니다","$PHP_SELF?$qstr");
	exit;
}

// 다중 주문취소신청
if($mode=="list_cancelrequest"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$order = sql_fetch("select * from nfor_order where od_id='{$_POST['od_id'][$k]}'");
		sql_query("update nfor_order set is_cancel='1', pay_step='2', od_cancelrequest=NOW() where od_id='$order[od_id]'");	// 주문상태를 취소신청(2) 으로 변경

		$cancel_why = "관리자임의취소";
		$cancel_why_msg = "";
		sql_query("update nfor_cart set pay_step='2', od_cancelrequest=NOW(), cancel_why='$cancel_why', cancel_why_msg='$cancel_why_msg' where cart_id='$order[cart_id]' and pay_step='1'");

		sql_query("update nfor_cart set delivery_step='3' where cart_id='$order[cart_id]' and delivery_step='2'");	// 배송완료(2)일경우 반품신청(3) 처리
		nfor_send("cancel_request",$order[mb_email],$order[mb_hp],$order[mb_no],$order[od_id]);
	}
	alert("주문취소신청이 처리되었습니다","$PHP_SELF?$qstr");	
	exit;
}

$sql_common = " from nfor_order ";
$sql_search = " where pay_step='1' ";

if($is_mobile){
	if($is_mobile=="1"){
		$sql_search .= " and is_mobile='1'";
	} else{
		$sql_search .= " and is_mobile='0'";
	}
}

if($payment_type){
	$sql_search .= " and payment_type='$payment_type'";
}

if($od_sdate and $od_edate and $date_type){
	$sql_search .= " and date_format($date_type,'%Y-%m-%d')>='$od_sdate' and date_format($date_type,'%Y-%m-%d')<='$od_edate' ";
}

if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		$sql_search .= " and mb_no = '$mb[mb_no]' ";
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}
if(!$sst){
	$sst = "od_id";
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
				->setCellValue("A1", "주문번호")
				->setCellValue("B1", "주문자 아이디")
				->setCellValue("C1", "주문자 이름")
				->setCellValue("D1", "주문자 연락처")
				->setCellValue("E1", "주문자 이메일")
				->setCellValue("F1", "상품정보")
				->setCellValue("G1", "상품금액")
				->setCellValue("H1", "배송금액")
				->setCellValue("I1", "합산금액")
				->setCellValue("J1", "적립금사용금액")
				->setCellValue("K1", "결제수단")				
				->setCellValue("L1", "주문일자")
				->setCellValue("M1", "결제일자");

	for($i=2; $row=sql_fetch_array($result); $i++){    

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", $row[od_id])
					->setCellValue("B$i", mb_id($row[mb_no]))
					->setCellValue("C$i", $row[mb_name])
					->setCellValue("D$i", $row[mb_hp])
					->setCellValue("E$i", $row[mb_email])
					->setCellValue("F$i", it_name($row[od_id]))
					->setCellValue("G$i", $row[it_price])
					->setCellValue("H$i", $row[delivery_price])
					->setCellValue("I$i", $row[total_price])
					->setCellValue("J$i", $row[money_price])
					->setCellValue("K$i", payment_type($row[payment_type]))					
					->setCellValue("L$i", substr($row[od_datetime],0,10))
					->setCellValue("M$i", substr($row[od_paydatetime],0,10));

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
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
	<td align="left" height="50">주문서수 : <?=number_format($total_count)?>개</td>
	<td align="right">
	<form name="fsearch" method="get">

	<select name="payment_type">
		<option value="">결제수단
		<option value="card" <?=$payment_type=="card"?"selected":""?>>신용카드
		<option value="iche" <?=$payment_type=="iche"?"selected":""?>>계좌이체
		<option value="hp" <?=$payment_type=="hp"?"selected":""?>>휴대폰결제
		<option value="vbanking" <?=$payment_type=="vbanking"?"selected":""?>>가상계좌
		<option value="banking" <?=$payment_type=="banking"?"selected":""?>>무통장입금
		<option value="money" <?=$payment_type=="money"?"selected":""?>>적립금
		<option value="coupon" <?=$payment_type=="coupon"?"selected":""?>>쿠폰
	</select>

	<select name="is_mobile">
		<option value="">결제구분
		<option value="1" <?=$is_mobile=="1"?"selected":""?>>모바일
		<option value="2" <?=$is_mobile=="2"?"selected":""?>>PC
	</select>

	<select name="date_type">
		<option value="">일자구분
		<option value="od_datetime" <?=$date_type=="od_datetime"?"selected":""?>>주문일자
		<option value="od_paydatetime" <?=$date_type=="od_paydatetime"?"selected":""?>>결제일자
	</select> 
	<input type="text" name="od_sdate" id="od_sdate" value="<?=$od_sdate?>"> ~ <input type="text" name="od_edate" id="od_edate" value="<?=$od_edate?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("주문번호","아이디","주문자이름","주문자연락처","주문자이메일","배송지이름","배송지연락처","사용자이름","사용자연락처","사용자이메일","자동이체코드");
	$sfl_val_array = array("od_id","mb_id","mb_name","mb_hp","mb_email","dy_name","dy_hp","od_name","od_hp","od_email","pg_tid");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
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
<table class="tbl_typeB" cellpadding="0" cellspacing="0">
<tr>
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>주문번호</th>
	<th>주문자정보</th>
	<th>상품정보</th>
	<th>상품금액</th>
	<th>배송금액</th>
	<th>합산금액</th>
	<th>결제수단</th>
	<th>적립금</th>
	<th>할인쿠폰</th>
	<th>주문일자</td>
	<th>결제일자</td>
	<th>상태변경</th>
</tr>
<?								
for($i=0; $row=sql_fetch_array($result); $i++){
	$it_name = it_name($row[od_id]);
	$msg = addslashes($it_name)."(".$row[od_id].")";

	$cancelrequest_btn = "javascript:order_cancelrequest_btn('{$PHP_SELF}?mode=cancelrequest&od_id={$row[od_id]}&{$qstr}','$msg')";
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="od_id[<?=$i?>]" value="<?=$row[od_id]?>"></td>
	<td><a href="<?=str_replace("list","form",basename($PHP_SELF))."?od_id=$row[od_id]&".$qstr?>"><?=$row[od_id]?></a></td>
	<td><?=order_mb($row)?></td>
	<td><?=$it_name?></td>
	<td><?=number_format($row[it_price])?>원</td>
	<td><?=number_format($row[delivery_price])?>원</td>
	<td><?=number_format($row[total_price])?>원</td>
	<td><?=payment_type($row[payment_type])?><br><?=$row[is_mobile]?"(모바일웹)":""?></td>
	<td><?=number_format($row[money_price])?>원</td>
	<td><?=number_format($row[coupon_price])?>원</td>
	<td><?=substr($row[od_datetime],0,10)?></td>
	<td><?=substr($row[od_paydatetime],0,10)?></td>
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