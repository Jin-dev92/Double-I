<?php	// 공지사항
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_dy_zipcode where zip_zipcode='{$_POST['zip_zipcode'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","zipcode_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_dy_zipcode where zip_zipcode='$zip_zipcode'");
	alert("정상적으로 삭제되었습니다","zipcode_list.php?$qstr");
}

$sql_common = " from nfor_dy_zipcode ";
$sql_search = " where (1) ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "zip_zipcode";
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
				  $sql_order
				  limit $from_record, $rows ";
$result = sql_query($sql);

include "head.php";
?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td height="50" align="right">				
	<form name="fsearch" method="get">
	<select name="sfl">
	<?
	$sfl_txt_array = array("주소","우편번호","구분");
	$sfl_val_array = array("zip_address","zip_zipcode","zip_type");
	for($i=0; $i<count($sfl_txt_array); $i++){
	?>	
		<option value="<?=$sfl_val_array[$i]?>" <? if($sfl==$sfl_val_array[$i]) echo "selected"; ?>><?=$sfl_txt_array[$i]?>
	<? } ?>
	</select>
	<input type="text" name="stx" value="<?=$stx?>">
	<input type="image" src="img/gum_btn.gif" align="absmiddle">
	</form>
	</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="zipcode_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>주소</th>
	<th width="120">구분</th>
	<th width="100">추가배송비</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=zip_zipcode[<?=$i?>] value='<?=$row[zip_zipcode]?>'></td>
	<td style="text-align:left; padding-left:10px;"><span class="tex02"><?=$row[zip_zipcode]?></span>&nbsp;<a href="zipcode_form.php?zip_zipcode=<?=$row[zip_zipcode]?>&<?=$qstr?>" class="left_menu"><?=cut_str($row[zip_address],60)?></a></td>
	<td><?=$row[zip_type]?></td>
	<td><?=number_format($row[zip_price])?>원</td>
	<td><a href="zipcode_form.php?zip_zipcode=<?=$row[zip_zipcode]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('zipcode_list.php?mode=delete&zip_zipcode=<?=$row[zip_zipcode]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="zipcode_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>