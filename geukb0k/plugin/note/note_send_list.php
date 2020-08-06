<?php	// 쪽지
include "path.php";

$title = "보낸쪽지함";

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("update nfor_note set send_del='1' where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","note_send_list.php?$qstr");
	exit;
}

include "head.php";

$sql_common = " from nfor_note ";
$sql_search = " where send_no='$member[mb_no]' and send_del='0' ";
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
?>

<table cellpadding="0" cellspacing="0" border="0" style="width:96%;" align="center">
<tr>
	<td>보낸쪽지 : <?=$total_count?>통</td>
</tr>
</table>

<form name="flist" id="flist" method="post" action="note_send_list.php">
<input type="hidden" name="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<table cellpadding="0" cellspacing="0" border="0" class="tbl_typeP" width="95%" align="center">
<tr>
	<th width="40"><input type=checkbox name=chkall value='1' onclick='check_all(this.form)'></th>
	<th>받는사람</th>
	<th>내용</th>
	<th>보낸시간</th>
	<th>읽은시간</th>
</tr>
<?								
for($i=0; $row=sql_fetch_array($result); $i++){
	$mb = member("mb_no", $row[receive_no]);
?>
<tr>
	<td><input type=checkbox name=chk[] value='<?=$i?>'><input type=hidden name=wr_id[<?=$i?>] value='<?=$row[wr_id]?>'></td>
	<td><?=$mb[mb_id]?></td>
	<td><a href="note_send_view.php?wr_id=<?=$row[wr_id]?>"><?=cut_str(strip_tags($row[wr_memo]),30)?></a></td>
	<td><a href="note_send_view.php?wr_id=<?=$row[wr_id]?>"><?=substr($row[send_datetime],0,10)?></a></td>
	<td><a href="note_send_view.php?wr_id=<?=$row[wr_id]?>"><?=substr($row[receive_datetime],0,10)=="0000-00-00"?"-":substr($row[receive_datetime],0,10)?></a></td>
</tr>
<? } ?>
</table>

<table cellpadding="0" cellspacing="0" border="0" style="width:96%;" align="center">
<tr>
	<td>
	<a href="javascript:nfor_list('삭제','list_delete')">선택삭제</a>
	<a href="javascript:window.close()">창닫기</a>
	</td>
</tr>
</table>

</form>

<?php
include "tail.php";
?>