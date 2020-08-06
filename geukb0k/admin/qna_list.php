<?php	// 상품문의관리
include "path.php";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		$write = sql_fetch("select * from nfor_item_qna where wr_id='{$_POST['wr_id'][$k]}'");
		item_access($write[it_id]);
		sql_query("delete from nfor_item_qna where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","qna_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	$write = sql_fetch("select * from nfor_item_qna where wr_id='$wr_id'");
	if(!$is_admin and $write[mb_no]<>$member[mb_no]){
		alert("본인글만 삭제가능합니다");
	}
	item_access($write[it_id]);
	sql_query("delete from nfor_item_qna where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","qna_list.php?$qstr");
	exit;
} 

$sql_common = " from nfor_item_qna ";
$sql_search = " where is_false='0' and wr_reply='0'";

if($member[is_supply]=="1"){
	$sql_search .= " and supply_no='$member[mb_no]'";
}
if($stx){
	if($sfl=="mb_id"){
		$mb = sql_fetch("select mb_no from nfor_member where {$nfor[id_type]}='$stx'");
		if($mb[mb_no]){
			$sql_search .= " and mb_no = '$mb[mb_no]' ";
		} else{
			$sql_search .= " and mb_no = '9999999999' ";
		}
	} else{
		$sql_search .= " and $sfl like '%$stx%' ";
	}
}
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
	$sfl_txt_array = array("아이디","상품코드","내용");
	$sfl_val_array = array("mb_id","it_id","wr_memo");
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

<form name="flist" id="flist" method="post" action="qna_list.php">
<INPUT TYPE="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<? if($member[is_supply]>1){ ?><th width="40"><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th><? } ?>
	<th width="250">상품명</th>
	<th width="120">회원정보</th>		
	<th>내용</th>
	<th width="140">등록일자</th>
	<? if($member[is_supply]>1){ ?>
	<th width="70">수정</th>
	<? } ?>
	<th width="70">삭제</th>
</tr>
<?
for($i=0; $row=sql_fetch_array($result); $i++){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<? if($member[is_supply]>1){ ?><td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td><? } ?>
	<td><a href="<?=item_link($row[it_id])?>" target="_blank"><?=item_name($row[it_id])?></a></td>
	<td><?=mb_info($row[mb_no])?></td>
	<td style="text-align:left; padding:10px; word-break:break-all;">
	<? if($row[wr_reply]){ ?>&nbsp;&nbsp;&nbsp;<img src="img/re.gif"><? } else{ ?><img src="img/q_ico.gif"><? } ?>	
	<?=nl2br($row[wr_memo])?>
	<? if(!$row[wr_reply]){ ?><a href="javascript:qna_reply('<?=$row[wr_id]?>');" class="btn_sml"><span>답변하기</span></a><? } ?>
	</td>
	<td><?=$row[wr_datetime]?></td>
	<? if($member[is_supply]>1){ ?>
	<td><a href="qna_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<? } ?>
	<td><a href="qna_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/del_btn.gif"></a></td>
</tr>



<?
$que2 = sql_query("select * from nfor_item_qna where wr_reply='$row[wr_id]'");
while($data = sql_fetch_array($que2)){
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<? if($member[is_supply]>1){ ?><td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$data[wr_id]?>"></td><? } ?>
	<td><a href="<?=item_link($data[it_id])?>" target="_blank"><?=item_name($data[it_id])?></a></td>
	<td><?=mb_info($data[mb_no])?></td>
	<td style="text-align:left; padding:10px; word-break:break-all;">
	<? if($data[wr_reply]){ ?>&nbsp;&nbsp;&nbsp;<img src="img/re.gif"><? } else{ ?><img src="img/q_ico.gif"><? } ?>	
	<?=nl2br($data[wr_memo])?>
	<? if(!$data[wr_reply]){ ?><a href="javascript:qna_reply('<?=$data[wr_id]?>');" class="btn_sml"><span>답변하기</span></a><? } ?>
	</td>
	<td><?=$data[wr_datetime]?></td>
	<? if($member[is_supply]>1){ ?>
	<td><a href="qna_form.php?wr_id=<?=$data[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<? } ?>
	<td><a href="qna_list.php?mode=delete&wr_id=<?=$data[wr_id]?>&<?=$qstr?>"><img src="img/del_btn.gif"></a></td>
</tr>
<? 
	$i++;
} 
?>




<? 
}
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<? if($member[is_supply]>1){ ?><div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a></div><? } ?>
</form>

<?
include "tail.php";
?>