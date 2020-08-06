<?php	// 문자메시지발송
include "path.php";
ini_set('memory_limit', -1);

$qstr .= "&ca_name=$ca_name";

if($mode=="send"){
	$row = sql_fetch("select * from nfor_sms where wr_id='$wr_id'");

	if($row[ca_name]=="전체회원") $sql = "select mb_hp from nfor_member where is_supply='0' and mb_leavedatetime=''";
	if($row[ca_name]=="수신허용회원") $sql = "select mb_hp from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1'";
	if($row[ca_name]=="구독회원") $sql = "select mb_hp from nfor_subscribe where mb_email<>''";
	if($row[ca_name]=="지역별회원") $sql = "select mb_hp from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_addr1 like '$row[who]%'";
	if($row[ca_name]=="성별회원") $sql = "select mb_hp from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_sex='$row[who]'";
	if($row[ca_name]=="연령별회원"){
		$row[who] = ereg_replace("[^0-9]", "", $row[who]);
		$sdate = (date("Y")-($row[who]+9))."-12-31";
		$edate = (date("Y")-$row[who])."-01-01";
		$sql = "select mb_hp from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_birth > '$sdate' and mb_birth < '$edate'";
	}
	
	$hps = array();

	if($row[send_hp]) $config[cf_tel] = $row[send_hp];
	$que = sql_query($sql);
	while($sms = sql_fetch_array($que)){
		$hps[] = ereg_replace("[^0-9]", "", $sms[mb_hp]); 
	}
	sms_send($hps, $config[cf_tel], $row[wr_memo]);

	alert("정상적으로 전송되었습니다","sms_list.php?$qstr");
	exit;
}

if($mode=="list_delete"){
	for($i=0; $i<count($chk); $i++){
		$k = $_POST['chk'][$i];
		sql_query("delete from nfor_sms where wr_id='{$_POST['wr_id'][$k]}'");
	}
	alert("정상적으로 삭제되었습니다","sms_list.php?$qstr");
	exit;
}

if($mode=="delete"){
	sql_query("delete from nfor_sms where wr_id='$wr_id'");
	alert("정상적으로 삭제되었습니다","sms_list.php?$qstr");
	exit;
}

if($wr_id) $write = sql_fetch("select * from nfor_sms where wr_id='$wr_id'");

$sql_common = " from nfor_sms ";
$sql_search = " where (1) ";
if($ca_name) $sql_search .= " and ca_name='$ca_name' ";
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
	<td height="50">
	<form name="search" method="get" action="sms_list.php">
	<select name="ca_name" onchange="search.submit()">
	<option value="">발송대상
	<?
	for($i=0; $i<count($nfor[send]); $i++){
	?>
	<option value="<?=$nfor[send][$i]?>" <?=$nfor[send][$i]==$ca_name?"selected":""?>><?=$nfor[send][$i]?>
	<?}?>
	</select>
	</form>
	</td>
	<td height="50" align="right">
	<form name="fsearch" method="get">
	<input type="hidden" name="ca_name" value="<?=$ca_name?>">
	<select name="sfl">
	<?
	$sfl_txt_array = array("문자내용");
	$sfl_val_array = array("wr_memo");
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

<form name="flist" id="flist" method="post" action="sms_list.php">
<input type="hidden" NAME="mode" id="mode">
<input type="hidden" name="sfl" value="<?=$sfl?>">
<input type="hidden" name="stx" value="<?=$stx?>">
<input type="hidden" name="page" value="<?=$page?>">
<input type="hidden" name="ca_name" value="<?=$ca_name?>">
<table border="1" cellspacing="0" class="tbl_typeB">
<tr>
	<th><input type="checkbox" name="chkall" value="1" onclick="check_all(this.form)"></th>
	<th>발송대상</th>
	<th>발송인원</th>
	<th>문자내용</th>
	<th>발송날짜</th>
	<th>문자발송</th>
	<th>수정</th>
	<th>삭제</th>
</tr>
<? 
for($i=0; $row=sql_fetch_array($result); $i++){ 
?>
<tr onmouseover="this.style.backgroundColor='#fafafa'" onmouseout="this.style.backgroundColor=''" bgcolor="#FFFFFF">
	<td><input type="checkbox" name="chk[]" value="<?=$i?>"><input type="hidden" name="wr_id[<?=$i?>]" value="<?=$row[wr_id]?>"></td>
	<td>
	<?=$row[ca_name]?>
	<?=$row[who]?"<br>".$row[who]:""?>
	</td>
	<td>

	<?
	if($row[ca_name]=="전체회원") $sql = "select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime=''";
	if($row[ca_name]=="수신허용회원") $sql = "select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1'";
	if($row[ca_name]=="구독회원") $sql = "select count(*) as cnt from nfor_subscribe where mb_email<>''";
	if($row[ca_name]=="지역별회원") $sql = "select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_addr1 like '$row[who]%'";
	if($row[ca_name]=="성별회원") $sql = "select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_sex='$row[who]'";
	if($row[ca_name]=="연령별회원"){
		$row[who] = ereg_replace("[^0-9]", "", $row[who]);
		$sdate = (date("Y")-($row[who]+9))."-12-31";
		$edate = (date("Y")-$row[who])."-01-01";
		$sql = "select count(*) as cnt from nfor_member where is_supply='0' and mb_leavedatetime='' and mb_mailling='1' and mb_birth > '$sdate' and mb_birth < '$edate'";
	}
	$count = sql_fetch($sql);
	echo number_format($count[cnt]);
	?>명

	</td>
	<td style="text-align:left; padding-left:10px;"><a href="sms_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><?=$row[wr_memo]?></a></td>
	<td><?=substr($row[wr_datetime],0,10)?></td>
	<td><a href="sms_list.php?mode=send&wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/ju_btn12.jpg"></a></td>
	<td><a href="sms_form.php?wr_id=<?=$row[wr_id]?>&<?=$qstr?>"><img src="img/su_btn.gif"></a></td>
	<td><a href="javascript:del('sms_list.php?mode=delete&wr_id=<?=$row[wr_id]?>&<?=$qstr?>')"><img src="img/del_btn.gif"></a></td>
</tr>
<? 
} 
$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");	
?>
</table>
<div class="btn_cen"><?=$pagelist?></div>
<div class="btn_cen"><a href="javascript:nfor_list('삭제','list_delete')"><img src="img/sun_del.gif" alt="선택삭제"></a> <a href="sms_form.php?<?=$qstr?>"><img src="img/dong_btn.gif"></a></div>
</form>

<?
include "tail.php";
?>