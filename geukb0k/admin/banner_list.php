<?php	// 배너관리
include "path.php";

$qstr .= "&wr_code=$wr_code";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$banner = sql_fetch("select wr_banner_img from nfor_banner where banner_id='{$_POST['banner_id'][$k]}'");
		@unlink($nfor[path]."/data/banner/".$banner[wr_banner_img]);
		sql_query("delete from nfor_banner where banner_id='{$_POST['banner_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","banner_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	$banner = sql_fetch("select wr_banner_img from nfor_banner where banner_id='$banner_id'");
	@unlink($nfor[path]."/data/banner/".$banner[wr_banner_img]);
	sql_query("delete from nfor_banner where banner_id='$banner_id'");
	alert("정상적으로 삭제되었습니다","banner_list.php?$qstr");
	exit;
}

$sql_common = " from nfor_banner ";
$sql_search = " where 1 ";
if($wr_code) $sql_search .= " and wr_code='$wr_code' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if (!$sst) {
	$sst = "wr_edate desc, wr_rank";
	$sod = "asc";
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
	<td>
	<form name="search" method="get" action="banner_list.php">
	<select name="wr_code" onchange="search.submit()">
	<option value="">선택
	<?
	$que = sql_query("select * from nfor_banner_group order by wr_id");
	while($data = sql_fetch_array($que)){
	?>
	<option value="<?=$data[wr_code]?>" <? if($data[wr_code]==$wr_code) echo "selected"; ?>><?=$data[wr_group]?> - <?=$data[wr_code]?>
	<? } ?>
	</select>
	</form>
	</td>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<input type="hidden" name="wr_code" value="<?=$wr_code?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("배너이름");
	$sfl_val_array = array("wr_name");
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

<form name="flist" id="flist" method="post" action="banner_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="wr_code" value="<?=$wr_code?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th width="200">배너그룹 <a href="javascript:banner_type_form()"><img src="img/area_p_ico.gif" alt="배너그룹추가" align="absmiddle"></a></th>
	<th width="200">배너코드</th>
	<th>배너이미지</th>
	<th width="200">배너이름</th>
	<th width="140">배너기간</th>
	<th width="80">출력순위</th>
	<th width="80">노출여부</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){ 
	$data = sql_fetch("select * from nfor_banner_group where wr_code='$row[wr_code]'");
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="banner_id[<?=$i?>]" value="<?=$row[banner_id]?>"></td>
	<td><?=$data[wr_group]?></td>
	<td><?=$row[wr_code]?></td>
	<td><a href="<?=$row[wr_link]?>"><? if($row[wr_banner_img]){ ?><img src="<?="$nfor[path]/data/banner/$row[wr_banner_img]"?>" alt="<?=$row[wr_name]?>" style="max-width:300px; max-height:50px;"><? } else{ ?><?=$row[wr_name]?><? } ?></a></td>
	<td><?=$row[wr_name]?></td>
	<td><?=$row[wr_sdate]?><br><?=$row[wr_edate]?></td>
	<td><?=$row[wr_rank]*-1?></td>
	<td><?=$row[wr_use]?"노출":"미노출"?></td>	
	<td><a href="banner_form.php?banner_id=<?=$row[banner_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('banner_list.php?mode=delete&banner_id=<?=$row[banner_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="banner_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>
