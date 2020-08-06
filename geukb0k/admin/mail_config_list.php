<?php	// 공지사항
include "path.php";



if($mode=="list_update"){

	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_send set wr_mail_use='{$wr_mail_use[$k]}',wr_subject='{$wr_subject[$k]}' where wr_id='{$_POST['wr_id'][$k]}'");
	}

	alert("일괄 수정 처리되었습니다","mail_config_list.php?$qstr");
	exit;
}



$sql_common = " from nfor_send ";
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
$rows = 30;
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

<form name="flist" id="flist" method="post" action="mail_config_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th width="120">분류</th>
	<th width="120">코드</th>
	<th width="120">사용여부</th>
	<th>메일제목</th>
	<th width="100">수정</th>
</tr>
<?	for($i=0; $row=sql_fetch_array($result); $i++){	?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=wr_id[<?=$i?>] value='<?=$row[wr_id]?>'></td>
	<td><span class="tex02"><?=$row[ca_name]?></span></td>
	<td><?=$row[wr_code]?></td>
	<td><input type="checkbox" name="wr_mail_use[<?=$i?>]" value="1" <?=$row[wr_mail_use]?"checked":""?>></td>
	<td><input type="text" name="wr_subject[<?=$i?>]" value="<?=$row[wr_subject]?>" style="width:96%"></td>
	<td><a href="mail_config_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('수정','list_update')"><img src="img/sun_update.jpg" alt="선택수정"></a></div>
</form>
<?
include "tail.php";
?>