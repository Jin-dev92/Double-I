<?php	// FAQ관리
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_faq where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","faq_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_faq where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","faq_list.php?$qstr");
}

$sql_common = " from nfor_faq ";
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
	<td>
	<form name="search" method="get" action="<?=$PHP_SELF?>">
	<select name="ca_name" id="ca_name" onchange="search.submit()">
	<option value="">문의분류
	<?
	for($i=0; $i<count($nfor[faq]); $i++){
	?>	
	<option value="<?=$nfor[faq][$i]?>" <? if($ca_name==$nfor[faq][$i]) echo "selected"; ?>><?=$nfor[faq][$i]?>
	<? } ?>
	</select>
	</form>
	</td>
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

<form name="flist" id="flist" method="post" action="faq_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th scope="col"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></td>
	<th scope="col">분류</th>
	<th scope="col">제목</th>
	<th scope="col">베스트</th>
	<th scope="col">우선순위</th>
	<th scope="col">노출여부</th>
	<th scope="col">수정</th>
	<th scope="col">삭제</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=wr_id[<?=$i?>] value='<?=$row[wr_id]?>'></td>
	<td><?=$row[ca_name]?></td>
	<td align="left">&nbsp;&nbsp;<a href="faq_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>" class="left_menu"><?=cut_str($row[wr_subject],60)?></a></td>
	<td><?=$row[wr_best]?></td>
	<td><?=$row[wr_rank]?></td>

	<td><?=$row[wr_view]?"미노출":"노출"?></td>

	<td><a href="faq_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('faq_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="faq_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>
