<?php	// 공지사항
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_notice where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","notice_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_notice where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","notice_list.php?$qstr");
}

$sql_common = " from nfor_notice ";
$sql_search = " where (1) ";
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
	$sfl_txt_array = array("분류","제목","내용");
	$sfl_val_array = array("ca_name","wr_subject","wr_memo");
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

<form name="flist" id="flist" method="post" action="notice_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>제목</th>
	<th width="100">노출여부</th>
	<th width="120">등록일시</th>
	<th width="100">조회수</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=wr_id[<?=$i?>] value='<?=$row[wr_id]?>'></td>
	<td style="text-align:left; padding-left:10px;"><span class="tex02"><?=$row[ca_name]?"[".$row[ca_name]."] ":" "?></span>&nbsp;<a href="notice_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>" class="left_menu"><?=cut_str($row[wr_subject],60)?></a></td>
	<td><?=$row[wr_view]?"미노출":"노출"?></td>
	<td><?=substr($row[wr_datetime],0,10)?></td>
	<td><?=$row[wr_hit]?></td>
	<td><a href="notice_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('notice_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="notice_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>