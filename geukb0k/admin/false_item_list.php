<?php	// 상품평예약
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$write = sql_fetch("select * from nfor_false_item where wr_id='{$_POST['wr_id'][$k]}'");
		item_access($write[it_id]);
		sql_query("delete from nfor_false_item where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","false_item_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	$write = sql_fetch("select * from nfor_false_item where wr_id='$wr_id'");
	item_access($write[it_id]);
	sql_query("delete from nfor_false_item where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","false_item_list.php?$qstr");
}

$sql_common = " from nfor_false_item ";
$sql_search = " where 1 ";

if($member[is_supply]=="1") $sql_search .= " and supply_no='$member[mb_no]' ";

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
$sql = " select  *
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
	$sfl_txt_array = array("상품코드");
	$sfl_val_array = array("it_id");
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

<form name="flist" id="flist" method="post" action="false_item_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="0" cellspacing="0" class="tbl_typeB">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>상품명</th>
	<th width="200">증가수량</th>
	<th width="200">등록일자</th>
	<th width="100">복사</th>
	<th width="100">수정</th>
	<th width="100">삭제</th>
</tr>
<?	
for($i=0; $row=sql_fetch_array($result); $i++){	
	$item = sql_fetch("select * from nfor_item where it_id='$row[it_id]'");
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td><a href="<?=item_link($item[it_id])?>" target="_blank"><?=$item[it_name]?></a></td>
	<td><?=number_format($row[it_sales_volume])?>개</td>
	<td><span style="color:<?=$nfor[ymdhis]>$row[wr_datetime]?"blue":"red"?>"><?=$row[wr_datetime]?></span></td>
	<td><a href="false_item_form.php?mode=copy_form&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/copybtn.gif"></a></td>
	<td><a href="false_item_form.php?mode=update_form&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('false_item_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<?
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<br><span class="tex01">&nbsp;프로그램 오류 및 직원실수로 데이터 누락등이 발생하였을때 이용되는 응급 페이지입니다.</span>

<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="false_item_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>
<?
include "tail.php";
?>