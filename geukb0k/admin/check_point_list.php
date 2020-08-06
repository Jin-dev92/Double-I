<?php	// 체크포인트설정
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$write = sql_fetch("select wr_icon_img from nfor_check_point where wr_id='{$_POST['wr_id'][$k]}'");
		@unlink($nfor[path]."/data/icon/".$write[wr_icon_img]);
		sql_query("delete from nfor_check_point where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","check_point_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	$write = sql_fetch("select wr_icon_img from nfor_check_point where wr_id='$wr_id'");
	@unlink($nfor[path]."/data/icon/".$write[wr_icon_img]);
	sql_query("delete from nfor_check_point where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","check_point_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_check_point ";
$sql_search = " where (1) ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if (!$sst) {
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
	$sfl_txt_array = array("이름");
	$sfl_val_array = array("wr_icon");
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

<form name="flist" id="flist" method="post" action="check_point_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th scope="col"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th scope="col">이미지</th>
	<th scope="col">이름</th>
	<th scope="col">수정</th>
	<th scope="col">삭제</th>
</tr>
<? for($i=0; $row=sql_fetch_array($result); $i++){ ?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><? if($row[wr_icon_img]){ ?><img src="<?="$nfor[path]/data/icon/$row[wr_icon_img]"?>"><?}?></td>
	<td><?=$row[wr_icon]?></td>
	<td><a href="check_point_form.php?mode=update_form&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('check_point_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<?=$pagelist?>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="check_point_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>