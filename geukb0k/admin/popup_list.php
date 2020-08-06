<?php	// 팝업관리
include "path.php";
$qstr .= "&wr_type=$wr_type";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_popup where popup_id='{$_POST['popup_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","popup_list.php?$qstr");
	exit;
}
if($mode=="delete"){
	sql_query("delete from nfor_popup where popup_id='$popup_id'");
	alert("정상적으로 삭제되었습니다","popup_list.php?$qstr");
	exit;
} 

$sql_common = " from nfor_popup ";
$sql_search = " where (1) ";
if($stx) $sql_search .= " and $sfl like '%$stx%' ";
if($wr_type) $sql_search .= " and wr_type = '$wr_type' ";
if(!$sst){
	$sst = "popup_id";
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
$from_record = ($page-1)*$rows;
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
	<form name="search" method="get" action="popup_list.php">
	<select name="wr_type" onchange="search.submit()">
	<option value="">선택
	<?
	$wr_type_txt = array("윈도우팝업","레이어팝업");
	$wr_type_val = array("window","layer");
	for($i=0; $i<count($wr_type_txt); $i++){
	?>	
		<option value="<?=$wr_type_val[$i]?>" <? if($wr_type==$wr_type_val[$i]) echo "selected"; ?>><?=$wr_type_txt[$i]?>
	<? } ?>
	</select>
	</form>
	</td>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<input type="hidden" name="wr_type" value="<?=$wr_type?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("제목","내용");
	$sfl_val_array = array("wr_subject","wr_memo");
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

<form name="flist" id="flist" method="post" action="popup_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="wr_type" value="<?=$wr_type?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>									
	<th>제목</th>
	<th width="80">사용여부</th>
	<th width="120">팝업기간</th>
	<th width="80">팝업형태</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<? for($i=0; $row=sql_fetch_array($result); $i++){ ?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="popup_id[<?=$i?>]" value="<?=$row[popup_id]?>"></td>			
	<td style="text-align:left; padding-left:10px;">
	
	<span class="tex02"><?
	if($row[it_id]){
		$item = sql_fetch("select * from nfor_item where it_id='$row[it_id]'");
		echo "<a href='$nfor[load]?it_id=$row[it_id]' class='tex02' target='_blank'>[{$item[it_name]}]</a>";
	} 
	?></span>
	<a href="popup_form.php?popup_id=<?=$row[popup_id]?>&<?=$qstr?>" class="left_menu"><?=cut_str($row[wr_subject],80)?></a>
	
	</td>
	<td><?=$row[wr_use]?"사용":"미사용"; ?></td>
	<td><?=substr($row[wr_sdatetime],0,10)?><br><?=substr($row[wr_edatetime],0,10)?></td>
	<td><?=$row[wr_type]?></td>
	<td><a href="popup_form.php?popup_id=<?=$row[popup_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('popup_list.php?mode=delete&popup_id=<?=$row[popup_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="popup_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>