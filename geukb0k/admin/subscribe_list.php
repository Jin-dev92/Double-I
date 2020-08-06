<?php	// 구독자관리
include "path.php";
ini_set('memory_limit', -1);

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_subscribe where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","subscribe_list.php?$qstr");
	exit;
}

if($mode=="list_update"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_subscribe set wr_email='{$_POST['wr_email'][$k]}', wr_hp='{$_POST['wr_hp'][$k]}' where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 수정되었습니다","subscribe_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_subscribe where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","subscribe_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_subscribe ";
$sql_search = " where wr_email<>'' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "wr_id";
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
if (!$page) $page = 1;
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
				->setCellValue("A1", "이메일")
				->setCellValue("B1", "휴대폰")
				->setCellValue("C1", "구독일자");

	for($i=2; $row=sql_fetch_array($result); $i++){    

		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue("A$i", "$row[wr_email]")
					->setCellValue("B$i", "$row[wr_hp]")
					->setCellValue("C$i", substr("$row[wr_datetime]",0,10));
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
		$sfl_txt_array = array("이메일","휴대폰");
		$sfl_val_array = array("wr_email","wr_hp");
		for($i=0; $i<count($sfl_txt_array); $i++){
		?>
		<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
		<? } ?>
		</select>	
		<input type="text" name="stx" value="<?=$stx?>">
		<input type="image" src="img/gum_btn.gif" align="absmiddle">
		<a href="subscribe_list.php?mode=excel&<?=$qstr?>"><img src="img/ex_down.gif" alt="엑셀다운" align="absmiddle"></a>
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="subscribe_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>이메일</th>
	<th>휴대폰</th>
	<th>구독일자</th>
	<th>삭제</th>
</tr>
<? for($i=0; $row=sql_fetch_array($result); $i++){ ?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><input type="text" name="wr_email[<?=$i?>]" value="<?=$row[wr_email]?>" size="20" class="input_txt"></td>
	<td><input type="text" name="wr_hp[<?=$i?>]" value="<?=$row[wr_hp]?>" size="13" class="input_txt"></td>
	<td><?=substr($row[wr_datetime],0,10)?></td>
	<td><a href="javascript:del('subscribe_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<? 
} 
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="javascript:nfor_list('수정','list_update')"><img src="img/list_su_btn.gif" alt="선택수정"></a></div>
</form>
<?
include "tail.php";
?>