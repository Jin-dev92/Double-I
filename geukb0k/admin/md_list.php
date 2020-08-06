<?php	// 회원관리
include "path.php";
ini_set('memory_limit', -1);

if($mode=="update"){
	$mb_secession = "관리자에 의한 삭제";
	$sql = " update nfor_member set mb_leavedatetime=NOW(), mb_secession='$mb_secession' where mb_no = '$mb_no' ";
	sql_query($sql);
	alert("선택한 인원에 대해서 탈퇴신청 처리되었습니다","md_list.php?$qstr");
	exit;
}

if($mode=="list_update"){
	$mb_secession = "관리자에 의한 삭제";
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$sql = " update nfor_member set mb_leavedatetime=NOW(), mb_secession='$mb_secession' where mb_no = '{$_POST['mb_no'][$k]}' ";
		sql_query($sql);
	}
	alert("선택한 인원에 대해서 탈퇴신청 처리되었습니다","md_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_member ";
$sql_search = " where is_supply='2' and mb_leavedatetime='' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "mb_no";
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
				->setCellValue("B1", "이름")
				->setCellValue("C1", "이메일")
				->setCellValue("D1", "핸드폰")
				->setCellValue("E1", "우편번호")
				->setCellValue("F1", "주소")
				->setCellValue("G1", "상세주소")
				->setCellValue("H1", "성별")
				->setCellValue("I1", "생년월일")
				->setCellValue("J1", "적립금")
				->setCellValue("K1", "SMS동의")
				->setCellValue("L1", "이메일동의")
				->setCellValue("M1", "가입일시")
				->setCellValue("N1", "가입IP")
				->setCellValue("O1", "최근접속일시")
				->setCellValue("P1", "최근접속IP");

	for($i=2; $row=sql_fetch_array($result); $i++){    

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[mb_no]")
					->setCellValue("B$i", "$row[mb_name]")
					->setCellValue("C$i", "$row[mb_email]")
					->setCellValue("D$i", "$row[mb_hp]")
					->setCellValue("E$i", "$row[mb_zipcode]")
					->setCellValue("F$i", "$row[mb_addr1]")
					->setCellValue("G$i", "$row[mb_addr2]")
					->setCellValue("H$i", "$row[mb_sex]")
					->setCellValue("I$i", "$row[mb_birth]")
					->setCellValue("J$i", mb_money($row[mb_no]))
					->setCellValue("K$i", "$row[mb_sms]")
					->setCellValue("L$i", "$row[mb_mailling]")
					->setCellValue("M$i", "$row[mb_datetime]")
					->setCellValue("N$i", "$row[mb_ip]")
					->setCellValue("O$i", "$row[mb_today_login]")
					->setCellValue("P$i", "$row[mb_login_ip]");
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
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<select name="sfl">
	<?
	$sfl_txt_array = array("아이디","이름","이메일","핸드폰","성별");
	$sfl_val_array = array("mb_id","mb_name","mb_email","mb_hp","mb_sex");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>
	<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	<a href="md_list.php?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</tr>
</table>	

<form name="flist" id="flist" method="post" action="md_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl"   value="<?=$sfl?>">
<input type="hidden" name="stx"   value="<?=$stx?>">
<input type="hidden" name="page"  value="<?=$page?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<? if($nfor[id_type]=="mb_id"){ ?><th>아이디</th><? } ?>
	<th>이메일</th>
	<th>이름</th>
	<th>적립금</th>
	<th>핸드폰</th>
	<th>주소</th>
	<th>성별</th>
	<th>생년월일</th>
	<th>가입일자</th>
	<th>최근접속일자</th>
	<th>수정</th>
	<th>삭제</th>
</tr>
<? for($i=0; $row=sql_fetch_array($result); $i++){ ?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=mb_no[<?=$i?>] value='<?=$row[mb_no]?>'></td>
	<? if($nfor[id_type]=="mb_id"){ ?><td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[mb_id]?></a></td><? } ?>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=$row[mb_email]?></a></td>
	<td><a href="javascript:member('<?=$row[mb_no]?>')"><?=cut_str($row[mb_name],10)?></a></td>
	<td><a href="money_list.php?mb_no=<?=$row[mb_no]?>"><?=number_format(mb_money($row[mb_no]))?>원</a></td>
	<td><?=$row[mb_hp]?></td>
	<td><?=$row[mb_zipcode]?> <?=$row[mb_addr1]?> <?=$row[mb_addr2]?></td>
	<td><?=$row[mb_sex]?></td>
	<td><?=$row[mb_birth]?></td>
	<td><?=substr($row[mb_datetime],0,10)?></td>
	<td><?=substr($row[mb_today_login],0,10)?></td>
	<td><a href="md_form.php?mb_no=<?=$row[mb_no]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('md_list.php?mode=update&mb_no=<?=$row[mb_no]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('탈퇴신청','list_update')"><img src="img/sun_del.gif" alt="선택삭제"></a><a href="md_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>