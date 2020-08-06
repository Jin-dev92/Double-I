<?php	// 공지사항
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_pg_code where pg_id='{$_POST['pg_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","pg_code_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_pg_code where pg_id='$pg_id'");
	alert("정상적으로 삭제되었습니다","pg_code_list.php?$qstr");
}

$sql_common = " from nfor_pg_code ";
$sql_search = " where pg_type='kcp' and pg_payment_type='vbanking' ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if(!$sst){
	$sst = "pg_rank";
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
	$sfl_txt_array = array("은행명","은행코드");
	$sfl_val_array = array("pg_name","pg_code");
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

<form name="flist" id="flist" method="post" action="pg_code_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>은행명</th>
	<th>은행코드</th>
	<th>정렬순위</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=pg_id[<?=$i?>] value='<?=$row[pg_id]?>'></td>
	<td><?=$row[pg_name]?></td>
	<td><?=$row[pg_code]?></td>
	<td><?=$row[pg_rank]?></td>
	<td><a href="pg_code_form.php?pg_id=<?=$row[pg_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('pg_code_list.php?mode=delete&pg_id=<?=$row[pg_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="pg_code_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
※ 해당 코드는 PG사 마다 다르기 때문에 해당 PG사에 문의하여 기초자료를 입력합니다.
<?
include "tail.php";
?>